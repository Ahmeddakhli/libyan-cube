@extends('front.layouts.main')

@section('page_name')
    {{ $developer['developer']->meta_title }}
    {{ strlen($developer['developer']->meta_title) < 67 ? '-' . $developer['developer']->projects_count : '' }}
@endsection
@php
$page_name = '';
@endphp
@push('meta')
    <meta name="title"
        content="{{ $developer['developer']->meta_title? $developer['developer']->meta_title: $developer['developer']->developer }} - {{ $developer['developer']->projects_count }}" />
    <meta name="description"
        content="{{ $developer['developer']->meta_description? $developer['developer']->meta_description: strip_tags(substr($developer['developer']->description, 0, 150)) }}" />
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name"
        content="{{ $developer['developer']->meta_title? $developer['developer']->meta_title: $developer['developer']->developer }}  ({{ $developer['developer']->projects_count }})" />
    <meta itemprop="image" content="{{ URL::asset('/front/images/logo.png') }}">
    <meta itemprop="description"
        content="{{ $developer['developer']->meta_description? $developer['developer']->meta_description: strip_tags(substr($developer['developer']->description, 0, 150)) }}" />
    <!-- Twitter Card data -->
    <meta name='twitter:app:country' content='EG' />
    <meta name="twitter:site" content="@advisors" />
    <meta name="twitter:creator" content="@advisors" />
    <meta name="twitter:title"
        content="{{ $developer['developer']->meta_title? $developer['developer']->meta_title: $developer['developer']->developer }}  ({{ $developer['developer']->projects_count }})">
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:image" content="{{ URL::asset('/front/images/logo.png') }}">
    <meta name="twitter:description"
        content="{{ $developer['developer']->meta_description? $developer['developer']->meta_description: strip_tags(substr($developer['developer']->description, 0, 150)) }}" />
    <!-- Open Graph data -->
    <meta property="og:type" content="article" />
    <meta property="og:site_name" content="Constguide">
    <meta property="og:url" content="{{ Request::url() }}" />
    <meta property="og:title"
        content="{{ $developer['developer']->meta_title? $developer['developer']->meta_title: $developer['developer']->developer }}  ({{ $developer['developer']->projects_count }})" />
    <meta property="og:image" content="{{ URL::asset('/front/images/logo.png') }}">
    <meta property="og:description"
        content="{{ $developer['developer']->meta_description? $developer['developer']->meta_description: strip_tags(substr($developer['developer']->description, 0, 150)) }}" />
@endpush

@section('content')
    @include('front.partials.developers.developer')
@endsection
