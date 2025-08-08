<h2>Thông báo huỷ lịch đặt</h2>

<p>Chào {{ $booking->customer->customer_name }},</p>

<p>Lịch đặt dịch vụ <strong>{{ $booking->service->service_name }}</strong> của bạn đã bị huỷ 
    @if ($booking->status === 'canceled' && $booking->canceled_note)
        bởi dịch vụ sửa chửa xe của chúng tôi với lý do bên dưới.
    @else
        do đã quá hạn mà không được xử lý.
    @endif
</p>

@if (!empty($booking->canceled_note))
    <p><strong>Lý do huỷ:</strong> {{ $booking->canceled_note }}</p>
@endif

<p><strong>Thời gian ban đầu:</strong></p>
<ul>
    @foreach ($booking->slots as $slot)
        <li>
            Ngày: {{ \Carbon\Carbon::parse($slot->date)->format('d/m/Y') }} -
            Từ {{ \Carbon\Carbon::parse($slot->start_time)->format('H:i') }}
            đến {{ \Carbon\Carbon::parse($slot->end_time)->format('H:i') }}
        </li>
    @endforeach
</ul>

<p>Xin lỗi vì sự bất tiện. Vui lòng đặt lại nếu cần hỗ trợ thêm.</p>
