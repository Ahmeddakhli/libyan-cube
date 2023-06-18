@extends('front.layouts.main')

@section('page_name')
    {{ $blog->meta_title }}
@endsection
@php
$page_name = '';
@endphp
@foreach ($blog->attachments as $attach)
    @if ($loop->index == 0)
        @php
            $attach_value = file_exists(public_path('/storage/dimensions/uploads/' . $attach->file_name_without_extension . '_560x400' . '.' . $attach->extension)) ? asset('storage/dimensions/uploads/' . $attach->file_name_without_extension . '_560x400' . '.' . $attach->extension) : $attach->url;
        @endphp
    @break
@endif
@endforeach
@push('meta')
<meta name="title" content="{{ $blog->meta_title }}" />
<meta name="description" content="{{ $blog->meta_description }}" />
<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="{{ $blog->meta_title }}" />
<meta itemprop="image" content="{{isset($attach_value) ? $attach_value : URL::asset('front/images/placeholder.png')}}">
<meta itemprop="description" content="{{ $blog->meta_description }}" />
<!-- Twitter Card data -->
<meta name='twitter:app:country' content='EG' />
<meta name="twitter:site" content="@advisors" />
<meta name="twitter:creator" content="@advisors" />
<meta name="twitter:title" content="{{ $blog->meta_title }}">
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:image" content="{{isset($attach_value) ? $attach_value : URL::asset('front/images/placeholder.png')}}">
<meta name="twitter:description" content="{{ $blog->meta_description }}" />
<!-- Open Graph data -->
<meta property="og:type" content="article" />
<meta property="og:site_name" content="Constguide">
<meta property="og:url" content="{{ Request::url() }}" />
<meta property="og:title" content="{{ $blog->meta_title }}" />
<meta property="og:image" content="{{isset($attach_value) ? $attach_value : URL::asset('front/images/placeholder.png')}}">
<meta property="og:description" content="{{ $blog->meta_description }}" />
@endpush
@push('header-scripts')
@endpush
@section('content')
@include('front.partials.blogs.single-blog')
@endsection
