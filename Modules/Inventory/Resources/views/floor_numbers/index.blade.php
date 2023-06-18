@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.floor_numbers'))

@section('content')
    @include('inventory::floor_numbers.index-content')
@endsection

@push('footer-scripts')
    @include('inventory::floor_numbers.index-scripts')
@endpush