@extends('front.layouts.main')

@section('title', trans('main.compare'))
@php
       $page_name ='';
      @endphp
@push('scripts')
@endpush
@section('content')
	        @include('front.partials.compares.compares')
@endsection