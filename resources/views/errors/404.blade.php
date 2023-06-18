@extends('front.layouts.main')

@section('title', trans('main.404_not_found'))
@push('header-scripts')
        <link rel="stylesheet" href="{{URL::asset('front/css/home-page.min.css')}}">
@endpush
@section('content')
<section class="contact-page py-5">
    <div class="container text-center">
        <div class="row">
            <div class="col-12">
                <img class="w-50" src="{{URL::asset('front/images/404.png')}}" alt="placeholder">
            </div>
        </div>
    </div> <!-- ./ container -->
</section> <!-- ./ contact-page -->
@endsection