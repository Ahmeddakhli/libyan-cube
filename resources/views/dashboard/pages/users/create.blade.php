@extends('8x.layouts.main')
@section('title', trans('users.create_user'))

@section('content')
    @include('dashboard.pages.users.create-content')
@endsection

@push('footer-scripts')
    @include('dashboard.pages.users.create-scripts')
@endpush