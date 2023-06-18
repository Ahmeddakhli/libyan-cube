@extends('8x.layouts.main')
@section('title', trans('cms::cms.create_privacy'))

@section('content')
    @include('cms::privacy.create-content')
@endsection

@push('footer-scripts')
    @include('cms::privacy.create-scripts')
@endpush