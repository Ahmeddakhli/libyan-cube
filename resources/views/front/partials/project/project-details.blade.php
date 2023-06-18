<div class="wrapper__block">
    <h2 class="wrapper__block--title" itemprop="name">{{ $single_project->project }}
        ({{ $single_project->units_count }}
        {{ __('main.properties') }})</h2>
    @if ($single_project->country || $single_project->region || $single_project->city || $single_project->area)
        <p class="wrapper__block--loc" itemscope itemtype="https://schema.org/Place">
            @if ($single_project->city)
                <i class="fas fa-map-marker-alt"></i>
                <a
                    href="{{ route('front.areas.show', ['id' => $single_project->city->id,'slug' => str_slug($single_project->city->default_value)]) }}">
                    <span itemprop="{{ $single_project->project }}">
                        <?php $locations_array = []; ?>
                        @if ($single_project->country)
                            <?php array_push($locations_array, $single_project->country->name); ?>
                        @endif
                        @if ($single_project->region)
                            <?php array_push($locations_array, $single_project->region->name); ?>
                        @endif
                        @if ($single_project->city)
                            <?php array_push($locations_array, $single_project->city->name); ?>
                        @endif
                        @if ($single_project->area)
                            <?php array_push($locations_array, $single_project->area->name); ?>
                        @endif
                        @if (count($locations_array))
                            {{ implode(', ', $locations_array) }}
                        @endif
                    </span>
                </a>
            @endif
        </p>
    @endif
</div>
<div class="wrapper__block">
    <nav class="menu-share-media">
        <!-- <label>{{ __('main.share_with') }} :</label> -->
        <a target="_blank"
            href="https://www.facebook.com/sharer/sharer.php?u={{ route('front.singleProject', ['id' => $single_project->id,'slug' => str_slug($single_project->default_value)]) }}"
            class="facebook"><i class="fab fa-facebook-f"></i></a>
        <a target="_blank"
            href="https://twitter.com/intent/tweet?text={{ route('front.singleProject', ['id' => $single_project->id,'slug' => str_slug($single_project->default_value)]) }}"
            class="twitter twitter-share-button"><i class="fab fa-twitter"></i></a>
        <!-- <a href="#" class="instagram" target="_blank">
            <i class="fab fa-instagram"></i>
            instagram
        </a> -->
        <a target="_blank"
            href="https://www.linkedin.com/shareArticle/?mini=true&url={{ route('front.singleProject', ['id' => $single_project->id,'slug' => str_slug($single_project->default_value)]) }}"
            class="linkedin">
            <i class="fab fa-linkedin-in"></i>

        </a>
        <a target="_blank"
            href="http://pinterest.com/pin/create/button/?url={{ route('front.singleProject', ['id' => $single_project->id,'slug' => str_slug($single_project->default_value)]) }}"
            class="pinterest">
            <i class="fab fa-pinterest-p"></i>

        </a>
    </nav>
</div>
<div class="wrapper__block">
    <ul>
        <li>
            <strong>{{ __('inventory::inventory.down_payment') }}:</strong>
            <strong>{{ $single_project->down_payment_from }}</strong> <small>%</small>
        </li>
        <li>
            <strong>{{ __('main.installments') }}:</strong>
            {{ __('main.over') }} <span>{{ $single_project->number_of_installments_from }}</span>
            {{ __('main.year') }}
        </li>
        <li>
            <strong>{{ __('inventory::inventory.delivery_date') }}:</strong>
            <span>{{ $single_project->delivery_date }}</span>
        </li>
    </ul>
</div>
<div class="links mt-4 mb-3">
    <ul>
        @if ($single_project->description)
            <li>
                <a class="go-to-section" href="#desc-section">{{ __('inventory::inventory.description') }}</a>
            </li>
        @endif
        @if ($single_project->amenities || $single_project->facilities)
            <li>
                <a class="go-to-section" href="#amenities-section">
                    {{ __('main.project_services') }}
                </a>
            </li>
        @endif
        @if ($single_project->video)
            <li>
                <a class="go-to-section" href="#video-section">{{ __('inventory::inventory.video') }}</a>
            </li>
        @endif
        @if ($single_project->latitude && $single_project->longitude)
            <li>
                <a class="go-to-section" href="#map-section">{{ __('main.map') }}</a>
            </li>
        @endif
        <!-- <li>
            <a class="go-to-section" href="#master-section">
                التقسيم الداخلى
            </a>
        </li> -->
        <!-- <li>
            <a class="go-to-section" href="#floor-section">
                المخطط العام
            </a>
        </li> -->
        <!-- <li>
            <a class="go-to-section" href="#panorama-section">
                360&#176;
            </a>
        </li> -->
    </ul>
