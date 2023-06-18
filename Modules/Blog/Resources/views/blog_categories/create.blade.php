@extends('8x.layouts.main')
@section('title', trans('blog::blog.create_blog_category'))

@section('content')
    @include('blog::blog_categories.create-content')
@endsection

@push('footer-scripts')
    @include('blog::blog_categories.create-scripts')
@endpush