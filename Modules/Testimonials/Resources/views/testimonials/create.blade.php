@extends('8x.layouts.main')
@section('title', trans('testimonials::testimonial.create_testimonial'))

@section('content')
    @include('testimonials::testimonials.create-content')
@endsection

@push('footer-scripts')
    @include('testimonials::testimonials.create-scripts')
@endpush