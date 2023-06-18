@extends('8x.layouts.main')
@section('title', trans('events::event.create_event'))

@section('content')
    @include('events::events.create-content')
@endsection

@push('footer-scripts')
    @include('events::events.create-scripts')
@endpush