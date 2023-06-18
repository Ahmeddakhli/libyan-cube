@extends('8x.layouts.main')
@section('title', trans('services::services.create_service'))

@section('content')
    @include('services::services.create-content')
@endsection

@push('footer-scripts')
    @include('services::services.create-scripts')
@endpush