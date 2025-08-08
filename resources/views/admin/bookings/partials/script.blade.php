<script type="text/javascript">
   const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    function updateBookingStatus(id, status, note = '', reloadUrl = window.location.href) {
        fetch(`/admin/bookings/${id}/status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ status, note })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                Swal.fire('Thành công', data.message, 'success').then(() => {
                    setTimeout(() => {
                        reloadBookingList(id, reloadUrl);
                    }, 300);
                });
            } else {
                Swal.fire('Lỗi', data.message, 'error');
            }
        })
        .catch(() => {
            Swal.fire('Lỗi', 'Có lỗi xảy ra khi gửi yêu cầu', 'error');
        });
    }

    function deleteBooking(id) {
        fetch(`/admin/bookings/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        })
        .then(res => res.json())
        .then(data => {
            Swal.fire(data.message, '', data.status === 'success' ? 'success' : 'error');
            if (data.status === 'success') {
                reloadBookingList(null, window.location.href);
            }
        })
        .catch(() => {
            Swal.fire('Lỗi kết nối!', '', 'error');
        });
    }

    function attachEventListeners() {
        document.querySelectorAll('.status-select').forEach(select => {
            select.addEventListener('change', function () {
                const id = this.dataset.id;
                const newStatus = this.value;
                const oldStatus = this.getAttribute('data-original');
                const currentUrl = window.location.href;

                if (newStatus === 'canceled') {
                    Swal.fire({
                        title: 'Xác nhận huỷ lịch đặt?',
                        input: 'textarea',
                        inputLabel: 'Ghi chú gửi khách hàng',
                        inputPlaceholder: 'Nhập lý do huỷ lịch...',
                        inputAttributes: { 'aria-label': 'Nhập ghi chú' },
                        showCancelButton: true,
                        confirmButtonText: 'Đồng ý',
                        cancelButtonText: 'Không',
                        inputValidator: value => {
                            if (!value) return 'Vui lòng nhập ghi chú';
                        }
                    }).then(result => {
                        if (result.isConfirmed) {
                            updateBookingStatus(id, newStatus, result.value, currentUrl);
                        } else {
                            this.value = oldStatus;
                        }
                    });
                } else {
                    updateBookingStatus(id, newStatus, '', currentUrl);
                }
            });
        });

        document.querySelectorAll('.delete-booking-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.dataset.id;

                Swal.fire({
                    title: 'Bạn có chắc muốn xoá?',
                    text: "Thao tác này không thể khôi phục!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Xoá',
                    cancelButtonText: 'Huỷ'
                }).then(result => {
                    if (result.isConfirmed) {
                        deleteBooking(id);
                    }
                });
            });
        });
    }

    function attachPaginationLinks() {
        document.querySelectorAll('#booking-list-wrapper .pagination a').forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                fetchBookingList(this.href);
            });
        });
    }

    function fetchBookingList(url) {
        fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.text())
        .then(html => {
            const parser = new DOMParser();
            const newDoc = parser.parseFromString(html, 'text/html');
            const newContent = newDoc.querySelector('#booking-list-wrapper');
            document.querySelector('#booking-list-wrapper').innerHTML = newContent.innerHTML;
            attachEventListeners();
            attachPaginationLinks();
        });
    }

    function reloadBookingList(highlightId = null, url = window.location.href) {
        fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.text())
        .then(html => {
            const parser = new DOMParser();
            const newDoc = parser.parseFromString(html, 'text/html');
            const newContent = newDoc.querySelector('#booking-list-wrapper');
            document.querySelector('#booking-list-wrapper').innerHTML = newContent.innerHTML;

            attachEventListeners();
            attachPaginationLinks();

            if (highlightId) {
                const row = document.querySelector(`#row-${highlightId}`);
                if (row) {
                    row.classList.add('bg-warning');
                    setTimeout(() => row.classList.remove('bg-warning'), 30000);
                } else {
                    Swal.fire('Thông báo', 'Đơn vừa cập nhật không còn trong trang hiện tại.', 'info');
                }
            }
        });
    }

    document.querySelector('#filter-form')?.addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        const queryString = new URLSearchParams(formData).toString();
        fetchBookingList(`/admin/bookings?${queryString}`);
    });

    attachEventListeners();
    attachPaginationLinks();
</script>
