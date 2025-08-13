<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@push('scripts')
    @if (session('success'))
        <script type="text/javascript"">
                Swal.fire({
                    icon: 'success',
                    title: 'Thank you!',
                    text: '{{ session('success') }}',
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true
                });
            </script>
    @endif

    @if (session('error'))
        <script type="text/javascript"">
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '{{ session('error') }}',
                });
            </script>
    @endif

    @if ($errors->any())
        <script type="text/javascript"">
                Swal.fire({
                    icon: 'error',
                    title: 'Có lỗi xảy ra, vui lòng kiểm tra lại',
                    html: `{!! implode('<br>', $errors->all()) !!}`,
                });
            </script>
    @endif
@endpush
