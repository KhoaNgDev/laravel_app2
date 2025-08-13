    <!DOCTYPE html>
    <html lang="zxx">

    <head>
        @include('frontend.partials.head')
    </head>

    <body>
        @include('frontend.partials.preloader')
        @include('frontend.partials.header')
        @yield('content')
        @include('frontend.partials.footer')
        @include('frontend.partials.foot')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @stack('script')
        @if (session('success'))
            <script type="text/javascript">
                Swal.fire({
                    icon: 'success',
                    title: 'Thank you!',
                    text: '{{ session('success') }}',
                    position: 'center   ',
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true
                });
            </script>
        @endif

        @if (session('error'))
            <script type="text/javascript">
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '{{ session('error') }}',
                });
            </script>
        @endif

        @if ($errors->any())
            <script type="text/javascript">
                Swal.fire({
                    icon: 'error',
                    title: 'Có lỗi xảy ra, vui lòng kiểm tra lại.',
                    html: `{!! implode('<br>', $errors->all()) !!}`,
                });
            </script>
        @endif


    </body>

    </html>
