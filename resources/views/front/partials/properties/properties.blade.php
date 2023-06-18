@php
if (Route::currentRouteName() == 'front.project.properties') {
    $filter_url = route('front.project.properties', ['project_id' => request('project_id'), 'title' => request('title')]);
} else {
    $filter_url = route('front.properties');
}
@endphp

@section('page_name', trans('main.properties'))

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('front.home')}}">{{__('main.home_title')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('main.properties') }}</li>
        </ol>
    </div>
</nav>
@endsection
<section class="index-items index-units pb-5">
    <!-- filter-holder --->
    <div class="filter-holder sticky-lg-top sticky-holder my-3">
        <div class="container">
          @include('front.components.search-box', ['url' => $filter_url])
        </div>
    </div>

    <div class="container">
        {{-- <!-- Search Result -->
        <div class="search-result pb-3">
            <h6 class="mb-0">Properties for sale in 6 October City</h6>
            <span>2481 results</span>
        </div>--}}

        <!-- Search links -->
        <div class="search-links mb-3">
            <ul class="list-group">
                @foreach ($purpose_types_values as $purpose_type_value)
                    <li class="list-group-item">
                        <a
                            href="{{ route('front.properties', ['purpose_type_ids[]' => $purpose_type_value->id]) }}">{{ $purpose_type_value->value }}</a>
                        <span class="badge ">({{ $purpose_type_value->units_count }})</span>
                    </li>
                @endforeach

            </ul>
        </div>

        <div class="section-title">
            <h4 class="title">{{__('main.properties')}}</h4>
        </div>

        <!-- view-btns-holder & sort -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="view-btns-holder">
                    <div class="nav nav-pills nav-with-indicator">
                        <button class="nav-link grid-view-btn active" data-bs-toggle="pill"
                            data-bs-target="#card-view">
                            <i class="ri-layout-grid-line"></i>
                            <span class="d-none d-sm-inline-block">{{__('main.gallary')}}</span>
                        </button>
                        <button class="nav-link list-view-btn" data-bs-toggle="pill" data-bs-target="#card-view">
                            <i class="ri-list-unordered"></i>
                            <span class="d-none d-sm-inline-block">{{__('main.list_view')}}</span>
                        </button>
                        <span class="nav-indicator"></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3 text-md-end">
                <div class="sort-filter">
                  <label>{{ __('main.order_by') }}:</label>
                  <select id="sort-select" class="form-select dd-select w-50"
                      onchange="sortUnits($(this).val())">
                      <option value="featured" @if (request('sort') == 'featured') selected @endif>
                          {{ __('main.featured') }}</option>
                      <option value="desc_price" @if (request('sort') == 'desc_price') selected @endif>
                          {{ __('main.most_expensive') }}</option>
                      <option value="asc_price" @if (request('sort') == 'asc_price') selected @endif>
                          {{ __('main.lowest_price') }}</option>
                      <option value="desc_date" @if (request('sort') == 'desc_date') selected @endif>
                          {{ __('main.latest') }} {{ __('main.properties') }}</option>
                      <option value="asc_date" @if (request('sort') == 'asc_date') selected @endif>
                          {{ __('main.the_oldest') }} {{ __('main.properties') }}</option>
                  </select>
                </div>
            </div>
        </div>

        <div class="tab-content">
            <div class="tab-pane show active" id="card-view">
                <div class="grid-wrapper">
                  @foreach ($properties as $property)
                      @include('front.components.unit', ['unit' => $property])
                  @endforeach
                </div>
            </div>
        </div>

        @if ($properties->hasPages())
            {{ $properties->appends(request()->input())->links('front.partials.primary.pagination') }}
        @endif
        {{-- <div class="related-results mt-5">
            <div class="section-title">
                <h4 class="title">Areas near 6 October City</h4>
            </div>

            <div class="swiper units-slider">
                <div class="swiper-pagination"></div>

                <div class="swiper-wrapper py-3 mt-5">
                    <div class="swiper-slide">
                        <unit-card beds="3" baths="2" img="assets/properties/prop3.jpg"
                            data-title="Mountain View Lagoon Park" purpose="Administrative" type="Office spaces"
                            price="3,500,000" area="250" dev-logo="assets/developers/logo-1.png" tag="new home"
                            phase="one">
                        </unit-card>
                    </div>

                    <div class="swiper-slide">
                        <unit-card beds="3" baths="2" img="assets/properties/prop1.jpg"
                            data-title="Mountain View Lagoon Park" purpose="Medical" type="Clinics"
                            price="2,130,000" area="230" dev-logo="assets/developers/logo-2.png" tag="Rent"
                            phase="three"></unit-card>
                    </div>

                    <div class="swiper-slide">
                        <unit-card beds="3" baths="2" img="assets/properties/prop1.jpg"
                            data-title="Mountain View Lagoon Park" purpose="Residential" type="penthouse"
                            price="3,125,000" area="200" dev-logo="assets/developers/logo-3.png" tag="Rent"
                            phase="two">
                        </unit-card>
                    </div>

                    <div class="swiper-slide">
                        <unit-card beds="3" baths="2" img="assets/properties/prop3.jpg"
                            data-title="Mountain View Lagoon Park" purpose="Residential" type="Appartment"
                            price="1,750,000" area="120" dev-logo="assets/developers/logo-4.png" tag="new home"
                            phase="one">
                        </unit-card>
                    </div>

                    <div class="swiper-slide">
                        <unit-card beds="3" baths="2" img="assets/properties/prop2.jpg"
                            data-title="Mountain View Lagoon Park" purpose="Residential" type="Villa"
                            price="3,200,000" area="170" dev-logo="assets/developers/logo-5.png" tag="Resale"
                            phase="one">
                        </unit-card>
                    </div>
                </div>

                <div class="swiper-button-next units-next-btn"></div>
                <div class="swiper-button-prev units-prev-btn"></div>
            </div>
        </div> --}}
    </div>
</section>














@push('scripts')
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_KEY') }}&callback=initMap&&libraries=places"
        defer></script>


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
            @foreach ($properties as $property)
                @if ($property->latitude && $property->longitude)
                    markers.push({
                        coords: {
                            lat: @json($property->latitude),
                            lng: @json($property->longitude)
                        },
                        iconImage: "{{ URL::asset('front/images/location-pin.svg') }}",
                        content: `@include('front.components.unit', ['unit' => $property])`,
                        label: {
                            color: '#fff',
                            fontSize: '14px',
                            fontWeight: 'bold',
                            text: '{{ $property->unit_number }}',
                        },
                        url: "{{ route('front.singleUnit', ['id' => $property->id, 'title' => str_slug($property->default_title)]) }}"
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
                    icon: props.iconImage,
                    label: props.label,
                    url: props.url
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
    </script> --}}
    <script>
        function sortUnits(sort) {
            var url = "{{ url()->full() }}";
            @if (!empty(request()->input()))
                url = url + '&sort=' + sort
            @else
                url = url + '?sort=' + sort
            @endif
            url = url.replaceAll('&amp;', '&')
            window.location = url;
        }
    </script>
@endpush
