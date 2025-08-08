<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3', 'max:50'],
            'message' => ['required', 'max:200'],

            'email' => [
                'required',
                'regex:/^[a-zA-Z0-9._%+-]+@gmail\\.com$/'
            ],
            'phone' => [
                'regex:/^(0|\+84)[0-9]{9}$/'
            ],

        ];
    }
    public function messages()
    {
        return [
            'message.required' => 'Vui lòng nhập nội dung.',
            'message.max' => 'Giới hạn chỉ 200 chữ.',
            'name.required' => 'Vui lòng nhập tên người sử dụng',
            'name.min' => 'Tên phải lớn hơn 3 ký tự',
            'name.max' => 'Bạn đã nhập quá số chữ quy định.',
            'email.required' => 'Email không được để trống.',
            'email.regex' => 'Email không đúng định dạng.',
            'phone.required' => 'Số điện thoại không được để trống.',
            'phone.regex' => 'Số điện thoại phải là 10 chữ số và bắt đầu bằng số 0.',
        ];
    }

}
