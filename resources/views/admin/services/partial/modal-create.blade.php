<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="addServiceForm" method="POST" action="{{ route('admin.service.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm Dịch Vụ</h5>
                    <button type="button" class="btn-close btn btn-danger" data-bs-dismiss="modal">X</button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Tên dịch vụ</label>
                        <input type="text" name="service_name"
                            class="form-control @error('service_name') is-invalid @enderror"
                            placeholder="Nhập tên dịch vụ" value="{{ old('service_name') }}" required>
                        @error('service_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Thời gian (phút)</label>
                        <input type="number" id="durationInput" name="duration"
                            class="form-control @error('duration') is-invalid @enderror" placeholder="VD: 30"
                            value="{{ old('duration') }}" min="0" max="60" onkeydown="return event.key !== '-'" required>
                        @error('duration')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mô tả</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Ghi chú thêm">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </div>
        </form>
    </div>
</div>
@push('scripts')
    <script type="text/javascript">
        document.getElementById('durationInput').addEventListener('input', function() {
            if (this.value < 0) this.value = Math.abs(this.value);
        });
    </script>
@endpush
