<form method="GET" class="row row-cols-1 row-cols-md-4 g-3 mb-4 align-items-end">
    <div class="col-md-2">
        <label for="month" class="form-label">Tháng</label>
        <select name="month" id="month" class="form-select selectric">
            @for ($m = 1; $m <= 12; $m++)
                <option value="{{ $m }}" {{ $m == $month ? 'selected' : '' }}>Tháng {{ $m }}</option>
            @endfor
        </select>
    </div>

    <div class="col-md-2">
        <label for="rating" class="form-label">Đánh giá</label>
        <select name="rating" id="rating" class="form-select selectric">
            <option value="">Tất cả</option>
            @for ($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}" {{ $ratingFilter == $i ? 'selected' : '' }}>{{ $i }} sao</option>
            @endfor
        </select>
    </div>

    {{-- Giữ giá trị Dịch vụ + Trạng thái --}}
    <input type="hidden" name="serviceFilter" value="{{ request('serviceFilter') }}">
    <input type="hidden" name="status" value="{{ request('status') }}">

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary w-100">Lọc</button>
        <a href="{{ route('admin.dashboard.index') }}" class="btn btn-outline-secondary w-100">Xoá lọc</a>
    </div>
</form>