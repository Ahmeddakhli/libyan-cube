@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.update_unit'))

@section('content')
    @include('inventory::units.update-content')
@endsection

@push('footer-scripts')
    @include('inventory::units.update-scripts')
@endpush