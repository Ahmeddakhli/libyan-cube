<!-- Error -->
@extends('8x.layouts.main')
@section('contents')
    <div class="row justify-content-md-center alert-row" style="margin-top:15px;">
        <div class="col-lg-10 m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
            <div class="m-alert__icon">
                <i class="la la-warning"></i>
                <span></span>
            </div>
            <div class="m-alert__text">
                <strong>{{trans('main.error')}}!</strong> {{$error}}
            </div>
        </div>
    </div>
@endsection