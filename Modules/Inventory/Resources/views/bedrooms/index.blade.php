@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.bedrooms'))

@section('content')
    @include('inventory::bedrooms.index-content')
@endsection

@push('footer-scripts')
    @include('inventory::bedrooms.index-scripts')
@endpush