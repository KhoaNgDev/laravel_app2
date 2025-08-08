<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
            'customer_name' => 'required|string|max:100',
            'customer_phone' => [
                'regex:/^(0|\+84)[0-9]{9}$/'
            ],
            'customer_email' => 'required|email|max:100',
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required',
            'service_id' => 'required|exists:services,id',
        ];

    }
    public function messages()
    {
        return [
            'customer_name.required' => 'Vui lòng nhập tên.',
            'customer_name.max' => 'Vui lòng nhập không quá 100 kí tự.',
            'customer_phone.regex' => 'Số điện thoại phải là 10 chữ số và bắt đầu bằng số 0.',
            'customer_email.required' => 'Email không được để trống.',
            'customer_email.max' => 'Vui lòng nhập không quá 100 kí tự.',
            'customer_email.email' => 'Email không đúng định dạng.',
            'booking_date.required' => 'Vui lòng chọn ngày đặt lịch.',
            'booking_date.date' => 'Ngày đặt lịch không hợp lệ.',
            'booking_date.after_or_equal' => 'Ngày đặt lịch phải là hôm nay hoặc sau này.',
            'booking_time.required' => 'Vui lòng chọn giờ đặt lịch.',
            'service_id.required' => 'Vui lòng chọn dịch vụ.',
            'service_id.exists' => 'Dịch vụ đã chọn không tồn tại.',
        ];
    }
}
