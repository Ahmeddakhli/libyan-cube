@extends('8x.layouts.main')
@section('title', trans('testimonials::testimonial.testimonials'))

@section('content')
    @include('testimonials::testimonials.index-content')
@endsection

@push('footer-scripts')
    @include('testimonials::testimonials.index-scripts')
@endpush