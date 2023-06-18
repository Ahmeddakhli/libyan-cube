@extends('8x.layouts.main')
@section('title', trans('contactus::contact_us.subscribes'))

@section('content')
    @include('contactus::subscribes.index-content')
@endsection

@push('footer-scripts')
    @include('contactus::subscribes.index-scripts')
@endpush