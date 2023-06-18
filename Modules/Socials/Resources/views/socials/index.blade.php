@extends('8x.layouts.main')
@section('title', trans('socials::social.socials'))

@section('content')
    @include('socials::socials.index-content')
@endsection

@push('footer-scripts')
    @include('socials::socials.index-scripts')
@endpush