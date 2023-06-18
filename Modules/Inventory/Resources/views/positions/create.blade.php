@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.create_position'))

@section('content')
    @include('inventory::positions.create-content')
@endsection

@push('footer-scripts')
    @include('inventory::positions.create-scripts')
@endpush