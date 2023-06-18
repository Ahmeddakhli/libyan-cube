@extends('8x.layouts.main')
@section('title', trans('locations::locations.create_location'))

@section('content')
    @include('locations::locations.create-content')
@endsection

@push('footer-scripts')
    @include('locations::locations.create-scripts')
@endpush