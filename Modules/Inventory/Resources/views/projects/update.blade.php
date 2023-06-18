@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.update_project'))

@section('content')
    @include('inventory::projects.update-content')
@endsection

@push('footer-scripts')
    @include('inventory::projects.update-scripts')
@endpush
