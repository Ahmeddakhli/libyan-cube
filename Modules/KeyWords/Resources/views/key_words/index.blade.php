@extends('8x.layouts.main')
@section('title', trans('key_words::key_words.key_words'))

@section('content')
    @include('key_words::key_words.index-content')
@endsection

@push('footer-scripts')
    @include('key_words::key_words.index-scripts')
@endpush