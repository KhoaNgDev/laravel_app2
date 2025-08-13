@extends('frontend.index')
@section('module', 'đặt lịch')
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
                                <img src="{{ asset('fe/images/9.jpg') }}" alt="">
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
                            <h3 class="wow fadeInUp">Đặt lịch sửa xe của bạn.</h3>
                            <h2 class="text-anime-style-3" data-cursor="-opaque">Thông tin đặt lịch</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">
                                Vui lòng điền đầy đủ thông tin để chúng tôi phục vụ bạn một cách tốt nhất.
                                Đặt hẹn sửa xe, đặt không đến cũng không sao, chúng tôi sẽ giữ chỗ cho bạn sau 10 phút.
                            </p>
                        </div>

                        <div class="">
                            <form action="{{ route('booking.store') }}" method="POST" data-toggle="validator"
                                class="wow fadeInUp" data-wow-delay="0.4s">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6 mb-4">
                                        <input type="text" name="customer_name" class="form-control"
                                            placeholder="Họ tên khách hàng" required>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <input type="text" name="customer_phone" class="form-control"
                                            placeholder="Số điện thoại" required
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                            onkeydown="return event.key !== '-'" onpaste="return false"
                                            ondrop="return false">
                                    </div>


                                    <div class="form-group col-md-12 mb-4">
                                        <input type="email" name="customer_email" class="form-control" placeholder="Email"
                                            required>
                                    </div>
                                    <div class="form-group col-md-6 mb-4">
                                        <input type="date" name="booking_date" id="booking_date" class="form-control"
                                            required min="{{ now()->toDateString() }}">

                                    </div>
                                    <div class="form-group col-md-6 mb-4" id="service_wrapper" style="display: none;">
                                        <select name="service_id" id="service_id" class="form-select selectric" required>
                                            <option value="">-- Chọn dịch vụ --</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12 mb-4" id="time_wrapper" style="display: none;">
                                        <select name="booking_time" id="booking_time" class="form-select selectric"
                                            required>
                                            <option value="">-- Chọn giờ trống --</option>
                                        </select>
                                    </div>


                                    <div class="col-md-12">
                                        <button type="submit" class="btn-default" id="submitBtn">Đặt lịch ngay</button>
                                        <button type="button" class="btn-default" id="loadingBtn" style="display: none;"
                                            disabled>
                                            Đang đặt lịch...
                                        </button>
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
@push('script')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {

            $('#booking_date').on('change', function() {
                const date = $(this).val();

                if (date) {
                    $.get('{{ route('booking.get-services') }}', function(services) {
                        const serviceSelect = $('#service_id');
                        serviceSelect.empty().append(
                            '<option value="">-- Chọn dịch vụ --</option>');

                        if (!services || services.length === 0) {
                            alert('Không có dịch vụ nào khả dụng.');
                            $('#service_wrapper').hide();
                            $('#time_wrapper').hide();
                            return;
                        }

                        services.forEach(service => {
                            serviceSelect.append(
                                `<option value="${service.id}">${service.service_name} (${service.duration} phút)</option>`
                            );
                        });

                        $('#service_wrapper').show();
                        $('#time_wrapper').hide();
                    }).fail(function() {
                        alert('Lỗi khi tải dịch vụ.');
                    });
                }
            });

            $('#service_id').on('change', function() {
                const date = $('#booking_date').val();
                const serviceId = $(this).val();

                if (date && serviceId) {
                    $.get('{{ route('booking.free-times') }}', {
                        date: date,
                        service_id: serviceId
                    }, function(times) {
                        const timeSelect = $('#booking_time');
                        timeSelect.empty().append('<option value="">-- Chọn giờ trống --</option>');

                        if (!times || times.length === 0) {
                            alert('Không còn giờ trống cho dịch vụ này vào ngày đã chọn.');
                            $('#time_wrapper').hide();
                            return;
                        }

                        times.forEach(time => {
                            timeSelect.append(`<option value="${time}">${time}</option>`);
                        });

                        $('#time_wrapper').show();
                    }).fail(function() {
                        alert('Lỗi khi lấy giờ trống.');
                    });
                }
            });

            $('form').on('submit', function(e) {
                $('#submitBtn').hide();
                $('#loadingBtn').show();
            });


        });
        $(document).ready(function() {
    $('#submitBtn').prop('disabled', true);
    function checkFormValid() {
        const name = $('input[name="customer_name"]').val().trim();
        const phone = $('input[name="customer_phone"]').val().trim();
        const email = $('input[name="customer_email"]').val().trim();
        const date = $('#booking_date').val();
        const service = $('#service_id').val();
        const time = $('#booking_time').val();
        if (name && phone && email && date && service && time) {
            $('#submitBtn').prop('disabled', false);
        } else {
            $('#submitBtn').prop('disabled', true);
        }
    }
    $('input[name="customer_name"], input[name="customer_phone"], input[name="customer_email"], #booking_date, #service_id, #booking_time').on('input change', checkFormValid);
    checkFormValid();
    $('form').on('submit', function(e) {
        $('#submitBtn').hide();
        $('#loadingBtn').show();
    });
});
    </script>
@endpush
