@extends('admin.layouts.master')
@section('module', 'Đánh giá')
@section('action', 'Từ khách hàng')

@section('admin-content')
    @include('admin.people.partials.filter-contact')

    @include('admin.layouts.partials.search')
    @include('admin.people.partials.contact-table')
@endsection
