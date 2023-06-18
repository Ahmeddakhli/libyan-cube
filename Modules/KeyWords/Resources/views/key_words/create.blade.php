@extends('8x.layouts.main')
@section('title', trans('key_words::key_words.create_key_word'))

@section('content')
    @include('key_words::key_words.create-content')
@endsection

@push('footer-scripts')
    @include('key_words::key_words.create-scripts')
@endpush