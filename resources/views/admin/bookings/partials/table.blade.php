<div class="row">
    <style>
        .bg-warning {
            background-color: #fff3cd !important;
            transition: background-color 0.3s ease;
        }
    </style>
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Đặt lịch</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="searchableTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Khách hàng</th>
                                <th>Dịch vụ</th>
                                <th>Thợ</th>
                                <th>Thời gian</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bookings as $item)
                                <tr id="row-{{ $item->id }}">
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->customer->customer_name }} <br />
                                        ({{ $item->customer->customer_email }})
                                        <br />
                                        ({{ $item->customer->customer_phone }})
                                    </td>
                                    <td>{{ $item->service->service_name }} ( {{ $item->service->duration }} phút ) </td>
                                    <td>{{ $item->technician->name ?? 'Chưa phân công' }}</td>
                                    <td>
                                        @php
                                            $slots = $item->slots->sortBy('start_time');
                                            $firstSlot = $slots->first();
                                            $lastSlot = $slots->last();
                                        @endphp

                                        @if ($item->status === 'canceled')
                                            <span class="text-danger fw-bold">Đã huỷ lịch</span>
                                        @elseif ($firstSlot && $lastSlot)
                                            <div>
                                                {{ \Carbon\Carbon::parse($firstSlot->date)->format('d/m/Y') }}
                                                {{ \Carbon\Carbon::parse($firstSlot->start_time)->format('H:i') }}
                                                -
                                                {{ \Carbon\Carbon::parse($lastSlot->end_time)->format('H:i') }}
                                            </div>
                                        @endif
                                    </td>

                                    <td>
                                        <select class="form-select selectric status-select"
                                            data-id="{{ $item->id }}" data-original="{{ $item->status }}"
                                            {{ in_array($item->status, ['completed', 'canceled']) ? 'disabled' : '' }}>
                                            <option value="confirmed"
                                                {{ $item->status == 'confirmed' ? 'selected' : '' }}>
                                                Đã xác nhận
                                            </option>
                                            <option value="completed"
                                                {{ $item->status == 'completed' ? 'selected' : '' }}>
                                                Hoàn thành
                                            </option>
                                            <option value="canceled"
                                                {{ $item->status == 'canceled' ? 'selected' : '' }}>
                                                Đã huỷ
                                            </option>
                                        </select>
                                    </td>
                                    <td>
                                        @if ($item->status !== 'completed')
                                            <button class="btn btn-danger btn-sm delete-booking-btn"
                                                data-id="{{ $item->id }}">
                                                <i class="fas fa-trash-alt"></i> Xoá
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Không có dữ liệu</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {!! $bookings->withQueryString()->links('pagination::bootstrap-5') !!}

                </div>
            </div>
        </div>
    </div>
</div>
