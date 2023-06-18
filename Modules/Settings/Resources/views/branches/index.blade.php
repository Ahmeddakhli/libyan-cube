@extends('8x.layouts.main')
@section('title', trans('settings::settings.branches'))

@section('content')
    @include('settings::branches.index-content')
@endsection

@push('footer-scripts')
    @include('settings::branches.index-scripts')
@endpush