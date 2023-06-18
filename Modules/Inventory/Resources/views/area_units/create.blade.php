@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.create_area_unit'))

@section('content')
    @include('inventory::area_units.create-content')
@endsection

@push('footer-scripts')
    @include('inventory::area_units.create-scripts')
@endpush