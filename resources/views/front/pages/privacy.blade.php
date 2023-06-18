@extends('front.layouts.main')
@php
      $page_name ='';
@endphp
@foreach($seo as $privacy)
      @if($privacy->page == 'privacy')
            @include('front.components.meta',['meta' => $privacy])
        @break
      @endif
@endforeach
@push('header-scripts')
@endpush
@section('content')
      @include('front.partials.privacy.privacy')
@endsection