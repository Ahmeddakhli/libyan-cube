@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.create_offering_type'))

@section('content')
    @include('inventory::offering_types.create-content')
@endsection

@push('footer-scripts')
    @include('inventory::offering_types.create-scripts')
@endpush