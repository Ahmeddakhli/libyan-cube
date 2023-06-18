@extends('8x.layouts.main')
@section('title', trans('settings::settings.create_branch'))

@section('content')
    @include('settings::branches.create-content')
@endsection

@push('footer-scripts')
    @include('settings::branches.create-scripts')
@endpush