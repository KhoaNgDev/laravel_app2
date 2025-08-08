@extends('admin.layouts.master')
@section('module', 'Khách hàng')
@section('action', 'Danh sách')

@section('admin-content')
    @include('admin.layouts.partials.search')
    @include('admin.people.partials.customer-table')
@endsection
