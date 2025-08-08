    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Tổng người dùng</h4>
                    </div>
                    <div class="card-body">{{ $totalUsers }}</div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="fas fa-th"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Tổng Dịch Vụ</h4>
                    </div>
                    <div class="card-body">{{ $totalServices }}</div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Tổng đơn đặt lịch</h4>
                    </div>
                    <div class="card-body">{{ $totalBookings }}</div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-star text-warning"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>
                            @if ($ratingFilter)
                                Tổng đánh giá {{ $ratingFilter }} sao
                            @else
                                Tất cả đánh giá (1-5)
                            @endif
                        </h4>
                    </div>
                    <div class="card-body">
                        {{ $countRatingFiltered }}
                    </div>
                </div>
            </div>
        </div>

    </div>