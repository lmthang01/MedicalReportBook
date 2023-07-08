<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $departments = Department::orderByDesc('id');

        if ($name = $request->n)
            $departments->where('name', 'like', '%' . $name . '%');

        $departments = $departments->orderByDesc('id')->paginate(5); // Phân trang 20 dòng
                
        $viewData = [
            'departments' => $departments,
        ];
        return view('backend.department.index', $viewData)->with('i', (request()->input('page', 1) -1) *5);
    }

    public function create()
    {
        return view('backend.department.create');
    }

    public function store(DepartmentRequest $request)
    {
        try {
            $data = $request->except('_token', 'avatar');
            $data['slug'] = Str::slug($request->name);
            $data['created_at'] = Carbon::now();

            $department = Department::create($data);
        } catch (\Exception $exception) {
            toastr()->error('Thêm mới thất bại!', 'Thông báo', ['timeOut' => 2000]);
            Log::error("ERROR => DepartmentController@store => " . $exception->getMessage());
            return redirect()->route('get_admin.department.create');
        }
        toastr()->success('Thêm mới thành công!', 'Thông báo', ['timeOut' => 2000]);
        return redirect()->route('get_admin.department.index');
    }

    public function edit($id)
    {

        $department = Department::findOrFail($id);
        return view('backend.department.update', compact('department'));
    }

    public function update(DepartmentRequest $request, $id)
    {
        try {
            $data = $request->except('_token', 'avatar');
            $data['slug'] = Str::slug($request->name);
            $data['updated_at'] = Carbon::now();

            // dd($request->all());
            /* Nếu có name = avatar gửi lên request và có kết quả trả về "code" */
            // if($request->avatar){
            //     $file = upload_image('avatar');
            //     if(isset($file['code']) && $file['code'] == 1){
            //         $data['avatar'] = $file['name'];
            //     }
            // }

            Department::find($id)->update($data);
        } catch (\Exception $exception) {
            Log::error("ERROR => DepartmentController@update => " . $exception->getMessage());
            toastr()->error('Cập nhật thất bại!', 'Thông báo', ['timeOut' => 2000]);
            return redirect()->route('get_admin.department.update', $id);
        }
        toastr()->success('Cập nhật thành công!', 'Thông báo', ['timeOut' => 2000]);
        return redirect()->route('get_admin.department.index');
    }

    public function delete(Request $request, $id)
    {
        try {
            $department = Department::findOrFail($id);
            if ($department) $department->delete();
        } catch (\Exception $exception) {
            toastr()->error('Xóa thất bại!', 'Thông báo', ['timeOut' => 2000]);
            Log::error("ERROR => DepartmentController@delete => " . $exception->getMessage());
        }
        toastr()->success('Xóa thành công!', 'Thông báo', ['timeOut' => 2000]);
        return redirect()->route('get_admin.department.index');
    }
}
