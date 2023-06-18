@extends('8x.layouts.main')
@section('title', trans('messages::message.messages'))

@section('content')
    @include('messages::messages.index-content')
@endsection

@push('footer-scripts')
    @include('messages::messages.index-scripts')
@endpush