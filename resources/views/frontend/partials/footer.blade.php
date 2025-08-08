    <footer class="main-footer bg-radius-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer-header">
                        <div style="color: aliceblue" class="footer-logo">
                          Repair Services
                        </div>
                        <div class="footer-contact-box">
                            <div class="footer-contact-item">
                                <div class="icon-box">
                                    <img src="{{ asset('fe/images/icon-phone.svg') }}" alt="">
                                </div>

                                <div class="footer-contact-content">
                                    <h3>Liên hệ</h3>
                                    <p>+84 935769312</p>
                                </div>
                            </div>
                            <div class="footer-contact-item">
                                <div class="icon-box">
                                    <img src="{{ asset('fe/images/icon-mail.svg') }}" alt="">
                                </div>

                                <div class="footer-contact-content">
                                    <h3>Email</h3>
                                    <p>nguyen.anh.khoa.rcvn2012@gmail.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-footer footer-links">
                        <h3>Về công ty</h3>
                        <p>Một trang web đặt lịch sửa xe thân thiện, nơi mà cho phép khách hàng lên lịch bảo dưỡng bảo
                            trì cho "Xế hộp" yêu thích của mình hoặc là một dịch vụ sửa chữa dễ dàng, tiện lợi, nhanh
                            chóng. Đặt lịch ngay, và nhận những cập nhập mới nhất từ phía chúng tôi. 
                        </p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <div class="footer-links">
                        <h3>Liên kết nhanh</h3>
                        <ul>
                            <li><a href="{{ route('homepage') }}">trang chủ</a></li>
                            <li><a href="{{ route('booking') }}">đặt lịch</a></li>
                            <li><a href="{{ route('contact') }}">liên lạc</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <div class="footer-links">
                        <h3>hổ trợ</h3>
                        <ul>
                            <li><a href="#">Giúp đỡ</a></li>
                            <li><a href="#">Điều khoản & Họp đồng</a></li>
                            <li><a href="#">Chính sách riêng tư</a></li>
                            <li><a href="{{ route('contact') }}">Liên hệ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <div class="footer-links">
                        <h3>Theo dõi chúng tôi ngay</h3>
                        <ul>
                            <li><a href="#">facebook</a></li>
                            <li><a href="#">instagram</a></li>
                            <li><a href="#">twitter</a></li>
                            <li><a href="#">linkedin</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            @include('frontend.partials.copyright')
        </div>
    </footer>
