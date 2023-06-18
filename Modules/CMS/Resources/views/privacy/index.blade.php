@extends('8x.layouts.main')
@section('title', trans('cms::cms.privacies'))

@section('content')
    @include('cms::privacy.index-content')
@endsection

@push('footer-scripts')
    @include('cms::privacy.index-scripts')
@endpush