<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Danh sách góp ý</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle" id="searchableTable">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Thông tin khách hàng</th>
                                <th>Góp ý</th>
                                <th>Đánh giá</th>
                                <th>Phân loại</th>
                                <th>Chi tiết</th>
                                <th>Thời gian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $index => $item)
                                <tr>
                                    <td>{{ $data->firstItem() + $index }}</td>
                                    <td>
                                        <strong>{{ $item->name }}</strong><br>
                                        <small class="text-muted">{{ $item->phone }}</small><br>
                                        <small class="text-muted">{{ $item->email }}</small>
                                    </td>
                                    <td>{{ $item->message }}</td>
                                    <td>
                                        @for ($i = 0; $i < 5; $i++)
                                            <i class="fa{{ $i < $item->rating ? 's' : 'r' }} fa-star text-warning"></i>
                                        @endfor
                                        <span class="ms-1">({{ $item->rating }}/5)</span>
                                    </td>
                            
                                    <td>
                                        @if ($item->status === 'pending')
                                            <span class="badge bg-secondary">Chưa xử lý</span>
                                        @elseif ($item->status === 'responded')
                                            <span class="badge bg-success">Đã phản hồi</span>
                                        @elseif ($item->status === 'hidden')
                                            <span class="badge bg-danger" style="color: aliceblue">Spam</span>
                                        @endif
                                    </td>
                             
                            <td>
                                <a href="{{ route('admin.contacts.show', $item->id) }}" class="btn btn-sm btn-info">Chi
                                    tiết</a>
                            </td>
                            <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Không có dữ liệu</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {!! $data->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>
    </div>
</div>
