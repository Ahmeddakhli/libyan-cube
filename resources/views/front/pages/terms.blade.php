@extends('front.layouts.main')

@foreach ($seo as $seo_terms)
    @if ($seo_terms->page == 'terms')
        @include('front.components.meta',['meta' => $seo_terms])
    @break
@endif
@endforeach
@section('content')
    @include('front.partials.terms.terms')
@endsection
