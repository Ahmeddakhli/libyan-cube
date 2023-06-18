@extends('8x.layouts.main')
@section('title', trans('contactus::contact_us.create_contact'))

@section('content')
    @include('contactus::contactus.create-content')
@endsection

@push('footer-scripts')
    @include('contactus::contactus.create-scripts')
@endpush