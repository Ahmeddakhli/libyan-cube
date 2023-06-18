@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.payment_methods'))

@section('content')
    @include('inventory::payment_methods.index-content')
@endsection

@push('footer-scripts')
    @include('inventory::payment_methods.index-scripts')
@endpush