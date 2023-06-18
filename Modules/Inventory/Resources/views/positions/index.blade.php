@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.positions'))

@section('content')
    @include('inventory::positions.index-content')
@endsection

@push('footer-scripts')
    @include('inventory::positions.index-scripts')
@endpush