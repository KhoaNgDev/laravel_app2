<div class="card mt-4">
    <div class="card-header">
        <h5>5 Đơn đặt lịch mới nhất</h5>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Khách hàng</th>
                    <th>Dịch vụ</th>
                    <th>Thời gian</th>
                    <th>Ngày nhận đơn</th>
                    <th>Trạng thái</th>

                </tr>
            </thead>
            <tbody>
                @forelse ($recentBookings as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->customer->customer_name }}
                            <br /> ({{ $item->customer->customer_email }})
                            <br /> ({{ $item->customer->customer_phone }})
                        </td>
                        <td>{{ $item->service->service_name }} ({{ $item->service->duration }} phút)</td>
                        <td>
                            @php
                                $slots = $item->slots->sortBy('start_time');
                                $first = $slots->first();
                                $last = $slots->last();
                            @endphp

                            @if ($first && $last)
                                <div>
                                    {{ \Carbon\Carbon::parse($first->date)->format('d/m/Y') }}
                                    {{ \Carbon\Carbon::parse($first->start_time)->format('H:i') }} -
                                    {{ \Carbon\Carbon::parse($last->end_time)->format('H:i') }}
                                </div>
                            @else
                                <span class="text-muted">Không có</span>
                            @endif
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') }}
                        </td>
                        <td>
                            @php
                                $statusColor = match ($item->status) {
                                    'confirmed' => 'primary',
                                    'completed' => 'success',
                                    'canceled' => 'danger',
                                    default => 'secondary',
                                };
                            @endphp
                            <span style="color:white"
                                class="badge bg-{{ $statusColor }}">{{ ucfirst($item->status) }}</span>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Không có đơn nào</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>

