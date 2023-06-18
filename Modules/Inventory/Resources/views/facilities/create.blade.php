@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.create_facility'))

@section('content')
    @include('inventory::facilities.create-content')
@endsection

@push('footer-scripts')
    @include('inventory::facilities.create-scripts')
@endpush