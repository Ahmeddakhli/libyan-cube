@extends('8x.layouts.main')
@section('title', trans('settings::settings.create_contact'))

@section('content')
    @include('settings::contacts.create-content')
@endsection

@push('footer-scripts')
    @include('settings::contacts.create-scripts')
@endpush