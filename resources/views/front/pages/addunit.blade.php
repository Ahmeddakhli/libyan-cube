@extends('front.layouts.main')

@php
       $page_name ='';
      @endphp
@section('content')
    <section class="index-page add-property-page py-5">
        <div class="container">
            @include('front.partials.profile.addunit')
        </div> <!-- ./ container -->
    </section> <!-- ./ add-property-page -->
@endsection