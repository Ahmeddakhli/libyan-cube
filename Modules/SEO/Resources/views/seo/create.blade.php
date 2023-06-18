@extends('8x.layouts.main')
@section('title', trans('seo::seo.create_seo'))

@section('content')
    @include('seo::seo.create-content')
@endsection

@push('footer-scripts')
    @include('seo::seo.create-scripts')
@endpush