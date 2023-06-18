@extends('8x.layouts.main')
@section('title', trans('settings::settings.create_top_agent'))

@section('content')
    @include('settings::top_agents.create-content')
@endsection

@push('footer-scripts')
    @include('settings::top_agents.create-scripts')
@endpush