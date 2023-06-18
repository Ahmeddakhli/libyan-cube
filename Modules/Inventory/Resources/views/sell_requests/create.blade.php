@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.create_sell_request'))

@section('content')
    @include('inventory::sell_requests.create-content')
@endsection

@push('footer-scripts')
    @include('inventory::sell_requests.create-scripts')
@endpush