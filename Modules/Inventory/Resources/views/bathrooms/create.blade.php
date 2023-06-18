@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.create_bathroom'))

@section('content')
    @include('inventory::bathrooms.create-content')
@endsection

@push('footer-scripts')
    @include('inventory::bathrooms.create-scripts')
@endpush