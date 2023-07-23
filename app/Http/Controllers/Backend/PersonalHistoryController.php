<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use App\Models\PersonalHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class PersonalHistoryController extends Controller
{
    // public function index()
    // {
    //     $personalHistory = PersonalHistory::orderByDesc('id')->paginate(5);

    //     $viewData = [
    //         'personalHistory' => $personalHistory,
    //     ];
    //     return view('backend.staff.update', $viewData)->with('i', (request()->input('page', 1) -1) *5);
    // }

    // public function create()
    // {
    //     return view('backend.department.create');
    // }

    public function store(Request $request)
    {
        try {
            $data = $request->except('_token');
            $data['slug'] = Str::slug($request->name);
            $data['created_at'] = Carbon::now();

            $personalHistory = PersonalHistory::create($data);
        } catch (\Exception $exception) {
            toastr()->error('Thêm mới thất bại!', 'Thông báo', ['timeOut' => 2000]);
            Log::error("ERROR => PersonalHistoryController@store => " . $exception->getMessage());
            return redirect()->route('get_admin.staff.update');
        }
        toastr()->success('Thêm mới thành công!', 'Thông báo', ['timeOut' => 2000]);
        return redirect()->back();
    }

    // public function edit($id)
    // {

    //     $personalHistory = PersonalHistory::findOrFail($id);
    //     return view('backend.staff.update', compact('personalHistory'));
    // }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->except('_token');
            $data['slug'] = Str::slug($request->name);
            $data['updated_at'] = Carbon::now();

            PersonalHistory::find($id)->update($data);
        } catch (\Exception $exception) {
            Log::error("ERROR => PersonalHistoryController@update => " . $exception->getMessage());
            toastr()->error('Cập nhật thất bại!', 'Thông báo', ['timeOut' => 2000]);
            return redirect()->route('get_admin.staff.update', $id);
        }
        toastr()->success('Cập nhật thành công!', 'Thông báo', ['timeOut' => 2000]);
        return redirect()->back();
    }



    public function delete(Request $request, $id)
    {
        try {
            $personalHistory = PersonalHistory::findOrFail($id);
            if ($personalHistory) $personalHistory->delete();
        } catch (\Exception $exception) {
            toastr()->error('Xóa thất bại!', 'Thông báo', ['timeOut' => 2000]);
            Log::error("ERROR => DepartmentController@delete => " . $exception->getMessage());
        }
        toastr()->success('Xóa thành công!', 'Thông báo', ['timeOut' => 2000]);
        return redirect()->back();
    }
}
