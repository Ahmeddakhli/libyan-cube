@extends('front.layouts.main')

@section('page_name')
    {{ $location['location']->meta_title ? $location['location']->meta_title : $location['location']->name }}
    {{ strlen($location['location']->meta_title ? $location['location']->meta_title : $location['location']->name) <67? '-' . count($location['results']): '' }}
@endsection

@push('meta')
    <meta name="title"
        content="{{ $location['location']->meta_title ? $location['location']->meta_title : $location['location']->name }} - {{ count($location['results']) }}" />
    <meta name="description"
        content="{{isset($type) ? __('inventory::inventory.'.$type.'s') : '' }} {{ $location['location']->meta_description? $location['location']->meta_description: $location['location']->description }}" />
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name"
        content="{{ $location['location']->meta_title ? $location['location']->meta_title : $location['location']->name }}  ({{ count($location['results']) }})" />
    <meta itemprop="image" content="{{ URL::asset('/front/images/logo.png') }}">
    <meta itemprop="description"
        content="{{ $location['location']->meta_description? $location['location']->meta_description: $location['location']->description }}" />
    <!-- Twitter Card data -->
    <meta name='twitter:app:country' content='EG' />
    <meta name="twitter:site" content="@advisors" />
    <meta name="twitter:creator" content="@advisors" />
    <meta name="twitter:title"
        content="{{ $location['location']->meta_title ? $location['location']->meta_title : $location['location']->name }}  ({{ count($location['results']) }})">
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:image" content="{{ URL::asset('/front/images/logo.png') }}">
    <meta name="twitter:description"
        content="{{ $location['location']->meta_description? $location['location']->meta_description: $location['location']->description }}" />
    <!-- Open Graph data -->
    <meta property="og:type" content="article" />
    <meta property="og:site_name" content="Constguide">
    <meta property="og:url" content="{{ Request::url() }}" />
    <meta property="og:title"
        content="{{ $location['location']->meta_title }}  ({{ count($location['results']) }})" />
    <meta property="og:image" content="{{ URL::asset('/front/images/logo.png') }}">
    <meta property="og:description" content="{{ $location['location']->meta_description }}" />
@endpush
@php
$page_name = '';
@endphp
@section('content')
    @include('front.partials.locations.location')
@endsection
