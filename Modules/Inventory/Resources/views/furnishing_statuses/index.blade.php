@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.furnishing_statuses'))

@section('content')
    @include('inventory::furnishing_statuses.index-content')
@endsection

@push('footer-scripts')
    @include('inventory::furnishing_statuses.index-scripts')
@endpush