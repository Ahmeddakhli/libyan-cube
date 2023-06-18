@extends('8x.layouts.main')
@section('title', trans('settings::settings.how_works'))

@section('content')
    @include('settings::how_works.index-content')
@endsection

@push('footer-scripts')
    @include('settings::how_works.index-scripts')
@endpush