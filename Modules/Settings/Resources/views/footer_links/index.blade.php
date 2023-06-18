@extends('8x.layouts.main')
@section('title', trans('settings::settings.footerlinks'))

@section('content')
    @include('settings::footer_links.index-content')
@endsection

@push('footer-scripts')
    @include('settings::footer_links.index-scripts')
@endpush