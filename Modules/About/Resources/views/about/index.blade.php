@extends('8x.layouts.main')
@section('title', trans('about::about.about_us_sections'))

@section('content')
    @include('about::about.index-content')
@endsection

@push('footer-scripts')
    @include('about::about.index-scripts')
@endpush