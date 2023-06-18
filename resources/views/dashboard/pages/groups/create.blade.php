@extends('8x.layouts.main')
@section('title', trans('groups.create_group'))

@section('content')
    @include('dashboard.pages.groups.create-content')
@endsection

@push('footer-scripts')
    @include('dashboard.pages.groups.create-scripts')
@endpush