@extends('admin.layouts.master')
@section('module', 'Dịch Vụ')
@section('action', 'Danh sách')
@include('admin.services.partial.modal-create')
@include('admin.services.partial.modal-edit')
@section('admin-content')
    @include('admin.layouts.partials.search')
    @include('admin.services.partial.table')
@endsection
@push('scripts')
    <script type="text/javascript">
        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.getElementById('edit-id').value = this.dataset.id;
                document.getElementById('edit-name').value = this.dataset.name;
                document.getElementById('edit-duration').value = this.dataset.duration;
                document.getElementById('edit-description').value = this.dataset.description;
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const addModalEl = document.getElementById('addModal');

            if (addModalEl) {
                addModalEl.addEventListener('show.bs.modal', function() {
                    addModalEl.querySelector('form').reset();
                });
            }

            @if ($errors->any())
                let modal = new bootstrap.Modal(addModalEl);
                modal.show();
            @endif
        });

        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;

                Swal.fire({
                    title: 'Bạn có chắc muốn xoá?',
                    text: 'Thao tác này không thể khôi phục!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Xoá',
                    cancelButtonText: 'Huỷ'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch("{{ route('admin.service.destroy') }}", {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify({
                                    id: id
                                })
                            })
                            .then(res => res.json())
                            .then(data => {
                                if (data.status === 'success') {
                                    Swal.fire('Thành công!', data.message, 'success');
                                    document.getElementById('row-' + id).remove();
                                } else {
                                    Swal.fire('Lỗi!', data.message, 'error');
                                }
                            })
                            .catch(() => {
                                Swal.fire('Lỗi!', 'Đã xảy ra lỗi kết nối.', 'error');
                            });
                    }
                });
            });
        });
    </script>
@endpush
