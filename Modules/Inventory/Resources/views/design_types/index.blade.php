@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.design_types'))

@section('content')
    @include('inventory::design_types.index-content')
@endsection

@push('footer-scripts')
    @include('inventory::design_types.index-scripts')
@endpush