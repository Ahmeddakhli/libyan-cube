@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.create_unit'))

@push('header-scripts')
    <link
        href="https://fonts.googleapis.com/css?family=Lato:300,700|Montserrat:300,400,500,600,700|Source+Code+Pro&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/image-uploader.min.css?ver=' . env('FILES_VER')) }}" />
@endpush

@section('content')
    @include('inventory::units.create-content')
@endsection

@push('header-scripts')
    @include('inventory::units.create-styles')
@endpush

@push('footer-scripts')
    @include('inventory::units.create-scripts')
@endpush
