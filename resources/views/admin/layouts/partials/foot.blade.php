<!-- General JS Scripts -->
<script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('assets/modules/popper.js') }}"></script>
<script src="{{ asset('assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<!-- JS Libraies -->
<script src="{{ asset('assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('assets/js/page/components-table.js') }}"></script>


<!-- Template JS File -->
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
    const buttons = document.querySelectorAll('.btn-loading');

    function setLoading(btn, text = 'Đang tải...') {
        btn.classList.add('disabled');
        btn.style.pointerEvents = 'none';
        if(!btn.dataset.originalText) {
            btn.dataset.originalText = btn.textContent;
        }
        btn.textContent = text;
    }

    function resetButton(btn) {
        btn.classList.remove('disabled');
        btn.style.pointerEvents = 'auto';
        if(btn.dataset.originalText){
            btn.textContent = btn.dataset.originalText;
        }
    }

    buttons.forEach(btn => {
        const form = btn.closest('form');
        if(!form) return;

        form.addEventListener('submit', function(e){
            let firstInvalid = null;
            const requiredFields = form.querySelectorAll('input[required], textarea[required], select[required]');

            requiredFields.forEach(field => {
                if(!field.value.trim()){
                    if(!firstInvalid) firstInvalid = field;
                    const label = form.querySelector(`label[for="${field.id}"]`)?.textContent || field.name;
                    Swal.fire({
                        icon: 'warning',
                        title: 'Thiếu thông tin',
                        text: `Vui lòng nhập trường "${label}"`,
                        confirmButtonText: 'OK'
                    });
                }
            });

            if(firstInvalid){
                e.preventDefault();
                firstInvalid.focus();
                return false;
            }

            // Nếu hợp lệ, set loading tất cả button submit trong form
            form.querySelectorAll('.btn-loading').forEach(setLoading);
        });
    });

    // Reset tất cả nút khi server trả lỗi
    @if ($errors->any() || session('error'))
        buttons.forEach(btn => resetButton(btn));
    @endif
});
</script>


@include('admin.layouts.partials.modal')
@stack('scripts')
