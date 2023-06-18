@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.offering_types'))

@section('content')
    @include('inventory::offering_types.index-content')
@endsection

@push('footer-scripts')
    @include('inventory::offering_types.index-scripts')
@endpush