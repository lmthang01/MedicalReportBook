<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;

use App\Http\Requests\StaffRequest;
use App\Models\Department;
use App\Models\PersonalHistory;
use App\Models\Province;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class StaffController extends Controller
{
    public function index(Request $request)
    {
        $staffs = Staff::with('department:id,name', 'province:id,name', 'district:id,name', 'ward:id,name');
        $departments = Department::all();
        
        // Tìm bằng tên, mã nhân viên
        if ($name = $request->n)
            $staffs->where('name', 'like', '%' . $name . '%')
                ->orWhere('staff_code', 'like', '%' . $name . '%');

        // Tìm kiếm bằng trạng thái
        if($s = $request->department)
            $staffs->where('department_id', $s);

        $staffs = $staffs->orderByDesc('id')
                ->paginate(10); // Phân trang 5 thông tin
        
        // dd($request->all()); 

        $viewData = [
            'staffs' => $staffs,
            'departments' => $departments,
            // 'query' => $request->query(), // => Phân trang code123
        ];
        return view('backend.staff.index', $viewData)->with('i', (request()->input('page', 1) -1) *5);

        // return view('backend.staff.index', compact('staffs'))->with('i', (request()->input('page', 1) -1) *5);

    }

    public function create()
    {
        $provinces = Province::all();

        $departments = Department::all();
        return view('backend.staff.create', compact('departments', 'provinces'));
    }

    public function store(StaffRequest $request)
    {
        try {
            $data = $request->except('_token', 'avatar');
            $data['slug'] = Str::slug($request->name);
            $data['created_at'] = Carbon::now();

            if ($request->avatar) {
                $file = upload_image('avatar');
                if (isset($file['code']) && $file['code'] == 1) {
                    $data['avatar'] = $file['name'];
                }
            }

            $staff = Staff::create($data);
        } catch (\Exception $exception) {
            toastr()->error('Thêm mới thất bại!', 'Thông báo', ['timeOut' => 2000]);
            Log::error("ERROR => StaffController@store => " . $exception->getMessage());
            return redirect()->route('get_admin.staff.create');
        }
        toastr()->success('Thêm mới thành công!', 'Thông báo', ['timeOut' => 2000]);
        return redirect()->route('get_admin.staff.index');
    }

    public function edit($id)
    {
        $departments = Department::all();

        $staff = Staff::findOrFail($id);

        $provinces = Province::all();

        $personalHistory = PersonalHistory::where('staff_id', $id)->with('staff:id,name');

        $personalHistory = $personalHistory
            ->orderByDesc('id')
            ->paginate(20);
        
        $activeDistricts_residence = DB::table('districts')->where('id', $staff->district_id_residence)->pluck('name', 'id')->toArray();

        $activeWards_residence = DB::table('wards')->where('id', $staff->ward_id_residence)->pluck('name', 'id')->toArray();

        $activeDistricts_current = DB::table('districts')->where('id', $staff->district_id_current)->pluck('name', 'id')->toArray();

        $activeWards_current = DB::table('wards')->where('id', $staff->ward_id_current)->pluck('name', 'id')->toArray();

        return view('backend.staff.update', compact('staff', 'departments', 'provinces', 'activeDistricts_residence', 'activeWards_residence', 'activeDistricts_current', 'activeWards_current', 'personalHistory'))->with('i', (request()->input('page', 1) -1) *5);;
    }

    public function update(StaffRequest $request, $id)
    {
        try {
            $data = $request->except('_token', 'avatar');
            $data['slug'] = Str::slug($request->name);
            $data['updated_at'] = Carbon::now();

            // dd($request->all());
            /* Nếu có name = avatar gửi lên request và có kết quả trả về "code" */
            if ($request->avatar) {
                $file = upload_image('avatar');
                if (isset($file['code']) && $file['code'] == 1) {
                    $data['avatar'] = $file['name'];
                }
            }

            Staff::find($id)->update($data);
        } catch (\Exception $exception) {
            Log::error("ERROR => StaffController@update => " . $exception->getMessage());
            toastr()->error('Cập nhật thất bại!', 'Thông báo', ['timeOut' => 2000]);
            return redirect()->route('get_admin.staff.update', $id);
        }
        toastr()->success('Cập nhật thành công!', 'Thông báo', ['timeOut' => 2000]);
        return redirect()->route('get_admin.staff.index');
    }

    public function delete(Request $request, $id)
    {
        try {
            $staff = Staff::findOrFail($id);

            if ($staff) {
                PersonalHistory::where('staff_id', $id)->delete();
                $staff->delete();
            }

        } catch (\Exception $exception) {
            toastr()->error('Xóa thất bại!', 'Thông báo', ['timeOut' => 2000]);
            Log::error("ERROR => StaffController@delete => " . $exception->getMessage());
        }
        toastr()->success('Xóa thành công!', 'Thông báo', ['timeOut' => 2000]);
        return redirect()->route('get_admin.staff.index');
    }

    
}
