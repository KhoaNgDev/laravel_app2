<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.bookings.index') }}">
            <div class="row row-cols-1 row-cols-md-3 g-3">

                <div class="col">
                    <label for="customer" class="form-label">Khách hàng</label>
                    <input type="text" id="customer" name="customer" class="form-control" placeholder="Tên khách hàng"
                        value="{{ request('customer') }}">
                </div>

                <div class="col">
                    <label for="technician" class="form-label">Thợ</label>
                    <select id="technician" name="technician_id" class="form-select selectric">
                        <option value="">-- Tất cả thợ --</option>
                        @foreach ($technicians as $tech)
                            <option value="{{ $tech->id }}"
                                {{ request('technician_id') == $tech->id ? 'selected' : '' }}>
                                {{ $tech->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <label for="status" class="form-label">Trạng thái</label>
                    <select id="status" name="status" class="form-select selectric">
                        <option value="">-- Tất cả --</option>
                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Xác nhận
                        </option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Hoàn thành
                        </option>
                        <option value="canceled" {{ request('status') == 'canceled' ? 'selected' : '' }}>Đã huỷ</option>
                    </select>
                </div>

                <div class="col">
                    <label for="month" class="form-label">Tháng</label>
                    <input type="month" id="month" name="month" class="form-control"
                        value="{{ request('month') }}">
                </div>

                <div class="col">
                    <label for="date" class="form-label">Ngày</label>
                    <input type="date" id="date" name="date" class="form-control"
                        value="{{ request('date') }}">
                </div>

                <div class="col d-flex align-items-end justify-content-start gap-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-filter"></i> Lọc
                    </button>
                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary w-100">
                        <i class="fas fa-undo"></i> Reset
                    </a>
                    <a href="{{ route('admin.bookings.export', request()->all()) }}" class="btn btn-success w-100"
                        id="exportBtn">
                        <i class="fas fa-file-excel"></i> Xuất Excel
                    </a>

                </div>

            </div>
        </form>
    </div>
</div>
@push('scripts')
    <script type="text/javascript">
        const monthInput = document.getElementById('month');
        const dateInput = document.getElementById('date');

        monthInput.addEventListener('change', function() {
            dateInput.disabled = !!this.value;
        });
        dateInput.addEventListener('change', function() {
            monthInput.disabled = !!this.value;
        });

        // Loading khi submit form lọc
        const filterForm = document.querySelector('form[action="{{ route('admin.bookings.index') }}"]');
        filterForm.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Đang lọc dữ liệu...',
                text: 'Vui lòng chờ trong giây lát',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });

            setTimeout(() => this.submit(), 10);
        });

        const exportBtn = document.getElementById('exportBtn');

        exportBtn.addEventListener('click', async function(e) {
            e.preventDefault();

            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang xuất...';
            this.classList.add('disabled');

            try {
                const response = await fetch(this.href, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (!response.ok) throw new Error('Không thể xuất Excel');

                const blob = await response.blob();
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'bookings.xlsx'; // đặt tên file
                document.body.appendChild(a);
                a.click();
                a.remove();
                window.URL.revokeObjectURL(url);
            } catch (err) {
                alert(err.message);
            } finally {
                this.innerHTML = '<i class="fas fa-file-excel"></i> Xuất Excel';
                this.classList.remove('disabled');
            }
        });
    </script>
@endpush
