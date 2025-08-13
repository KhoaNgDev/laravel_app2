<div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editUserForm" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title">Cập nhật người dùng</h5>
                <button type="button" class="btn-close btn btn-danger" data-bs-dismiss="modal">X</button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="edit-id">
                <div class="mb-3">
                    <label>Họ tên</label>
                    <input type="text" name="name" placeholder="Nhập thông tin họ tên nhân viên." id="edit-name"
                        class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input readonly type="email" placeholder="Nhập thông tin email nhân viên." name="email"
                        id="edit-email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Mật khẩu mới (nếu đổi)</label>
                    <input type="password" name="password" placeholder="Nhập thông tin mật khẩu mới."
                        class="form-control">
                </div>
                <div class="mb-3">
                    <label>Nhập lại mật khẩu</label>
                    <input type="password" name="password_confirmation" placeholder="Nhập lại thông tin mật khẩu."
                        class="form-control">
                </div>
                <div class="mb-3">
                    <label>Số điện thoại</label>
                    <input type="text" name="phone" id="edit-phone" placeholder="Nhập thông tin số điện thoại."
                        class="form-control">
                </div>
                <div class="mb-3">
                    <label>Ảnh đại diện</label>
                    <input type="file" name="photo" class="form-control">
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="edit-is_active" class="form-label">Trạng thái</label>
                        <select name="is_active" id="edit-is_active" class="form-select selectric" required>
                            <option value="active">Kích hoạt</option>
                            <option value="inactive">Tạm khóa</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="edit-group_role" class="form-label">Vai trò</label>
                        <select name="group_role" id="edit-group_role" class="form-select selectric" required>
                            <option value="User">User</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="updateBtn">Cập Nhập</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
            </div>


        </form>
    </div>
</div>
@push('scripts')
    <script>
        document.getElementById('editUserForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const btn = document.getElementById('updateBtn');
            btn.disabled = true;

            // Hiển thị SweetAlert loading
            Swal.fire({
                title: 'Đang xử lý...',
                text: 'Vui lòng chờ trong giây lát',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });

            const form = e.target;

            fetch(form.action, {
                    method: form.method,
                    body: new FormData(form)
                })
                .then(async res => {
                    const data = await res.json();

                    if (res.ok) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Cập nhật thành công',
                            text: data.message || 'Thông tin người dùng đã được cập nhật.'
                        });
                        // Có thể reset form hoặc đóng modal
                        form.reset();
                        const modal = bootstrap.Modal.getInstance(document.getElementById('editUserModal'));
                        modal.hide();
                    } else {
                        // Nếu trả về lỗi validation từ Laravel
                        let errorText = '';
                        if (data.errors) {
                            for (const key in data.errors) {
                                errorText += `${data.errors[key].join(', ')}\n`;
                            }
                        } else {
                            errorText = data.message || 'Có lỗi xảy ra!';
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi',
                            html: errorText.replace(/\n/g, '<br>')
                        });
                    }
                })
                .catch(err => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi',
                        text: 'Không thể kết nối tới server!'
                    });
                })
                .finally(() => {
                    btn.disabled = false;
                });
        });
    </script>
@endpush
