@extends('8x.layouts.main')
@section('title', trans('seo::seo.seo'))

@section('content')
    @include('seo::seo.index-content')
@endsection

@push('footer-scripts')
    @include('seo::seo.index-scripts')
@endpush