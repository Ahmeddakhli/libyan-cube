@extends('front.layouts.main')

@php
$page_name = 'unit_types';
@endphp
@foreach($seo as $seo_unit_type)
@if($seo_unit_type->page == 'unit_types')
@include('front.components.meta',['meta' => $seo_unit_type])
@break
@endif
@endforeach
@section('page_name', $unit_type->unit_type)

@section('content')
<!-- START BREADCRUMB -->
<nav aria-label="breadcrumb">
  <div class="container">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('front.home')}}">{{__('main.home_title')}}</a></li>
      <li class="breadcrumb-item"><a href="{{route('front.projects')}}">{{__('main.projects')}}</a></li>
      <li class="breadcrumb-item"><a href="{{route('front.singleProject',['id' => $unit_type->project->id,'slug' => str_slug(($unit_type->project->default_value))])}}">{{$unit_type->project->value ? $unit_type->project->value : $unit_type->project->default_value}}</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{$unit_type->unit_type}}</li>
    </ol>
  </div>
</nav>
<!-- END BREADCRUMB -->

<div class="container mb-3">
  <div class="section-title mb-2">
    <h1 class="title text-center">
      {{$unit_type->unit_type}}
      <span>({{count($units)}} {{__('main.properties')}})</span>
    </h1>
  </div>
  @foreach($seo as $seo_unit_type)
  @if($seo_unit_type->page == 'unit_types')
  @if($seo_unit_type->show_short_description)
  @include('front.components.breif',['short_description' => $seo_unit_type->short_description])
  @endif
  @endif
  @endforeach
</div>

<div class="container py-3">
  <div class="search-box">
  <h3 class="search-title">
            <bdi>{{__('main.compare')}} +
              <span class="counter" data-min="1" data-max="{{$units_count}}" data-delay="1" data-increment="1">{{$units_count}}</span>
              {{__('main.homes_and')}} +
              <span class="counter" data-min="1" data-max="{{$projects_count}}" data-delay="1" data-increment="1">{{$projects_count}}</span>
              {{__('main.projects')}}
            </bdi>
          </h3>

    <ul class="nav nav-tabs">
      @if(request('offering_types'))
        @foreach($offering_types as $offering_type)
        @if($offering_type->is_searchable)
          @if(in_array($offering_type->id,request('offering_types')))
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#search-form" data-id="{{$offering_type->id}}" onclick="setOfferingType({{$offering_type->id}},'search-form')">{{$offering_type->offering_type}}</a>
            </li>
          @else
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#search-form" data-id="{{$offering_type->id}}" onclick="setOfferingType({{$offering_type->id}},'search-form')">{{$offering_type->offering_type}}</a>
            </li>
          @endif
        @endif
        @endforeach
      @else
        @foreach($offering_types as $offering_type)
        @if($offering_type->is_searchable)
          <li class="nav-item">
            <a class="nav-link @if($loop->index == 0) active @endif" data-toggle="tab" href="#search-form" data-id="{{$offering_type->id}}" onclick="setOfferingType({{$offering_type->id}},'search-form')">{{$offering_type->offering_type}}</a>
          </li>
        @endif
        @endforeach
      @endif
    </ul>
    <div class="tab-content mt-3">
      <div class="tab-pane fade show active" id="search-form">
        @include('front.components.search-box',['url' => route('front.properties')])
      </div>

    </div>
  </div>
</div>

