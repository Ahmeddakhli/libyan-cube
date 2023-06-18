@extends('8x.layouts.main')
@section('title', trans('users.users'))

@section('content')
    @include('dashboard.pages.users.index-content')
@endsection

@push('footer-scripts')
    @include('dashboard.pages.users.index-scripts')
@endpush