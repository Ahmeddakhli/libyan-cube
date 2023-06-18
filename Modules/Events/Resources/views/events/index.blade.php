@extends('8x.layouts.main')
@section('title', trans('events::event.events'))

@section('content')
    @include('events::events.index-content')
@endsection

@push('footer-scripts')
    @include('events::events.index-scripts')
@endpush