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
                                <li class="nav-item"><a class="nav-link" href="{{ route('homepage') }}">Trang chủ</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('booking') }}">Đặt lịch sửa xe</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Liên hệ</a>
                                </li>
                            </ul>
                        </div>
                        <div class="header-btn d-inline-flex">
                            <a href="{{ route('booking') }}" class="btn-default">Đặt lịch ngay</a>
                        </div>
                    </div>
                    <div class="navbar-toggle"></div>
                </div>
            </nav>
            <div class="responsive-menu"></div>
        </div>
    </header>
