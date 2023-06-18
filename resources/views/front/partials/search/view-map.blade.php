<div class="map-view mr-5 mb-4">
    <a class="map-view-btn" href="#">
        <div class="loc-icon">
            <ion-icon name="location-sharp"></ion-icon>
            <span class="pulse"></span>
            <span class="pulse"></span>
            <span class="pulse"></span>
        </div>
        <span>{{__('main.maps_view')}}</span>
    </a>
    <div class="modal-overlay map-view-container">
        <div class="map-content inner-modal-content">
            <button class="close-modal">
                <span>
                    <ion-icon name="close-outline"></ion-icon>
                </span>
            </button>
            <div class="map-body">
                <div id='map'></div>
                <input type="text" id="map-search" class="w-50 h-10">
                <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3454.085776328475!2d31.454851214976635!3d30.034396926002508!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x145822c881e2b703%3A0x49399f1a58a7ccbe!2sOsus%20Real%20Estate!5e0!3m2!1sen!2seg!4v1583273217720!5m2!1sen!2seg" scrolling='no' frameborder="0" style="border:0;" allowfullscreen=""></iframe> -->
            </div>
        </div> <!-- ./ map-content -->
    </div> <!-- ./ map-view-container -->
</div> <!-- ./ map-view -->

@push('scripts')
    <script>
        function initMap() {
            var latLng = {
                lat: 30.0343969,
                lng: 31.4548512
            }; // latitude and longitude

            var options = {
                zoom: 12,
                center: latLng,
                mapTypeId: 'satellite', // hybrid , satellite , roadmap
                scrollwheel: true,
                draggable: true,
                styles: [{
                        elementType: 'geometry',
                        stylers: [{
                            color: '#242f3e'
                        }]
                    },
                    {
                        elementType: 'labels.text.stroke',
                        stylers: [{
                            color: '#242f3e'
                        }]
                    },
                    {
                        elementType: 'labels.text.fill',
                        stylers: [{
                            color: '#746855'
                        }]
                    },
                    {
                        featureType: 'administrative.locality',
                        elementType: 'labels.text.fill',
                        stylers: [{
                            color: '#d59563'
                        }]
                    },
                    {
                        featureType: 'poi',
                        elementType: 'labels.text.fill',
                        stylers: [{
                            color: '#d59563'
                        }]
                    },
                    {
                        featureType: 'poi.park',
                        elementType: 'geometry',
                        stylers: [{
                            color: '#263c3f'
                        }]
                    },
                    {
                        featureType: 'poi.park',
                        elementType: 'labels.text.fill',
                        stylers: [{
                            color: '#6b9a76'
                        }]
                    },
                    {
                        featureType: 'road',
                        elementType: 'geometry',
                        stylers: [{
                            color: '#38414e'
                        }]
                    },
                    {
                        featureType: 'road',
                        elementType: 'geometry.stroke',
                        stylers: [{
                            color: '#212a37'
                        }]
                    },
                    {
                        featureType: 'road',
                        elementType: 'labels.text.fill',
                        stylers: [{
                            color: '#9ca5b3'
                        }]
                    },
                    {
                        featureType: 'road.highway',
                        elementType: 'geometry',
                        stylers: [{
                            color: '#746855'
                        }]
                    },
                    {
                        featureType: 'road.highway',
                        elementType: 'geometry.stroke',
                        stylers: [{
                            color: '#1f2835'
                        }]
                    },
                    {
                        featureType: 'road.highway',
                        elementType: 'labels.text.fill',
                        stylers: [{
                            color: '#f3d19c'
                        }]
                    },
                    {
                        featureType: 'transit',
                        elementType: 'geometry',
                        stylers: [{
                            color: '#2f3948'
                        }]
                    },
                    {
                        featureType: 'transit.station',
                        elementType: 'labels.text.fill',
                        stylers: [{
                            color: '#d59563'
                        }]
                    },
                    {
                        featureType: 'water',
                        elementType: 'geometry',
                        stylers: [{
                            color: '#17263c'
                        }]
                    },
                    {
                        featureType: 'water',
                        elementType: 'labels.text.fill',
                        stylers: [{
                            color: '#515c6d'
                        }]
                    },
                    {
                        featureType: 'water',
                        elementType: 'labels.text.stroke',
                        stylers: [{
                            color: '#17263c'
                        }]
                    }
                ],
                // panControl: true,
                // zoomControl: true,
                // disableDefaultUI: true,
                // mapTypeControl: true,
                // scaleControl: true,
                // streetViewControl: true,
                // overviewMapControl: true,
                // rotateControl: true,
            };

            var map = new google.maps.Map(document.getElementById('map'), options);
            var infowindow = new google.maps.InfoWindow();
            var markers_array = [];
            var info_windows_array = [];

            @foreach($results as $result)
                @if($result->class == 'Modules\Inventory\IProject')
                    var content= `
                        <a href ="{{route('front.singleProject', ['id' => $result->object->id, 'slug' => $result->object->slug])}}">
                            {{__('inventory::inventory.project')}}:<p>{{$result->object->project}}</p> <br>
                            {{__('inventory::inventory.area_from')}}:<p>{{$result->object->area_from}}</p> <br>
                            {{__('inventory::inventory.area_to')}}:<p>{{$result->object->area_to}}</p> <br>
                            {{__('inventory::inventory.price_from')}}:<p>{{$result->object->price_from}}</p> <br>
                            {{__('inventory::inventory.price_to')}}:<p>{{$result->object->price_to}}</p>
                        </a>
                        `;
                    @if($result->object->latitude && $result->object->longitude)    
                        var latlon = new google.maps.LatLng({{ $result->object->latitude}}, {{$result->object->longitude}});
                        var title = @json($result->object->project);

                        markers_array[{{$loop->index-1}}] = new google.maps.Marker({
                            position: latlon,
                            title: title,
                            map: map,
                            icon: '{{URL::asset('/front/images/icons/pin.png')}}',
                            animation: google.maps.Animation.BOUNCE,
                        });
                        info_windows_array[{{$loop->index-1}}] = new google.maps.InfoWindow({
                            content: content
                        });

                        google.maps.event.addListener(markers_array[{{$loop->index-1}}], 'click', function() {
                            info_windows_array[{{$loop->index-1}}].open(map, markers_array[{{$loop->index-1}}]);

                            var pos = map.getZoom();
                            map.setZoom(12);
                            map.setCenter(markers_array[{{$loop->index-1}}].getPosition());
                            window.setTimeout(function() {
                                map.setZoom(pos);
                            }, 3000);
                        });
                    @endif
                @elseif($result->class =='Modules\Inventory\IUnit')
                    var content= `
                        <a href ="{{route('front.singleUnit', ['id' => $result->object->id, 'title' => str_slug($result->object->default_title)])}}">
                            {{__('inventory::inventory.title')}}:<p>{{$result->object->title}}</p> <br>
                            {{__('inventory::inventory.area_from')}}:<p>{{$result->object->area}}</p> <br>
                            {{__('inventory::inventory.price')}}:<p>{{$result->object->price}}</p>
                        </a>
                        `;
                    var latlon = new google.maps.LatLng({{ $result->object->latitude}}, {{$result->object->longitude}});
                    var title = @json($result->object->unit_number);
                    @if($result->object->latitude && $result->object->longitude)    
                        markers_array[{{$loop->index-1}}] = new google.maps.Marker({
                            position: latlon,
                            title: title,
                            map: map,
                            icon: '{{URL::asset('/front/images/icons/pin.png')}}',
                            animation: google.maps.Animation.BOUNCE,
                        });
                        info_windows_array[{{$loop->index-1}}] = new google.maps.InfoWindow({
                            content: content
                        });

                        google.maps.event.addListener(markers_array[{{$loop->index-1}}], 'click', function() {
                            info_windows_array[{{$loop->index-1}}].open(map, markers_array[{{$loop->index-1}}]);

                            var pos = map.getZoom();
                            map.setZoom(12);
                            map.setCenter(markers_array[{{$loop->index-1}}].getPosition());
                            window.setTimeout(function() {
                                map.setZoom(pos);
                            }, 3000);
                        });
                    @endif
                @else
                    {{-- Do nothing --}}
                @endif
            @endforeach

            // Search box
            var searchBox = new google.maps.places.SearchBox(document.getElementById('map-search'));
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('map-search'));
            google.maps.event.addListener(searchBox, 'places_changed', function() {
                searchBox.set('map', null);


                var places = searchBox.getPlaces();

                var bounds = new google.maps.LatLngBounds();
                var i, place;
                if (places.length == 0) {
                return;
                }
                var bounds = new google.maps.LatLngBounds();
                places.forEach(function (place) {
            
                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
                });
                map.fitBounds(bounds);
                searchBox.set('map', map);
                map.setZoom(Math.min(map.getZoom(),12));
            });
        };

        initMap();
    </script>
@endpush
