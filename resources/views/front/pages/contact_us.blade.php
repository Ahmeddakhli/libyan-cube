@extends('front.layouts.main')

@push('header-scripts')
@endpush
@php
$page_name = 'contact';
@endphp
@foreach($seo as $seo_contact)
        @if($seo_contact->page == 'contact')
                @include('front.components.meta',['meta' => $seo_contact])
        @break
        @endif
@endforeach
@section('content')
    @include('front.partials.contact_us.contact_us')
@endsection