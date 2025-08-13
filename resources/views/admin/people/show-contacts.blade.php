@extends('admin.layouts.master')
@section('module', 'Đánh giá')
@section('action', 'Chi tiết')

@section('admin-content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Chi tiết góp ý từ khách hàng</h5>
                </div>
                <div class="card-body">
                    <p><strong>Họ tên:</strong> {{ $testimonial->name }}</p>
                    <p><strong>Email:</strong> {{ $testimonial->email }}</p>
                    <p><strong>Ngày gửi:</strong> {{ $testimonial->created_at->format('d/m/Y H:i') }}</p>

                    <p>
                        <strong>Trạng thái:</strong>
                        @if ($testimonial->status === 'pending')
                            <span class="badge bg-secondary">Chưa xử lý</span>
                        @elseif ($testimonial->status === 'hidden')
                            <span class="badge bg-danger">Spam</span>
                        @elseif ($testimonial->status === 'responded')
                            <span class="badge bg-success">Đã phản hồi</span>
                        @endif
                    </p>

                    <hr>

                    <p><strong>Nội dung:</strong></p>
                    <div class="border p-3 rounded bg-light">
                        {{ $testimonial->message }}
                    </div>

                    <hr>

                    <p><strong>Rating:</strong>
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-warning' : 'text-secondary' }}"></i>
                        @endfor
                        ({{ $testimonial->rating }} sao)
                    </p>

                    <h5 class="mt-4">Cập nhật trạng thái</h5>
                    <form action="{{ route('admin.contacts.update', $testimonial->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="status">Trạng thái xử lý</label>
                            <select name="status" id="status" class="form-control">
                                <option value="pending" {{ $testimonial->status == 'pending' ? 'selected' : '' }}>Chưa xử lý
                                </option>
                                <option value="hidden" {{ $testimonial->status == 'hidden' ? 'selected' : '' }}>Spam
                                </option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Cập nhật trạng thái</button>
                    </form>

                    <h5 class="mt-5">Phản hồi tới khách hàng</h5>
                    <form id="replyForm" method="POST" action="{{ route('admin.contacts.reply', $testimonial->id) }}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="admin_note" class="form-label">Nội dung phản hồi</label>
                            <textarea name="admin_note" class="form-control" rows="4" required>{{ old('admin_note', $testimonial->admin_note) }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-success">Gửi phản hồi qua email</button>
                    </form>

                    @if ($testimonial->admin_note)
                        <hr>
                        <p><strong>Phản hồi trước đó:</strong></p>
                        <div class="border p-3 rounded bg-white text-dark">
                            {{ $testimonial->admin_note }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('replyForm');

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Xác nhận gửi phản hồi?',
                    text: 'Phản hồi sẽ được gửi đến email của khách hàng.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Gửi phản hồi',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const formData = new FormData(form);

                        fetch(form.action, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').getAttribute('content'),
                                    'Accept': 'application/json'
                                },
                                body: formData
                            })
                            .then(res => res.json())
                            .then(data => {
                                if (data.errors) {
                                    // Nối các thông báo lỗi lại
                                    let errorText = '';
                                    for (const key in data.errors) {
                                        errorText += `${data.errors[key].join(', ')}\n`;
                                    }
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Lỗi',
                                        html: errorText.replace(/\n/g, '<br>')
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Gửi phản hồi thành công',
                                        text: data.message,
                                        timer: 2000,
                                        showConfirmButton: false
                                    }).then(() => {
                                        window.location.href =
                                            "{{ route('admin.contacts.index') }}";
                                    });
                                }
                            })

                            .catch(err => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Lỗi',
                                    text: 'Không gửi được phản hồi. Vui lòng thử lại.',
                                });
                            });
                    }
                });
            });
        });
    </script>
@endpush
