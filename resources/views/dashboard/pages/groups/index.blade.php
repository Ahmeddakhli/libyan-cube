@extends('8x.layouts.main')
@section('title', trans('groups.groups'))

@section('content')
    @include('dashboard.pages.groups.index-content')
@endsection

@push('footer-scripts')
    @include('dashboard.pages.groups.index-scripts')
@endpush