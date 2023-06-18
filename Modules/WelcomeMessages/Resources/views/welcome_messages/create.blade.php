@extends('8x.layouts.main')
@section('title', trans('welcome_messages::welcome_messages.create_welcome_message'))

@section('content')
    @include('welcome_messages::welcome_messages.create-content')
@endsection

@push('footer-scripts')
    @include('welcome_messages::welcome_messages.create-scripts')
@endpush