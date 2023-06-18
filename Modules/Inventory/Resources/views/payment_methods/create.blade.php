@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.create_payment_method'))

@section('content')
    @include('inventory::payment_methods.create-content')
@endsection

@push('footer-scripts')
    @include('inventory::payment_methods.create-scripts')
@endpush