@extends('frontend.index')
@section('content')
    <div class="hero parallaxie">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="hero-content">
                        <div class="section-title dark-section">
                            <h3 class="wow fadeInUp">Chào mừng đến với hệ thống sửa xe </h3>
                            <h1 class="text-anime-style-3" data-cursor="-opaque">Dịch vụ mà bạn có thể tin tưởng</h1>
                        </div>
                        <div class="hero-btn wow fadeInUp" data-wow-delay="0.2s">
                            <a href="{{ route('booking') }}" class="btn-default" id="btnBooking">Đặt lịch ngay</a>
                            <a href="{{ route('contact') }}" class="btn-default btn-highlighted" id="btnContact">Liên hệ
                                ngay</a>
                        </div>

                        <style>
                            .disabled {
                                cursor: not-allowed !important;
                                opacity: 0.6;
                                user-select: none;
                            }
                        </style>


                        <div class="hero-list wow fadeInUp" data-wow-delay="0.4s">
                            <ul>
                                <li>Dịch vụ sửa chữa khẩn cấp 24/7.</li>
                                <li>Đặt lịch, đến đúng giờ, tận nơi.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="client-slider bg-radius-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="client-slider-boxes">
                        <div class="client-slider-box">
                            <div class="swiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="client-logo">
                                            <img src="{{ asset('fe/images/client-logo-1.svg') }}" alt="">
                                        </div>
                                    </div>

                                    <div class="swiper-slide">
                                        <div class="client-logo">
                                            <img src="{{ asset('fe/images/client-logo-2.svg') }}" alt="">
                                        </div>
                                    </div>

                                    <div class="swiper-slide">
                                        <div class="client-logo">
                                            <img src="{{ asset('fe/images/client-logo-1.svg') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="scroll-down-circle-box">

                            <div class="scroll-circle-text">
                                <figure>
                                    <img src="{{ asset('fe/images/scroll-circle-text.svg') }}" alt="">
                                </figure>

                                <div class="scroll-down-arrow">
                                    <a href="#about-us">
                                        <i class="fa-solid fa-arrow-down"></i>
                                    </a>
                                </div>

                            </div>

                        </div>

                        <div class="client-slider-box">
                            <div class="swiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="client-logo">
                                            <img src="{{ asset('fe/images/client-logo-1.svg') }}" alt="">
                                        </div>
                                    </div>

                                    <div class="swiper-slide">
                                        <div class="client-logo">
                                            <img src="{{ asset('fe/images/client-logo-2.svg') }}" alt="">
                                        </div>
                                    </div>

                                    <div class="swiper-slide">
                                        <div class="client-logo">
                                            <img src="{{ asset('fe/images/client-logo-1.svg') }}" alt="">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="about-us" id="about-us">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-us-content">

                        <div class="section-title">
                            <h3 class="wow fadeInUp">Giới thiệu</h3>
                            <h2 class="text-anime-style-3" data-cursor="-opaque">Dịch vụ sửa xe</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">
                                Chúng tôi cung cấp dịch vụ sửa xe máy chuyên nghiệp với kỹ thuật chuyên môn cao của các thợ
                                có kinh nghiệm.
                            </p>
                        </div>

                        <div class="about-us-info-list">
                            <div class="about-us-info-item wow fadeInUp" data-wow-delay="0.4s">
                                <h3>Đặt lịch ngay thôi</h3>
                                <p>Dễ dàng chọn dịch vụ, xem thời gian còn trống và đặt lịch sửa xe.</p>
                            </div>

                            <div class="about-us-info-item wow fadeInUp" data-wow-delay="0.6s">
                                <h3>Hỗ trợ sửa chữa khẩn cấp</h3>
                                <p>Chúng tôi hỗ trợ xử lý các tình huống khẩn cấp để xe của bạn được sửa chữa kịp thời và an
                                    toàn.</p>
                            </div>
                        </div>

                        <div class="about-us-btn wow fadeInUp" data-wow-delay="0.8s">
                            <a href="#" class="btn-default">Tìm hiểu thêm</a>
                        </div>

                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="about-us-images">

                        <div class="about-img-1">
                            <figure class="image-anime">
                                <img src="{{ asset('fe/images/1.jpg') }}" alt="Xưởng xe máy">
                            </figure>
                        </div>

                        <div class="about-img-2">
                            <figure class="image-anime">
                                <img src="{{ asset('fe/images/2.jpg') }}" alt="Xưởng sửa chữa">
                            </figure>
                        </div>

                        <div class="company-timing">
                            <h3>Giờ mở cửa</h3>
                            <ul>
                                <li>T2 - T6<span>08:00 - 20:00</span></li>
                                <li>T7 <span>08:00 - 12:00</span></li>
                                <li>CN <span>Đã đóng cửa</span></li>
                            </ul>
                            <figure>
                                <img src="{{ asset('fe/images/icon-clock.svg') }}" alt="Opening Hours">
                            </figure>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="our-services bg-radius-section">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-6">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Dịch vụ</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Các dịch vụ sửa chữa xe máy</h2>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="section-title-content wow fadeInUp" data-wow-delay="0.2s">
                        <p>Từ thay nhớt đến bảo dưỡng toàn diện, chúng tôi cung cấp đầy đủ dịch vụ để chiếc xe của bạn luôn
                            vận hành an toàn và hiệu quả.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="service-item wow fadeInUp">
                        <div class="service-item-header">
                            <div class="icon-box">
                                <img src="{{ asset('fe/images/icon-service-1.svg') }}" alt="">
                            </div>
                            <div class="service-item-content">
                                <h3><a href="#">Thay nhớt</a></h3>
                                <p>Thay dầu nhớt định kỳ giúp động cơ hoạt động bền bỉ hơn.</p>
                            </div>
                        </div>
                        <div class="service-image">
                            <a href="#" data-cursor-text="Xem">
                                <figure class="image-anime">
                                    <img src="{{ asset('fe/images/4.jpg') }}" alt="">
                                </figure>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="service-item wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-item-header">
                            <div class="icon-box">
                                <img src="{{ asset('fe/images/icon-service-2.svg') }}" alt="">
                            </div>
                            <div class="service-item-content">
                                <h3><a href="#">Thay bugi</a></h3>
                                <p>Giúp đánh lửa tốt hơn, tiết kiệm nhiên liệu và tăng hiệu suất máy.</p>
                            </div>
                        </div>
                        <div class="service-image">
                            <a href="#" data-cursor-text="Xem">
                                <figure class="image-anime">
                                    <img src="{{ asset('fe/images/8.jpg') }}" alt="">
                                </figure>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="service-item wow fadeInUp" data-wow-delay="0.4s">
                        <div class="service-item-header">
                            <div class="icon-box">
                                <img src="{{ asset('fe/images/icon-service-3.svg') }}" alt="">
                            </div>
                            <div class="service-item-content">
                                <h3><a href="#">Sửa phanh</a></h3>
                                <p>Đảm bảo hệ thống phanh hoạt động an toàn và ổn định.</p>
                            </div>
                        </div>
                        <div class="service-image">
                            <a href="#" data-cursor-text="Xem">
                                <figure class="image-anime">
                                    <img src="{{ asset('fe/images/7.jpg') }}" alt="">
                                </figure>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="service-item wow fadeInUp" data-wow-delay="0.6s">
                        <div class="service-item-header">
                            <div class="icon-box">
                                <img src="{{ asset('fe/images/icon-service-4.svg') }}" alt="">
                            </div>
                            <div class="service-item-content">
                                <h3><a href="#">Bảo dưỡng tổng quát</a></h3>
                                <p>Kiểm tra và bảo dưỡng toàn bộ xe máy định kỳ chuyên nghiệp.</p>
                            </div>
                        </div>
                        <div class="service-image">
                            <a href="#" data-cursor-text="Xem">
                                <figure class="image-anime">
                                    <img src="{{ asset('fe/images/3.jpg') }}" alt="">
                                </figure>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="service-footer wow fadeInUp" data-wow-delay="0.8s">
                        <p>Bạn sẽ hài lòng với dịch vụ của chúng tôi. Liên hệ ngay <a href="tel:935769312">(+84)
                                935769312</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="how-it-work bg-radius-section">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-6">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Quy trình hoạt động</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Quy trình dịch vụ đơn giản của chúng tôi</h2>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="trusted-client-content">
                        <div class="trusted-client-box">
                            <div class="trusted-client-images">

                                <div class="client-image">
                                    <figure class="image-anime">
                                        <img src="{{ asset('fe/images/trusted-client-img-1.jpg') }}" alt="">
                                    </figure>
                                </div>

                                <div class="client-image">
                                    <figure class="image-anime">
                                        <img src="{{ asset('fe/images/trusted-client-img-2.jpg') }}" alt="">
                                    </figure>
                                </div>

                                <div class="client-image">
                                    <figure class="image-anime">
                                        <img src="{{ asset('fe/images/trusted-client-img-3.jpg') }}" alt="">
                                    </figure>
                                </div>

                                <div class="client-image add-more">
                                    <h3><span class="counter">60</span>+</h3>
                                </div>
                            </div>

                            <div class="trusted-client-title">
                                <h3>Được tin tưởng bởi hơn <span class="counter">1500</span> khách hàng</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="how-work-image">
                        <div class="how-work-image-title">
                            <h2>thợ sửa chữa</h2>
                        </div>

                        <figure class="image-anime">
                            <img src="{{ asset('fe/images/how-work-image.jpg') }}" alt="">
                        </figure>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="how-work-steps">
                        <div class="how-work-step-item wow fadeInUp">
                            <div class="icon-box">
                                <img src="{{ asset('fe/images/icon-service-1.svg') }}" alt="">
                            </div>
                            <div class="how-work-step-content">
                                <h3><span>01.</span> Sửa chữa xe</h3>
                                <p>Chẩn đoán và khắc phục các sự cố điện nhằm đảm bảo an toàn và hoạt động ổn định.</p>
                            </div>
                        </div>

                        <div class="how-work-step-item wow fadeInUp" data-wow-delay="0.2s">
                            <div class="icon-box">
                                <img src="{{ asset('fe/images/icon-service-2.svg') }}" alt="">
                            </div>
                            <div class="how-work-step-content">
                                <h3><span>02.</span> Dịch vụ chuyên nghiệp</h3>
                                <p>Nhân viên tay nghề cao đến đúng giờ với đầy đủ dụng cụ, thực hiện công việc nhanh chóng.
                                </p>
                            </div>
                        </div>

                        <div class="how-work-step-item wow fadeInUp" data-wow-delay="0.4s">
                            <div class="icon-box">
                                <img src="{{ asset('fe/images/icon-service-3.svg') }}" alt="">
                            </div>
                            <div class="how-work-step-content">
                                <h3><span>03.</span> Kiểm tra chất lượng</h3>
                                <p>Sau khi hoàn thành, chúng tôi kiểm tra chất lượng để đảm bảo đạt tiêu chuẩn và sự hài
                                    lòng của bạn.</p>
                            </div>
                        </div>

                        <div class="how-work-step-item wow fadeInUp" data-wow-delay="0.6s">
                            <div class="icon-box">
                                <img src="{{ asset('fe/images/icon-service-4.svg') }}" alt="">
                            </div>
                            <div class="how-work-step-content">
                                <h3><span>04.</span> Thanh toán & chăm sóc sau dịch vụ</h3>
                                <p>Thanh toán dễ dàng với các hình thức an toàn. Chúng tôi sẽ liên hệ lại để đảm bảo bạn hài
                                    lòng.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="quick-facts bg-radius-section">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-6">
                    <div class="section-title dark-section">
                        <h3 class="wow fadeInUp">Một vài số liệu</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Số liệu nhanh về dịch vụ của chúng tôi</h2>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="section-title-content dark-section wow fadeInUp" data-wow-delay="0.2s">
                        <p>Từ sửa chữa đến nâng cấp, chúng tôi cung cấp dịch vụ toàn diện và chuyên nghiệp nhất dành cho
                            bạn.</p>
                    </div>
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-lg-3 col-md-6 col-6 order-lg-1 order-md-1 order-1">
                    <div class="fact-counter-box">
                        <div class="fact-counter-item">
                            <h3>Kinh nghiệm</h3>
                            <h2><span class="counter">25</span>+</h2>
                            <p>năm kinh nghiệm</p>
                        </div>

                        <div class="fact-counter-item">
                            <h3>Nhân sự</h3>
                            <h2><span class="counter">320</span>k</h2>
                            <p>nhân viên đang làm việc</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 order-lg-2 order-md-3 order-3">
                    <div class="quick-fact-image">
                        <img src="{{ asset('fe/images/5.png') }}" alt="">
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-6 order-lg-3 order-md-2 order-2">
                    <div class="fact-counter-box">
                        <div class="fact-counter-item">
                            <h3>Công việc</h3>
                            <h2><span class="counter">8</span>k+</h2>
                            <p>xe đã được hoàn thành</p>
                        </div>

                        <div class="fact-counter-item">
                            <h3>Khách hàng</h3>
                            <h2><span class="counter">100</span>%</h2>
                            <p>hài lòng tuyệt đối</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="our-testimonial">
        <div class="our-testimonial-box bg-radius-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="our-testimonial-image">
                            <figure class="image-anime">
                                <img src="{{ asset('fe/images/testimonial-image.jpg') }}" alt="">
                            </figure>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="testimonial-slider">
                            <div class="swiper">
                                <div class="swiper-wrapper" data-cursor-text="Drag">
                                    @foreach ($testimonials as $testimonial)
                                        <div class="swiper-slide">
                                            <div class="testimonial-item">
                                                <div class="testimonial-author-info">
                                                    <div class="testimonial-author">
                                                        <div class="author-content">
                                                            <h3>{{ $testimonial->name }}</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="testimonial-rating">
                                                    @for ($i = 0; $i < $testimonial->rating; $i++)
                                                        <i class="fa-solid fa-star"></i>
                                                    @endfor
                                                </div>
                                                <div class="testimonial-content">
                                                    <p>“{{ $testimonial->message }}”</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="testimonial-pagination"></div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="our-team bg-radius-section">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-6">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Đội ngũ kĩ thuật</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Gặp gỡ đội ngũ chuyên gia của chúng tôi</h2>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="section-btn wow fadeInUp" data-wow-delay="0.2s">
                        <a href="#" class="btn-default">Xem hết</a>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($userTech as $technician)
                    <div class="col-lg-4 col-md-6">
                        <div class="team-item wow fadeInUp">
                            <div class="team-image">
                                <a href="#" data-cursor-text="Xem">
                                    <figure class="image-anime">
                                        <img src="{{ $technician->photo ? asset($technician->photo) : asset('fe/images/team-1.jpg') }}"
                                            alt="{{ $technician->name }}">
                                    </figure>
                                </a>
                            </div>
                            <div class="team-body">
                                <div class="team-content">
                                    <h3><a href="#">{{ $technician->name }}</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    <div class="our-faqs parallaxie">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-6">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Câu hỏi thường gặp</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Những thắc mắc phổ biến từ khách hàng</h2>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="faq-accordion" id="accordion">
                        <div class="accordion-item wow fadeInUp">
                            <h2 class="accordion-header" id="heading1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                    1. Làm sao để đặt lịch sửa xe?
                                </button>
                            </h2>
                            <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="heading1"
                                data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <p>Bạn có thể đặt lịch trực tuyến qua hệ thống của chúng tôi. Chọn dịch vụ, thời gian và
                                        kỹ thuật viên phù hợp một cách dễ dàng.</p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item wow fadeInUp" data-wow-delay="0.2s">
                            <h2 class="accordion-header" id="heading2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                    2. Các kỹ thuật viên có được cấp phép không?
                                </button>
                            </h2>
                            <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2"
                                data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <p>Có, tất cả kỹ thuật viên đều có tay nghề cao, được đào tạo chuyên môn và có kinh
                                        nghiệm trong lĩnh vực sửa chữa xe.</p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item wow fadeInUp" data-wow-delay="0.4s">
                            <h2 class="accordion-header" id="heading3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                    3. Chi phí sửa chữa được tính như thế nào?
                                </button>
                            </h2>
                            <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3"
                                data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <p>Chi phí phụ thuộc vào loại dịch vụ bạn chọn, thời gian thực hiện và mức độ hư hỏng
                                        của xe. Mức giá sẽ được thông báo rõ ràng trước khi tiến hành.</p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item wow fadeInUp" data-wow-delay="0.6s">
                            <h2 class="accordion-header" id="heading4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                    4. Mỗi dịch vụ mất bao lâu để hoàn thành?
                                </button>
                            </h2>
                            <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4"
                                data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <p>Thời gian trung bình dao động từ 15 đến 60 phút tùy vào loại dịch vụ và mức độ sửa
                                        chữa. Khi đặt lịch, bạn sẽ thấy thời gian ước tính cụ thể.</p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item wow fadeInUp" data-wow-delay="0.8s">
                            <h2 class="accordion-header" id="heading5">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                    5. Khu vực nào được hỗ trợ sửa xe?
                                </button>
                            </h2>
                            <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5"
                                data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <p>Chúng tôi hỗ trợ sửa chữa tại nội thành và một số khu vực lân cận. Bạn có thể kiểm
                                        tra khu vực hỗ trợ trong phần đặt lịch.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(() => {
                const btnBooking = document.getElementById('btnBooking');
                const btnContact = document.getElementById('btnContact');

                function setLoading(btn) {
                    if (!btn) return;
                    btn.classList.add('disabled');
                    btn.style.pointerEvents = 'none';
                    btn.textContent = 'Đang tải...';
                    btn.href = 'javascript:void(0)';
                }

                function resetButton(btn, text, href) {
                    if (!btn) return;
                    btn.classList.remove('disabled');
                    btn.style.pointerEvents = 'auto';
                    btn.textContent = text;
                    btn.href = href;
                }

                setLoading(btnBooking);
                setLoading(btnContact);

                setTimeout(() => {
                    resetButton(btnBooking, 'Đặt lịch ngay', '{{ route('booking') }}');
                    resetButton(btnContact, 'Liên hệ ngay', '{{ route('contact') }}');
                }, 2000);
            }, 100);
        });
    </script>
@endpush
