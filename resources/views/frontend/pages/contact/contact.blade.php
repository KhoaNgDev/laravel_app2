@extends('frontend.index')
@section('module', 'liên lạc với chúng tôi')
@section('title', 'trang chủ')
@section('content')
    @include('frontend.pages.blocks.page-header')

    <div class="page-contact-us bg-radius-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="contact-details-box">
                        <div class="contact-us-image">
                            <figure class="image-anime">
                                <img src="{{ asset('fe/images/contact-us-img.jpg') }}" alt="">
                            </figure>
                        </div>
                        <div class="contact-info-list">
                            <div class="contact-info-item wow fadeInUp">
                                <div class="icon-box">
                                    <img src="{{ asset('fe/images/icon-phone-white.svg') }}" alt="">
                                </div>
                                <div class="contact-info-content">
                                    <p>contact:</p>
                                    <h3>+84 935 769 312</h3>
                                </div>
                            </div>
                            <div class="contact-info-item wow fadeInUp" data-wow-delay="0.2s">
                                <div class="icon-box">
                                    <img src="{{ asset('fe/images/icon-mail-white.svg') }}" alt="">
                                </div>
                                <div class="contact-info-content" style="overflow-wrap: break-word">
                                    <p>email:</p>
                                    <h3>nguyen.anh.khoa.rcvn2012@gmail.com</h3>
                                </div>
                            </div>

                            <div class="contact-info-item location-info-item wow fadeInUp" data-wow-delay="0.4s">
                                <div class="icon-box">
                                    <img src="{{ asset('fe/images/icon-location-white.svg') }}" alt="">
                                </div>
                                <div class="contact-info-content">
                                    <p>địa chỉ:</p>
                                    <h3>627 nguyễn hữu trí, tphcm</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="contact-form">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">Liên hệ chúng tôi</h3>
                            <h2 class="text-anime-style-3" data-cursor="-opaque">Giữ liên hệ với chúng tôi</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">Bạn đã có câu hỏi và đang cần sự trợ giúp? Đến với
                                chúng tôi ngay hôm này!
                                Chúng tôi ở đây cung cấp các giải pháp đến từ chuyên gia với sự hỗ trợ thân thiện.</p>
                        </div>


                        <div class="member-contect-form contact-form">
                            <form action="{{ route('contact.store') }}" id="contactForm" method="POST"
                                data-toggle="validator" class="wow fadeInUp" data-wow-delay="0.4s">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6 mb-4">
                                        <input type="text" name="name" class="form-control" id="name"
                                            placeholder="Vui lòng nhập tên của quý khách hàng." required>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <input type="text" name="phone" class="form-control" id="phone"
                                            placeholder="Phone no" required pattern="^(0[3|5|7|8|9])[0-9]{8}$"
                                            title="Số điện thoại hợp lệ, bắt đầu bằng 03, 05, 07, 08 hoặc 09, đủ 10 số"
                                            maxlength="10">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="help-block with-errors"></div>
                                    <div class="form-group col-md-12 mb-4">
                                        <input type="email" name="email" class="form-control" id="email"
                                            placeholder="Vui lòng nhập email của quý khách hàng." required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group col-md-12 mb-5">
                                        <textarea name="message" class="form-control" id="message" rows="4" placeholder="Message"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group col-md-12 mb-4">
                                        <label for="rating">Đánh giá của bạn:</label>
                                        <select name="rating" id="rating" class="form-control" required>
                                            <option value="5">⭐⭐⭐⭐⭐</option>
                                            <option value="4">⭐⭐⭐⭐</option>
                                            <option value="3">⭐⭐⭐</option>
                                            <option value="2">⭐⭐</option>
                                            <option value="1">⭐</option>
                                        </select>
                                    </div>


                                    <div class="col-md-12">
                                        <button type="submit" class="btn-default" id="submitBtn">Gửi Liên Hệ
                                            <span class="spinner-border spinner-border-sm d-none" role="status"
                                                id="loadingSpinner"></span>
                                        </button>

                                        <div id="msgSubmit" class="h3 hidden"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script type="text/javascript">
        const phoneInput = document.getElementById('phone');

        phoneInput.addEventListener('keypress', function(e) {
            const char = String.fromCharCode(e.which);
            if (!/[0-9]/.test(char)) {
                e.preventDefault();
            }
        });

        phoneInput.addEventListener('paste', function(e) {
            const pasted = (e.clipboardData || window.clipboardData).getData('text');
            if (!/^(0[3|5|7|8|9])[0-9]{0,9}$/.test(pasted)) {
                e.preventDefault();
            }
        });
        document.getElementById('contactForm').addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            const spinner = document.getElementById('loadingSpinner');

            btn.setAttribute('disabled', 'true');
            spinner.classList.remove('d-none');
        });
    </script>
@endpush
