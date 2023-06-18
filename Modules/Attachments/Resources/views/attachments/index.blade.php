@extends('8x.layouts.main')
@section('title', trans('attachments::attachments.attachments'))

@section('content')
    @include('attachments::attachments.index-content')
@endsection

@push('footer-scripts')
    @include('attachments::attachments.index-scripts')
@endpush