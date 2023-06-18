@extends('8x.layouts.main')
@section('title', trans('tags::tags.tags'))

@section('content')
    @include('tags::tags.index-content')
@endsection

@push('footer-scripts')
    @include('tags::tags.index-scripts')
@endpush