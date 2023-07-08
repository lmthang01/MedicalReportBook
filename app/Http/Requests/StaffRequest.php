<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'staff_code' => 'required|unique:staffs,staff_code,'.$this->id,
            'name' => 'required',
            'gender' => 'required',
            'department_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'staff_code.unique' => 'Mã nhân viên đã tồn tại!',
            'staff_code.required' => 'Mã nhân viên không được để trống!',
            'name.required' => 'Tên nhân viên không được để trống!',
            'gender.required' => 'Giới tính để trống, vui lòng chọn giới tính',
            'department_id.required' => 'Phòng ban để trống, vui lòng chọn phòng ban',
        ];
    }
}
