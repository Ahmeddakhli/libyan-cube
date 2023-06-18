@extends('front.layouts.main')

@section('content')
    <section class="services-page my-5">
        <div class="container">
            @include('front.partials.services.services')
        </div> <!-- ./ container -->
    </section> <!-- ./ services-page -->
@endsection
@php
       $page_name ='';
      @endphp