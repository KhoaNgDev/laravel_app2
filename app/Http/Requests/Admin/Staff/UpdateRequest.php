<?php

namespace App\Http\Requests\Admin\Staff;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name'       => 'required|string|max:100',
            'email'      => 'required|email:rfc,dns|unique:users,email,' . $this->route('id'),
            'password'   => 'nullable|string|min:6|confirmed',
            'phone'      => ['nullable', 'regex:/^0[0-9]{9}$/'],
            'photo'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_active'  => 'required|in:active,inactive',
            'group_role' => 'required|in:Admin,User',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'       => 'Vui lòng nhập họ tên.',
            'name.max'            => 'Họ tên không được vượt quá 100 ký tự.',
            
            'email.required'      => 'Vui lòng nhập email.',
            'email.email'         => 'Email không đúng định dạng.',
            'email.unique'        => 'Email đã tồn tại.',

            'password.min'        => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed'  => 'Xác nhận mật khẩu không khớp.',

            'phone.regex'         => 'Số điện thoại phải gồm 10 chữ số và bắt đầu bằng số 0.',

            'photo.image'         => 'Ảnh đại diện phải là hình ảnh.',
            'photo.mimes'         => 'Ảnh chỉ được có định dạng jpg, jpeg, png.',
            'photo.max'           => 'Ảnh không được vượt quá 2MB.',

            'is_active.required'  => 'Vui lòng chọn trạng thái.',
            'is_active.in'        => 'Giá trị trạng thái không hợp lệ.',

            'group_role.required' => 'Vui lòng chọn vai trò.',
            'group_role.in'       => 'Giá trị vai trò không hợp lệ.',
        ];
    }
}
