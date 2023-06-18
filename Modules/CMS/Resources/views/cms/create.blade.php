@extends('8x.layouts.main')
@section('title', trans('cms::cms.create_term'))

@section('content')
    @include('cms::cms.create-content')
@endsection

@push('footer-scripts')
    @include('cms::cms.create-scripts')
@endpush