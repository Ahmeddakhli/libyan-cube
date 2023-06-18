@extends('front.layouts.main')

@push('header-scripts')
@endpush
@php
$page_name = 'projects';
@endphp
@foreach($seo as $seo_project)
      @if($seo_project->page == 'projects')
            @include('front.components.meta',['meta' => $seo_project])
        @break
      @endif
@endforeach
@section('content')
      @include('front.partials.projects.projects')
@endsection