</div>
@if ($single_project->tags)
    <div class="wrapper__block">
        <div class="wrapper__block--tags">
            <!-- <h3 class="wrapper__block--title">
            {{ __('main.tags') }}
        </h3> -->
            <div class="tags-sec mt-3">
                @foreach ($single_project->tags as $tag)
                    <span class="tag">{{ $tag->tag }}</span>
                @endforeach
            </div>
        </div>
    </div>
@endif
@if ($single_project->description)
    <div id="desc-section" class="wrapper__block">
        <h3 class="wrapper__block--title">{{ __('inventory::inventory.description') }}</h3>
        <div class="wrapper__block--desc">
            <p itemprop="description" itemprop="description">
                {!! str_replace('\\', '', $single_project->description) !!}
            </p>
        </div>
    </div>
@endif

@if (count($single_project->unit_types))
    <div class="unit-types">
        <h3 class="wrapper__block--title">{{ __('inventory::inventory.compound_unit_types') }}</h3>
        <div class="types-acc" id="types-acc">
            @foreach ($single_project->unit_types as $unit_type)
                <div class="card">
                    <div class="card-header">
                        <button class="type-title-btn" data-toggle="collapse"
                            data-target="#type-{{ $unit_type->id }}">
                            {{ $unit_type->unit_type }}
                            <span class="prop-count">(<strong>{{ count($unit_type->units) }}</strong>
                                {{ __('main.properties') }})</span>
                        </button>
                    </div>
                    <div id="type-{{ $unit_type->id }}" class="collapse  @if ($loop->index == 0) show @endif"
                        data-parent="#types-acc">
                        <div class="card-body">
                            <div class="row p-3 align-items-center">
                                <div class="col-md-7">
                                    <ul class="type-list">
                                        <li>
                                            <strong>{{ __('main.area') }}</strong>
                                            <p>{{ $unit_type->area_from }} <small>m<sup>2</sup></small> -
                                                {{ $unit_type->area_to }} <small>m<sup>2</sup></small>
                                            </p>
                                        </li>
                                        <li>
                                            <strong>{{ __('main.price') }}</strong>
                                            <p> {{ $unit_type->price_from }}
                                                <small>{{ $single_project->currency_code }}</small> -
                                                {{ $unit_type->price_to }}
                                                <small>{{ $single_project->currency_code }}</small>
                                            </p>
                                        </li>
                                        {{-- <li>
                                            <a href="{{ route('front.unit_type', ['id' => $unit_type->id, 'title' => $unit_type->unit_type]) }}"
                                                class='site-btn' target="_blank">
                                                {{ __('main.view_properties') }}
                                            </a>
                                        </li> --}}
                                    </ul>
                                </div>

                                <div class="col-md-5 d-none d-md-block">
                                    @if ($unit_type->image)
                                        <div class="type-img">
                                            <a
                                                href="{{ route('front.unit_type', ['id' => $unit_type->id, 'title' => $unit_type->unit_type]) }}">
                                                <img src="{{ $unit_type->image }}"
                                                    alt="{{ $unit_type->unit_type }}">
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="map-loc mt-4">
            <h3 class="wrapper__block--title">{{ __('inventory::inventory.compound_location') }}</h3>
            <div id='map'></div>
        </div>
    </div>
@endif


