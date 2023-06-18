@extends('8x.layouts.main')
@section('title', trans('settings::settings.top_agents'))

@section('content')
    @include('settings::top_agents.index-content')
@endsection

@push('footer-scripts')
    @include('settings::top_agents.index-scripts')
@endpush