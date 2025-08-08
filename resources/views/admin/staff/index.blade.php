@extends('admin.layouts.master')
@section('module', 'Nhân viên')
@section('action', 'Danh sách')
@include('admin.staff.partials.modal-create')
@include('admin.staff.partials.modal-edit')

@section('admin-content')
    @include('admin.layouts.partials.search')
    @include('admin.staff.partials.table')
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/axios.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.btn-edit-user').on('click', function() {
                const userId = $(this).data('id');
                const actionUrl = `/admin/techs/${userId}`;

                $('#editUserForm').attr('action', actionUrl);
                $('#edit-id').val(userId);
                $('#edit-name').val($(this).data('name'));
                $('#edit-email').val($(this).data('email'));
                $('#edit-phone').val($(this).data('phone'));
                $('#edit-is_active').val($(this).data('is_active'));
                $('#edit-group_role').val($(this).data('group_role'));

                $('#editUserModal').modal('show');
            });

            $('#editUserForm').on('submit', function(e) {
                e.preventDefault();

                const form = $(this)[0];
                const formData = new FormData(form);
                const actionUrl = $(this).attr('action');

                axios.post(actionUrl, formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        method: 'POST'
                    })
                    .then(function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Cập nhật thành công!',
                            timer: 1500,
                            showConfirmButton: false
                        });

                        $('#editUserModal').modal('hide');

                        if (typeof $('#dataTable').DataTable === 'function') {
                            $('#dataTable').DataTable().ajax.reload();
                        } else {
                            location.reload();
                        }
                    })
                    .catch(function(error) {
                        let msg = 'Đã xảy ra lỗi!';
                        if (error.response && error.response.data && error.response.data.errors) {
                            const errors = error.response.data.errors;
                            msg = Object.values(errors).flat().join('<br>');
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi cập nhật',
                            html: msg
                        });
                    });
            });
        });
    </script>
@endpush
