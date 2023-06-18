@extends('8x.layouts.main')

@section('title', __('settings::settings.settings'))

@section('content')
    @include('settings::settings.settings-content')
@endsection

@push('footer-scripts')
    @include('settings::settings.settings-scripts')
@endpush