@extends('8x.layouts.main')
@section('title', trans('careers::career.create_career'))

@section('content')
    @include('careers::careers.create-content')
@endsection

@push('footer-scripts')
    @include('careers::careers.create-scripts')
@endpush