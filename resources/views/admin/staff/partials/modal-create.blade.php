<div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.techs.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Thêm người dùng</h5>
                <button type="button" class="btn-close btn btn-danger" data-bs-dismiss="modal">X</button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Họ tên</label>
                    <input type="text" name="name" placeholder="Nhập thông tin họ tên nhân viên."
                        class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Nhập thông tin email nhân viên."
                        class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Mật khẩu</label>
                    <input type="password" name="password" placeholder="Nhập thông tin mật khẩu mới."
                        class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Nhập lại mật khẩu</label>
                    <input type="password" name="password_confirmation" placeholder="Nhập lại thông tin mật khẩu."
                        class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Số điện thoại</label>
                    <input type="text" name="phone" placeholder="Nhập thông tin số điện thoại."
                        class="form-control">
                </div>
                <div class="mb-3">
                    <label>Ảnh đại diện</label>
                    <input type="file" name="photo" class="form-control">
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="is_active" class="form-label">Trạng thái</label>
                        <select name="is_active" id="is_active" class="form-select selectric" required>
                            <option value="active">Kích hoạt</option>
                            <option value="inactive">Tạm khóa</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="group_role" class="form-label">Vai trò</label>
                        <select name="group_role" id="group_role" class="form-select selectric" required>
                            <option value="User">User</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
            </div>
        </form>
    </div>
</div>
