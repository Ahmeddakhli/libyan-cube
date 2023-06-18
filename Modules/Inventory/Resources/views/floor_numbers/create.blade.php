@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.create_floor_number'))

@section('content')
    @include('inventory::floor_numbers.create-content')
@endsection

@push('footer-scripts')
    @include('inventory::floor_numbers.create-scripts')
@endpush