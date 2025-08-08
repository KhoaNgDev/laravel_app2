<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.service.update') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Sửa Dịch Vụ</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">

                    <div class="form-group">
                        <label for="edit-name">Tên dịch vụ</label>
                        <input type="text" name="service_name" id="edit-name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="edit-duration">Thời gian (phút)</label>
                        <input type="number" name="duration" id="durationInput" class="form-control" required
                            min="0" onkeydown="return event.key !== '-'">
                    </div>

                    <div class="form-group">
                        <label for="edit-description">Mô tả</label>
                        <textarea name="description" id="edit-description" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript">
        document.getElementById('durationInput').addEventListener('input', function() {
            if (this.value < 0) this.value = Math.abs(this.value);
        });
    </script>
@endpush
