@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.area_units'))

@section('content')
    @include('inventory::area_units.index-content')
@endsection

@push('footer-scripts')
    @include('inventory::area_units.index-scripts')
@endpush