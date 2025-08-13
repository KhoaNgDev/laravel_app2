@extends('admin.layouts.master')
@section('module', 'Tổng quan')
@section('action', 'Quản trị')

@section('admin-content')
    @include('admin.dashboard.partials.result')
    @include('admin.dashboard.partials.filtera')
    @include('admin.dashboard.partials.table-contacts')
    @include('admin.dashboard.partials.filterb')
    @include('admin.dashboard.partials.table-bookings')

@endsection
