@extends('8x.layouts.main')
@section('title', trans('blog::blog.blog_categories'))

@section('content')
    @include('blog::blog_categories.index-content')
@endsection

@push('footer-scripts')
    @include('blog::blog_categories.index-scripts')
@endpush