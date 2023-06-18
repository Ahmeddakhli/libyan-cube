@extends('8x.layouts.main')
@section('title', trans('settings::settings.create_footerlink'))

@section('content')
    @include('settings::footer_links.create-content')
@endsection

@push('footer-scripts')
    @include('settings::footer_links.create-scripts')
@endpush