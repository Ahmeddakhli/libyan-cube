@extends('8x.layouts.main')
@section('title', trans('services::services.services'))

@section('content')
    @include('services::services.index-content')
@endsection

@push('footer-scripts')
    @include('services::services.index-scripts')
@endpush