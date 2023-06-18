@extends('front.layouts.main')

@foreach($seo as $seo_developer)
      @if($seo_developer->page == 'developers')
            @include('front.components.meta',['meta' => $seo_developer])
      @break
      @endif
@endforeach
@push('header-scripts')
@endpush
@section('content')
	@include('front.partials.developers.developers')
@endsection  