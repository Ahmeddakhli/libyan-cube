@extends('front.layouts.main')

@section('page_name', __('main.thank_you'))
@php
       $page_name ='thank_you';
      @endphp
@push('header-scripts')
@endpush
@section('content')
      @include('front.partials.thank-you.sell-thank-you')
@endsection