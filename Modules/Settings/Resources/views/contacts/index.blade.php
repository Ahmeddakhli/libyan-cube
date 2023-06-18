@extends('8x.layouts.main')
@section('title', trans('settings::settings.contacts'))

@section('content')
    @include('settings::contacts.index-content')
@endsection

@push('footer-scripts')
    @include('settings::contacts.index-scripts')
@endpush