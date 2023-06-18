@extends('front.layouts.main')
@php
       $page_name ='';
      @endphp
@section('content')
    <section class="index-page fav-properties-page my-5">
        <div class="container">
            <!-- ./ my-fav-props-wrapper -->
            @include('front.partials.profile.favorites')
        </div> <!-- ./ container -->
    </section>
@endsection