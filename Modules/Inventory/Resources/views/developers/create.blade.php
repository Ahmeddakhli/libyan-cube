@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.create_developer'))

@section('content')
    @include('inventory::developers.create-content')
@endsection

@push('footer-scripts')
    @include('inventory::developers.create-scripts')
@endpush