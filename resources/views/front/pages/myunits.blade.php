@extends('front.layouts.main')
@php
       $page_name ='';
      @endphp
@section('content')
    <section class="index-page user-properties-page my-5">
        <div class="container">
            @include('front.partials.profile.myunits')
        </div> <!-- ./ container -->
    </section> <!-- ./ compare-page -->
@endsection