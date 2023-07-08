<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\UserHasType;
use App\Models\UserType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(Request $request)
    {

        // Mail::to('thang259a3@gmail.com')->send(new SendEmailRegisterUser());

        $users = User::with('userType')->orderByDesc('id');

        // Tìm kiếm bằng text
        if ($name = $request->n)
            $users->where('name', 'like', '%' . $name . '%')
                ->orWhere('email', 'like', '%' . $name . '%')
                ->orWhere('phone', 'like', '%' . $name . '%');
        
        // Tìm kiếm bằng trạng thái
        if($s = $request->status)
            $users->where('status', $s);

        $users = $users->orderByDesc('id')
                        ->paginate(20); // Phân trang 20 dòng

        $model = new User();
        $status = $model->getStatus();

        $viewData = [
            'users' => $users,
            'status' => $status,

        ];
        return view('backend.user.index', $viewData);
    }

    public function create()
    {
        $usersType = UserType::all();
        return view('backend.user.create', compact('usersType'));
    }

    public function store(UserRequest $request)
    {
        try {

            $data = $request->except('_token', 'avatar', 'user_type');
            $data['created_at'] = Carbon::now();
            $data['password'] = bcrypt(Carbon::now()); // Mã hóa password, vì tạo trường password không được để trống bên databases
            $data['status'] = $request->status ?? 1;
            $data['email_verified_at'] = Carbon::now();

            if ($request->avatar) {
                $file = upload_image('avatar');
                if (isset($file['code']) && $file['code'] == 1) {
                    $data['avatar'] = $file['name'];
                }
            }

            // dd($request->all());

            $user = User::create($data);

            // Sau khi thêm user -> check type user là gì
            if ($user) {
                $this->insertOrUpdateHasType($user, $request->user_type);
            }

            // #1. Gửi mail thường
            // Mail::to($user->email)->send(new SendEmailRegisterUser($user));

            // #2. Gửi mail dùng queue (rút ngắn thời gian)
            // Mail::to($user->email)->queue(new SendEmailRegisterUser($user));

            toastr()->success('Thêm mới thành công!', 'Thông báo', ['timeOut' => 2000]);
        } catch (\Exception $exception) {
            Log::error("ERROR => UserController@store => " . $exception->getMessage());
            toastr()->error('Thêm mới thất bại!', 'Thông báo', ['timeOut' => 2000]);
            return redirect()->route('get_admin.user.create');
        }
        return redirect()->route('get_admin.user.index');
    }

    /*
        Kiểm tra khi user thêm vào thuộc type nào
        Nếu đã có type trước đây tiến hàng cập nhật
        Ngược lại thì insert type vào csdl
    */
    protected function insertOrUpdateHasType($user, $typeID)
    {

        $check = UserHasType::where('user_id', $user->id)->first(); // Kiểm tra user có type chưa ??
        if ($check) {
            $check->user_type_id = $typeID;
            $check->updated_at = Carbon::now();
            $check->save();
        } else {
            DB::table('user_has_types')->insert([
                'user_type_id' => $typeID,
                'created_at' => Carbon::now(),
                'user_id' => $user->id
            ]);
        }
    }

    public function edit($id)
    {
        $userHasType = UserHasType::findOrFail($id);

        $usersType = UserType::all();
        $user = User::findOrFail($id);
        return view('backend.user.update', compact('user', 'usersType', 'userHasType'));
    }

    public function update(UserRequest $request, $id)
    {
        try {
            $data = $request->except('_token', 'avatar', 'user_type');
            $data['updated_at'] = Carbon::now();

            // dd($request->all());
            /* Nếu có name = avatar gửi lên request và có kết quả trả về "code" */
            if ($request->avatar) {
                $file = upload_image('avatar');
                if (isset($file['code']) && $file['code'] == 1) {
                    $data['avatar'] = $file['name'];
                }
            }

            $update = User::find($id)->update($data);
            if ($update) {
                $user = User::find($id);
                $this->insertOrUpdateHasType($user, $request->user_type);
            }

            toastr()->success('Cập nhật thành công!', 'Thông báo', ['timeOut' => 2000]);
        } catch (\Exception $exception) {
            Log::error("ERROR => UserController@update => " . $exception->getMessage());
            toastr()->error('Cập nhật thất bại!', 'Thông báo', ['timeOut' => 2000]);
            return redirect()->route('get_admin.user.update', $id);
        }
        return redirect()->route('get_admin.user.index');
    }

    public function delete(Request $request, $id)
    {
        try {

            $user = User::findOrFail($id);

            // Muốn xóa dữ liệu User cần xóa dữ liệu UserHasType trước
            if ($user) {
                UserHasType::where('user_id', $id)->delete();
                $user->delete();
            }

            toastr()->success('Xóa thành công!', 'Thông báo', ['timeOut' => 2000]);
        } catch (\Exception $exception) {
            toastr()->error('Xóa thất bại!', 'Thông báo', ['timeOut' => 2000]);
            Log::error("ERROR => UserController@delete => " . $exception->getMessage());
        }
        return redirect()->route('get_admin.user.index');
    }
}
