@extends('front.layouts.main')


@push('header-scripts')
@endpush
@php
$page_name = 'about';
@endphp
@foreach($seo as $seo_about)
        @if($seo_about->page == 'about')
                @include('front.components.meta',['meta' => $seo_about])
        @break
        @endif
@endforeach
@section('content')
        @include('front.partials.about.about')
@endsection