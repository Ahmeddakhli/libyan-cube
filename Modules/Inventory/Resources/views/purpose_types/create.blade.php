@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.create_purpose_type'))

@section('content')
    @include('inventory::purpose_types.create-content')
@endsection

@push('footer-scripts')
    @include('inventory::purpose_types.create-scripts')
@endpush