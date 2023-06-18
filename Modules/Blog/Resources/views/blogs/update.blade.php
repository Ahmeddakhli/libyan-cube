@extends('8x.layouts.main')
@section('title', trans('blog::blog.update_blog'))

@section('content')
    @include('blog::blogs.update-content')
@endsection

@push('footer-scripts')
    @include('blog::blogs.update-scripts')
@endpush
