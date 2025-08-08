@extends('admin.layouts.master')
@section('module', 'Booking')
@section('action', 'Danh sách')

@section('admin-content')
    <div class="" id="booking-list-wrapper">
        @include('admin.bookings.partials.filter')
        @include('admin.bookings.partials.table')
    </div>
@endsection
@push('scripts')
    @include('admin.bookings.partials.script')
@endpush
