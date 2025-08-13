    <header class="main-header">
        <div class="header-sticky">
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a style="color: white" class="navbar-brand" href="{{ route('homepage') }}">
                        Repair Services
                    </a>

                    <div class="collapse navbar-collapse main-menu">
                        <div class="nav-menu-wrapper">
                            <ul class="navbar-nav mr-auto" id="menu">
                                <li class="nav-item"><a class="nav-link" href="{{ route('homepage') }}">Trang chủ</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('booking') }}">Đặt lịch sửa
                                        xe</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Liên hệ</a>
                                </li>
                            </ul>
                        </div>
                        <div class="header-btn d-inline-flex">
                            <a id="btnHeaderBooking" href="{{ route('booking') }}" class="btn-default">Đặt lịch ngay</a>
                        </div>

                    </div>
                    <div class="navbar-toggle"></div>
                </div>
            </nav>
            <div class="responsive-menu"></div>
        </div>
    </header>
    @push('scripts')
        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function() {
                const btnHeaderBooking = document.getElementById('btnHeaderBooking');

                function setLoading(btn) {
                    btn.classList.add('disabled');
                    btn.style.pointerEvents = 'none';
                    btn.textContent = 'Đang tải...';
                    btn.href = 'javascript:void(0)';
                }

                function resetButton(btn, text, href) {
                    btn.classList.remove('disabled');
                    btn.style.pointerEvents = 'auto';
                    btn.textContent = text;
                    btn.href = href;
                }

                setLoading(btnHeaderBooking);

                setTimeout(() => {
                    resetButton(btnHeaderBooking, 'Đặt lịch ngay', '{{ route('booking') }}');
                }, 2000);
            });
        </script>

        <style>
            .disabled {
                cursor: not-allowed !important;
                opacity: 0.6;
                user-select: none;
            }
        </style>
    @endpush
