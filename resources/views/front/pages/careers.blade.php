@extends('front.layouts.main')

@push('header-scripts')
@endpush

@php
 $page_name = 'careers';
@endphp
@foreach($seo as $seo_career)
        @if($seo_career->page == 'careers')
                @include('front.components.meta',['meta' => $seo_career])
        @break
        @endif
@endforeach
@section('content')
        @include('front.partials.careers.careers')
@endsection