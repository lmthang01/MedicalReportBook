<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonalHistoryRequest extends FormRequest
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
            'name_of_disease' => 'required|unique:personal_history_type,name,'.$this->id,
           
        ];
    }

    public function messages()
    {
        return [
           
            'name_of_disease.required' => 'Tên bệnh không được để trống!',
            'name_of_disease.unique' => 'Tên bệnh đã tồn tại!',
            
        ];
    }
}
