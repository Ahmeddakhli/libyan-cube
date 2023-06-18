@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.purpose_types'))

@section('content')
    @include('inventory::purpose_types.index-content')
@endsection

@push('footer-scripts')
    @include('inventory::purpose_types.index-scripts')
@endpush