@extends('8x.layouts.main')
@section('title', trans('contactus::contact_us.request'))

@section('content')
    @include('contactus::requests.index-content')
@endsection

@push('footer-scripts')
    @include('contactus::requests.index-scripts')
@endpush