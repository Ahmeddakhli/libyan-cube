@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.create_phase'))

@section('content')
    @include('inventory::phases.create-content')
@endsection

@push('footer-scripts')
    @include('inventory::phases.create-scripts')
@endpush