<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
            'name' => 'required|unique:departments,name,'.$this->id,
            // 'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'Tên phòng ban đã tồn tại!',
            'name.required' => 'Tên phòng ban không được để trống!',
            // 'description.required' => 'Mô tả không được để trống!',
        ];
    }
}
