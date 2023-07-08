<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;

use App\Http\Requests\DepartmentRequest;
use App\Http\Requests\StaffRequest;
use App\Models\Department;
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

        // Tìm bằng tên, mã nhân viên
        if ($name = $request->n)
            $staffs->where('name', 'like', '%' . $name . '%')
                ->orWhere('staff_code', 'like', '%' . $name . '%');

        $staffs = $staffs->orderByDesc('id')
            ->paginate(20); // Phân trang 20 dòng

        $viewData = [
            'staffs' => $staffs,
            'query' => $request->query(), // => Phân trang ??
        ];
        return view('backend.staff.index', $viewData);
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
        
        $activeDistricts = DB::table('districts')->where('id', $staff->district_id)->pluck('name', 'id')->toArray();

        $activeWards = DB::table('wards')->where('id', $staff->ward_id)->pluck('name', 'id')->toArray();

        return view('backend.staff.update', compact('staff', 'departments', 'provinces', 'activeDistricts', 'activeWards'));
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
            if ($staff) $staff->delete();
        } catch (\Exception $exception) {
            toastr()->error('Xóa thất bại!', 'Thông báo', ['timeOut' => 2000]);
            Log::error("ERROR => StaffController@delete => " . $exception->getMessage());
        }
        toastr()->success('Xóa thành công!', 'Thông báo', ['timeOut' => 2000]);
        return redirect()->route('get_admin.staff.index');
    }
}
