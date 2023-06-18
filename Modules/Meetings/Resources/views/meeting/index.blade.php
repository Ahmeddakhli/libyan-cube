@extends('8x.layouts.main')
@section('title', trans('meetings::meeting.meetings'))

@section('content')
    @include('meetings::meeting.index-content')
@endsection

@push('footer-scripts')
    @include('meetings::meeting.index-scripts')
@endpush