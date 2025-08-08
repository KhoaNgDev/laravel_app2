<form method="GET" action="{{ route('admin.contacts.index') }}" class="mb-3 row g-2 align-items-end">
    <div class="col-md-3">
        <label class="form-label">Đánh giá</label>
        <select name="rating" class="form-select selectric" onchange="this.form.submit()">
            <option value="">-- Tất cả --</option>
            @for ($i = 5; $i >= 1; $i--)
                <option value="{{ $i }}" {{ request('rating') == $i ? 'selected' : '' }}>{{ $i }}
                    sao</option>
            @endfor
        </select>
    </div>
    <div class="col-md-3">
        <select name="status" class="form-select selectric" onchange="this.form.submit()">
            <option value="">-- Trạng thái --</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chưa xử lý</option>
            <option value="responded" {{ request('status') == 'responded' ? 'selected' : '' }}>Đã phản hồi</option>
            <option value="hidden" {{ request('status') == 'hidden' ? 'selected' : '' }}>Đã ẩn (tiêu cực)</option>
        </select>
    </div>
    <div class="col-md-3">
        <label class="form-label">Tháng</label>
        <select name="month" class="form-select selectric" onchange="this.form.submit()">
            <option value="">-- Tất cả --</option>
            @for ($m = 1; $m <= 12; $m++)
                <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                    Tháng {{ $m }}
                </option>
            @endfor
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label">Năm</label>
        <select name="year" class="form-select selectric" onchange="this.form.submit()">
            <option value="">-- Tất cả --</option>
            @for ($y = now()->year; $y >= 2020; $y--)
                <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                    {{ $y }}
                </option>
            @endfor
        </select>
    </div>
</form>
