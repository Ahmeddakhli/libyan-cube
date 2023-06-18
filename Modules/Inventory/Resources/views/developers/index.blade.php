@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.developers'))

@section('content')
    @include('inventory::developers.index-content')
@endsection

@push('footer-scripts')
    @include('inventory::developers.index-scripts')
@endpush