@if ($single_project->developer)
    <div class="wrapper__block">
        <h3 class="wrapper__block--title">{{ __('inventory::inventory.about_developer') }}</h3>
        <div class="wrapper__block--desc">
            <div class="dev-img">
                <a href="{{ route('front.developers.show', ['id' => $single_project->developer->id,'slug' => $single_project->developer->slug]) }}"
                    target="_blank">
                    @forelse($single_project->developer->attachments as $attachment)
                        @if ($loop->index == 0)
                            <img src="{{ file_exists(public_path('/storage/dimensions/uploads/' .$attachment->file_name_without_extension .'_125x125' .'.' .$attachment->extension))? asset('storage/dimensions/uploads/' .$attachment->file_name_without_extension .'_125x125' .'.' .$attachment->extension): $attachment->url }}"
                                alt="{{ $attachment->file_name }}">
                        @else
                        @break
                    @endif
                    @empty
                        <img src="{{ URL::asset('front/images/placeholder.png') }}"
                            alt="{{ $single_project->developer->developer_name }}">
    @endforelse
    </a>
    </div>
    <p itemprop="description"> {{ strip_tags(Str::limit($single_project->developer->description, 400, '...')) }} <a
            href="{{ route('front.developers.show', ['id' => $single_project->developer->id,'slug' => $single_project->developer->slug]) }}">{{ __('main.read_more') }}</a>
    </p>
    </div>
    </div>
    @endif


    @if ($single_project->amenities || $single_project->facilities)
        <div id="amenities-section" class="wrapper__block">
            <h3 class="wrapper__block--title">{{ __('inventory::inventory.facilities_and_amenities') }}</h3>
            <div class="wrapper__block--list">
                <ul>
                    <div class="row">
                        @foreach ($single_project->amenities as $amenity)
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                <li>
                                    <svg width="20" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg> {{ $amenity->amenity }}
                                </li>
                            </div>
                        @endforeach
                        @foreach ($single_project->facilities as $facility)
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                <li>
                                    <svg width="20" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg> {{ $facility->facility }}
                                </li>
                            </div>
                        @endforeach
                    </div>
                </ul>
            </div>
        </div>
    @endif

    <div class="page-sections">
        @if ($single_project->video)
            <div id="video-section" class="page-section mt-5">
                <div class="section-title">
                    <h2 class="title">{{ __('inventory::inventory.video') }}</h2>
                </div>

                <div class="video">
                    <div class="card-body">
                        <div class="media-holder">
                            {!! $single_project->video !!}
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if ($single_project->latitude && $single_project->longitude)
            <div id="map-section" class="page-section mt-5">
                <div class="section-title">
                    <h2 class="title">{{ __('main.map') }}</h2>
                </div>
                <div class="map-loc">
                    <div class="card-body">
                        <div class="media-holder">
                            <div id="map2"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
    @push('scripts')
        <script src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_KEY') }}&callback=initMapProduct&&libraries=places"
                defer></script>
        <script>
            function initMapProduct() {
                var latLng = {
                    lat: {{ $single_project->latitude }},
                    lng: {{ $single_project->longitude }}
                }; // latitude and longitude

                var map;

                var options = {
                    zoom: 15,
                    center: latLng,
                    mapTypeId: 'roadmap', // hybrid , satellite , roadmap ,
                    // panControl: true,
                    // zoomControl: true,
                    // disableDefaultUI: true,
                    // mapTypeControl: true,
                    // scaleControl: true,
                    // streetViewControl: true,
                    // overviewMapControl: true,
                    // rotateControl: true,
                };

                map = new google.maps.Map(document.getElementById("map2"), options);

                var marker = new google.maps.Marker({
                    position: latLng,
                    map: map,
                    icon: `http://maps.google.com/mapfiles/ms/icons/red-dot.png`,
                    animation: google.maps.Animation.BOUNCE,
                    title: '{{ $single_project->project }}'
                });

                var infoWindow = new google.maps.InfoWindow({
                    content: '<p>{{ $single_project->project }}</p>'
                })

                var infoWindowAccordion = new google.maps.InfoWindow({
                    content: '<p>{{ $single_project->project }}</p>'
                })

                marker.addListener('click', function() {
                    infoWindow.open(map, marker);
                });

                google.maps.event.addListener(marker, 'click', function() {
                    var pos = map.getZoom();
                    map.setZoom(12);
                    map.setCenter(marker.getPosition());
                    window.setTimeout(function() {
                        map.setZoom(pos);
                    }, 3000);
                });

            }
        </script>
    @endpush
