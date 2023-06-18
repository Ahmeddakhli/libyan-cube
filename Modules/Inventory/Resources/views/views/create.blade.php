@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.create_view'))

@section('content')
    @include('inventory::views.create-content')
@endsection

@push('footer-scripts')
    @include('inventory::views.create-scripts')
@endpush