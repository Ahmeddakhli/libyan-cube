@extends('front.layouts.main')
   
@push('header-scripts')
@endpush
@php
$page_name = 'properties';
@endphp
@foreach($seo as $seo_property)
      @if($seo_property->page == 'properties')
            @include('front.components.meta',['meta' => $seo_property])
        @break
      @endif
@endforeach
@section('content')
      @include('front.partials.properties.properties')
@endsection
@push('scripts')
      <!-- ADVANCED SEARCH SCRIPT -->

@endpush