<!-- START index-page  -->
<section class="index-page pb-5">
  <div class="container">
    <div class="row no-gutter">
      <div class="col-xl-9 col-lg-8">
        <div class="row no-gutter">
          <div class="col-md-4">
            <div class="type-brief mb-3">
              <p>
                {{__('main.area_from')}}:
                <strong>{{$unit_type->area_from}} م<sup>2</sup></strong>
                    {{__('main.to')}} :
                    <strong>{{$unit_type->area_to}} م<sup>2</sup></strong>
              </p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="type-brief mb-3">
              <p>
                {{__('main.price_from')}} :
                <strong>{{$unit_type->price_from}}</strong> <small>{{$unit_type->project->currency_code}}</small>
              </p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="control-view mb-3">
              <div class="view-sort">
                <label for="sort-select" class="m-0">{{__('main.order_by')}}:</label>
                <select id="sort-select" class="dd-select sort-select" onchange="sortUnits($(this).val())">
                <option value="featured" @if(request('sort') == "featured") selected @endif>{{__('main.featured')}}</option>
              <option value="desc_price" @if(request('sort') == "desc_price") selected @endif>{{__('main.most_expensive')}}</option>
              <option value="asc_price" @if(request('sort') == "asc_price") selected @endif>{{__('main.lowest_price')}}</option>
              <option value="desc_date" @if(request('sort') == "desc_date") selected @endif>{{__('main.latest')}} {{__('main.properties')}}</option>
              <option value="asc_date" @if(request('sort') == "asc_date") selected @endif>{{__('main.the_oldest')}} {{__('main.properties')}}</option>
                </select>
              </div>
              <div class="view-filters">
                <button data-view="grid-view" class="view active">
                  <i class="fa fa-th-large"></i>
                </button>
                <button data-view="list-view" class="view">
                  <i class="fas fa-bars"></i>
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="grid-view" data-container="cards-wrapper">
          @foreach($units as $property)
          @include('front.components.unit',['unit' => $property])
          @endforeach
        </div>
        @if($units->hasPages())
        {{$units->appends(request()->input())->links('front.partials.primary.pagination')}}
        @endif
        @if(count($units))
        <div class="location-map">
          <div class="section-title">
            <!-- <h2 class="title">الموقع على الخريطه</h2> -->
          </div>
          <div class="map-canvas" itemprop="geo" itemscope itemtype="https://schema.org/GeoCoordinates">
            <div id="map"></div>
          </div>
        </div>
        @endif
      </div>
      <div class="col-xl-3 col-lg-4 mb-5 mb-lg-0 order-first order-lg-last">
        <aside class="sidebar">
          <!-- <button class="show-contact-us">
                تواصل معنا
              </button> -->

          @include('front.components.contact_form',['type'=>'contact'])
        </aside>
      </div>
    </div>
  </div>
</section>
<!-- END index-page  -->

@endsection
@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_KEY') }}&callback=initMap&&libraries=places" defer></script>


<script>
  function initMap() {
    // Map options
    const options = {
      zoom: 8,
      center: {
        lat: 30.0444,
        lng: 31.2357
      }
    }

    // New map
    const map = new google.maps.Map(document.getElementById('map'), options);

    // Array of markers
    const markers = Array();
    @foreach($units as $property)
    @if($property -> latitude && $property -> longitude)
    markers.push({
      coords: {
        lat: @json($property -> latitude),
        lng: @json($property -> longitude)
      },
      iconImage: "{{URL::asset('front/images/location-pin.svg')}}",
      content: `@include('front.components.unit',['unit' => $property])`,
      url: "{{route('front.singleUnit', ['id' => $property->id,'title' => str_slug($property->default_title)])}}"
    });
    @endif

    @endforeach
    // Loop through markers
    markers.forEach((marker) => {
      addMarker(marker);
    })

    // Add Marker Function
    function addMarker(props) {
      const marker = new google.maps.Marker({
        position: props.coords,
        map: map,
        icon: props.iconImage
      });

      // Check for customicon
      if (props.iconImage) {
        // Set icon image
        marker.setIcon(props.iconImage);
      }

      // Check content
      if (props.content) {
        var infoWindow = new google.maps.InfoWindow({
          content: props.content
        });

        marker.addListener('click', function() {
          infoWindow.open(map, marker);
        });
        marker.addListener('mouseover', function() {
          infoWindow.open(map, marker);
        });
        marker.addListener('mouseout', function() {
          infoWindow.close();
        });
        marker.addListener('click', function() {
          location = props.url;
        });
      }
    }
  }
</script>
<script>
  function sortUnits(sort){
    var url = "{{route('front.properties',request()->all())}}";
    @if(!empty(request()->all()))
    url = url+'&sort='+sort
    @else
    url = url+'?sort='+sort
    @endif
    window.location = url;
  }
</script>
@endpush
