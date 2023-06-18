@extends('8x.layouts.main')
@section('title', trans('settings::settings.logos'))

@section('content')
    @include('settings::logos.index-content')
@endsection

@push('footer-scripts')
    @include('settings::logos.index-scripts')
@endpush