@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.create_finishing_type'))

@section('content')
    @include('inventory::finishing_types.create-content')
@endsection

@push('footer-scripts')
    @include('inventory::finishing_types.create-scripts')
@endpush