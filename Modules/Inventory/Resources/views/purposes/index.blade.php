@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.purposes'))

@section('content')
    @include('inventory::purposes.index-content')
@endsection

@push('footer-scripts')
    @include('inventory::purposes.index-scripts')
@endpush