@extends('front.layouts.main')


@php
       $page_name ='';
      @endphp
@push('meta')
	<meta name="description" content="{{$career->meta_description}}">
	<meta name="title" content="{{$career->meta_title}}">
	<meta name="robots" content="index,follow">
	<meta property="og:url" content="{{Request::url()}}">
	<meta property="og:title" content="{{$career->meta_title}}">
	<meta property="og:description" content="{{$career->meta_description}}">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="author" content="{{ env('APP_NAME') }}">
@endpush

@section('content')
    <section class="single-career-page my-5">
        <div class="container">
            @include('front.partials.careers.career')
        </div> <!-- ./ container -->
    </section>
@endsection