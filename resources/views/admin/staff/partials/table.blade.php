<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Nhân viên</h4>
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="fa fa-plus"></i> Thêm người dùng
                </button>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="searchableTable">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Tên</th>
                                <th>SĐT</th>
                                <th>Email</th>
                                <th>Hình ảnh</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $index => $item)
                                <tr>
                                    <td>{{ $data->firstItem() + $index }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->phone ?? '-' }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        @if ($item->photo)
                                            <img src="{{ asset($item->photo) }}" alt="avatar" width="50"
                                                height="50" class="rounded-circle">
                                        @else
                                            <span class="text-muted">Chưa có</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning btn-edit-user"
                                            data-id="{{ $item->id }}" data-name="{{ $item->name }}"
                                            data-email="{{ $item->email }}" data-phone="{{ $item->phone }}"
                                            data-is_active="{{ $item->is_active }}"
                                            data-group_role="{{ $item->group_role }}">
                                            Sửa
                                        </button>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Không có dữ liệu</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-3 d-flex justify-content-center">
                        {!! $data->withQueryString()->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
