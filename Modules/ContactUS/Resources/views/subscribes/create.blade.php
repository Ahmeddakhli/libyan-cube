@extends('8x.layouts.main')
@section('title', trans('contactus::contact_us.create_subscribe'))

@section('content')
    @include('contactus::subscribes.create-content')
@endsection

@push('footer-scripts')
    @include('contactus::subscribes.create-scripts')
@endpush