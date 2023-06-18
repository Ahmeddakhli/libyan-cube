@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.facilities'))

@section('content')
    @include('inventory::facilities.index-content')
@endsection

@push('footer-scripts')
    @include('inventory::facilities.index-scripts')
@endpush