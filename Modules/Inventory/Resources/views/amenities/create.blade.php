@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.create_amenity'))

@section('content')
    @include('inventory::amenities.create-content')
@endsection

@push('footer-scripts')
    @include('inventory::amenities.create-scripts')
@endpush