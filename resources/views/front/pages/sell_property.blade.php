@extends('front.layouts.main')

@foreach($seo as $sell_unit)
      @if($sell_unit->page == 'sell_unit')
            @include('front.components.meta',['meta' => $sell_unit])
        @break
      @endif
@endforeach

@section('content')
    @include('front.partials.home.sell-from')
@endsection
