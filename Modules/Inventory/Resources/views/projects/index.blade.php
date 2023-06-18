@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.projects'))

@section('content')
    @include('inventory::projects.index-content')
@endsection

@push('footer-scripts')
    @include('inventory::projects.index-scripts')
@endpush