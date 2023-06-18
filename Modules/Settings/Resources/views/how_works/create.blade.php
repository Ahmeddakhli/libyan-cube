@extends('8x.layouts.main')
@section('title', trans('settings::settings.create_how_work'))

@section('content')
    @include('settings::settings.create-content')
@endsection

@push('footer-scripts')
    @include('settings::settings.create-scripts')
@endpush