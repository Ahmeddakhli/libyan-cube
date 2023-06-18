@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.phases'))

@section('content')
    @include('inventory::phases.index-content')
@endsection

@push('footer-scripts')
    @include('inventory::phases.index-scripts')
@endpush