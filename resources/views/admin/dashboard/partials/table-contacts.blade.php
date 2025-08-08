
<div class="card mt-4">
    <div class="card-header">
        <h5>Liên hệ từ website</h5>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Khách hàng</th>
                    <th>Sao</th>
                    <th>Đánh Giá</th>
                    <th>Ngày đánh giá</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($testimonialsPaginated as $testimonial)
                    <tr>
                        <td>{{ $testimonial->id }}</td>
                        <td>
                            <strong>{{ $testimonial->name }}</strong><br>
                            <small class="text-muted">{{ $testimonial->phone }}</small><br>
                            <small class="text-muted">{{ $testimonial->email }}</small>
                        </td>
                        <td>
                            @for ($i = 0; $i < 5; $i++)
                                <i class="fa{{ $i < $testimonial->rating ? 's' : 'r' }} fa-star text-warning"></i>
                            @endfor
                            <span class="ms-1">({{ $testimonial->rating }}/5)</span>
                        </td>
                        <td>{{ $testimonial->message }}</td>

                        <td>{{ $testimonial->created_at->format('d/m/Y H:i') }}</td>


                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Không có đánh giá nào</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>
