@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.create_bedroom'))

@section('content')
    @include('inventory::bedrooms.create-content')
@endsection

@push('footer-scripts')
    @include('inventory::bedrooms.create-scripts')
@endpush