@extends('8x.layouts.main')
@section('title', trans('contactus::contact_us.contact'))

@section('content')
    @include('contactus::contactus.index-content')
@endsection

@push('footer-scripts')
    @include('contactus::contactus.index-scripts')
@endpush