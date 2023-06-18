@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.bathrooms'))

@section('content')
    @include('inventory::bathrooms.index-content')
@endsection

@push('footer-scripts')
    @include('inventory::bathrooms.index-scripts')
@endpush