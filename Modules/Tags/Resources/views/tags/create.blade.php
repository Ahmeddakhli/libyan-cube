@extends('8x.layouts.main')
@section('title', trans('tags::tags.create_tag'))

@section('content')
    @include('tags::tags.create-content')
@endsection

@push('footer-scripts')
    @include('tags::tags.create-scripts')
@endpush