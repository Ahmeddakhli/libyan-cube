@extends('8x.layouts.main')

@section('title', __('inventory::inventory.settings'))

@section('content')
    @include('inventory::settings.settings-content')
@endsection

@push('footer-scripts')
    @include('inventory::settings.settings-scripts')
@endpush