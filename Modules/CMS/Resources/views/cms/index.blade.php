@extends('8x.layouts.main')
@section('title', trans('cms::cms.terms'))

@section('content')
    @include('cms::cms.index-content')
@endsection

@push('footer-scripts')
    @include('cms::cms.index-scripts')
@endpush