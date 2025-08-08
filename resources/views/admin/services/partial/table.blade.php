<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Dịch vụ</h4>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                    + Thêm mới
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="searchableTable">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Tên Dịch Vụ</th>
                                <th>Mô tả</th>
                                <th>Thời gian (phút)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $key => $item)
                                <tr id="row-{{ $item->id }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->service_name }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->duration }} (phút)</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning edit-btn" data-id="{{ $item->id }}"
                                            data-name="{{ $item->service_name }}" data-duration="{{ $item->duration }}"
                                            data-description="{{ $item->description }}" data-bs-toggle="modal"
                                            data-bs-target="#editModal">
                                            Sửa
                                        </button>

                                        <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $item->id }}">
                                            Xoá
                                        </button>
                                    </td>
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
