@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.create_purpose'))

@section('content')
    @include('inventory::purposes.create-content')
@endsection

@push('footer-scripts')
    @include('inventory::purposes.create-scripts')
@endpush