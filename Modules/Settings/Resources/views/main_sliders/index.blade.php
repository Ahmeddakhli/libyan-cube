@extends('8x.layouts.main')
@section('title', trans('settings::settings.mainsliders'))

@section('content')
    @include('settings::main_sliders.index-content')
@endsection

@push('footer-scripts')
    @include('settings::main_sliders.index-scripts')
@endpush