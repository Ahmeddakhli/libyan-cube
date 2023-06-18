@extends('8x.layouts.main')
@section('title', trans('locations::location.locations'))

@section('content')
    @include('locations::locations.index-content')
@endsection

@push('footer-scripts')
    @include('locations::locations.index-scripts')
@endpush