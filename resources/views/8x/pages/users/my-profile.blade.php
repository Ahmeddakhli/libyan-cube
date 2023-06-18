@extends('8x.layouts.main')
@section('title', trans('users.my_profile'))

@section('content')
    @include('8x.pages.users.my-profile-content')
@endsection

@push('footer-scripts')
    @include('8x.pages.users.my-profile-scripts')
@endpush