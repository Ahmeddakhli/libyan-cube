@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.amenities'))

@section('content')
    @include('inventory::amenities.index-content')
@endsection

@push('footer-scripts')
    @include('inventory::amenities.index-scripts')
@endpush