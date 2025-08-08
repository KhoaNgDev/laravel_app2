<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'customer' => ['nullable', 'string', 'max:100'],
            'date' => ['nullable', 'date'],
            'technician_id' => ['nullable', 'integer', 'exists:users,id'],
            'status' => ['nullable', 'in:confirmed,completed,canceled'],
        ];
    }
    public function messages(): array
    {
        return [
            'customer.max' => 'Tên khách hàng không được quá 100 kí tự.',
            'date.date' => 'Ngày không hợp lệ.',
            'technician_id.integer' => 'Thợ không hợp lệ.',
            'technician_id.exists' => 'Thợ không tồn tại.',
            'status.in' => 'Trạng thái không hợp lệ.',
        ];
    }
}
