@extends('8x.layouts.main')
@section('title', trans('welcome_messages::welcome_messages.welcome_messages'))

@section('content')
    @include('welcome_messages::welcome_messages.index-content')
@endsection

@push('footer-scripts')
    @include('welcome_messages::welcome_messages.index-scripts')
@endpush