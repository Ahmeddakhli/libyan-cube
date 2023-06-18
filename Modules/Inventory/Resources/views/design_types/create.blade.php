@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.create_design_type'))

@section('content')
    @include('inventory::design_types.create-content')
@endsection

@push('footer-scripts')
    @include('inventory::design_types.create-scripts')
@endpush