@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.views'))

@section('content')
    @include('inventory::views.index-content')
@endsection

@push('footer-scripts')
    @include('inventory::views.index-scripts')
@endpush