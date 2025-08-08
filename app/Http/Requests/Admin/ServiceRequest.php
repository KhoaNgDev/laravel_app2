<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'service_name' => 'required|string|max:255',
            'duration' => 'required|integer|min:1|max:60',
            'description' => 'nullable|string|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'service_name.required' => 'Vui lòng nhập tên dịch vụ.',
            'service_name.max' => 'Tên dịch vụ không được vượt quá 255 ký tự.',
            'duration.required' => 'Vui lòng nhập thời gian làm việc.',
            'duration.integer' => 'Thời gian phải được tính bằng số phút.',
            'duration.min' => 'Thời gian tối thiểu là 1 phút.',
            'duration.max' => 'Thời gian cao nhất là 60 phút.',

            'description.max' => 'Mô tả không được vượt quá 1000 ký tự.',
        ];
    }
}
