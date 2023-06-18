@extends('front.layouts.main')
@php
       $page_name ='';
      @endphp
@section('content')
    <section class="loginform-page py-5">
        <div class="container">
            <!--  STRAT BREADCRUMB  -->
            <nav id="breadcrumb" class='mb-3'>
                <ul>
                    <li><a href="{{route('front.home')}}">
                            <ion-icon name="home-outline"></ion-icon>
                        </a></li>
                    <li class="active"><a>{{__('auth.login')}}</a></li>
                </ul>
            </nav> <!-- #/ breadcrumb-->
            <!--  END BREADCRUMB  -->
            <div class="row align-items-start">
                <div class="col-12 col-lg-6">
                    <div class="logpage">
                        @include('front.partials.login.login')
                        @include('front.partials.login.register')
                        <!-- ./ register -->
                    </div> <!-- ./ logpage -->
                </div> <!-- ./ col-12 col-lg-6 -->
                <div class="col-lg-6">
                    <div class="bg d-none d-lg-block">
                        <img class='img-fluid' src="{{URL::asset('front/images/log.jpg')}}" alt="login">
                    </div>
                    <div class="privacy-policy mt-5 mt-lg-0">
                        <!-- <p>
                            By clicking 'Create Account' you confirm that you accept OSUS <a href="#">Terms and Conditions</a>.
                            Please view <a href="#">our privacy policy</a> to find out more about how we collect,
                            use and keep your data safe.
                        </p> -->
                    </div> <!-- ./ privacy-policy -->
                </div>
            </div> <!-- ./ row -->
        </div>
    </section>
@endsection