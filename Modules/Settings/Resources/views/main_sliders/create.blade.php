@extends('8x.layouts.main')
@section('title', trans('settings::settings.create_main_slider'))

@section('content')
    @include('settings::settings.create-content')
@endsection

@push('footer-scripts')
    @include('settings::settings.create-scripts')
@endpush