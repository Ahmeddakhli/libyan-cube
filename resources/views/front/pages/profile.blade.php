@extends('front.layouts.main')
@php
       $page_name ='';
      @endphp
@section('content')
  <section class="index-page manage-profile-page py-5">
    <div class="container">
      @include('front.partials.profile.profile')
    </div> <!-- ./ container -->
  </section> 
@endsection