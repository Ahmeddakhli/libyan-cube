@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.create_furnishing_status'))

@section('content')
    @include('inventory::furnishing_statuses.create-content')
@endsection

@push('footer-scripts')
    @include('inventory::furnishing_statuses.create-scripts')
@endpush