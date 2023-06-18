@extends('8x.layouts.main')

@section('title', __('inventory::inventory.units'))

@section('content')
    @include('inventory::units.index-content')
@endsection

@push('footer-scripts')
    @include('inventory::units.index-scripts')
@endpush