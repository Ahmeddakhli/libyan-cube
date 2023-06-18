<section class="section map-section d-block">
    <div id='map'></div>
    <input type="text" id="map-search" class="w-50 h-10">
    <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3454.085776328475!2d31.454851214976635!3d30.034396926002508!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x145822c881e2b703%3A0x49399f1a58a7ccbe!2sOsus%20Real%20Estate!5e0!3m2!1sen!2seg!4v1583273217720!5m2!1sen!2seg" width="100%" frameborder="0" scrolling='no' style="border:0;" allowfullscreen=""></iframe> -->
</section> <!-- ./ section -->

@push('scripts')
    <script>
        //  GOOGLE MAPS API

        function initMap() {
            var latLng = {
                lat: 30.0343969,
                lng: 31.4548512
            }; // latitude and longitude

            var options = {
                zoom: 12,
                center: latLng,
                scrollwheel: false,
                mapTypeId: 'satellite',
                draggable: true,
                styles: [
                    {
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
                ]
                // mapTypeControl: true,
                // mapTypeControlOptions: {
                // style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
                // position: google.maps.ControlPosition.TOP_CENTER
                // }
            }

            var map = new google.maps.Map(document.getElementById('map'), options);

            var project_markers_array = [];
            var project_info_windows_array = [];
            var unit_markers_array = [];
            var unit_info_windows_array = [];

            // project markers 
            @foreach($projects as $project)
                var content= `
                    <a href ="{{route('front.singleProject', ['id' => $project->id, 'slug' => str_slug($project->default_value)])}}">
                        {{__('inventory::inventory.project')}}:<p>{{$project->project}}</p> <br>
                        {{__('inventory::inventory.area_from')}}:<p>{{$project->area_from}}</p> <br>
                        {{__('inventory::inventory.area_to')}}:<p>{{$project->area_to}}</p> <br>
                        {{__('inventory::inventory.price_from')}}:<p>{{$project->price_from}}{{$project->currency_code}}</p> <br>
                        {{__('inventory::inventory.price_to')}}:<p>{{$project->price_to}} {{$project->currency_code}}</p>
                    </a>
                    `;
                @if($project->latitude && $project->longitude)    
                    var latlon = new google.maps.LatLng({{ $project->latitude}}, {{$project->longitude}});
                    var title = @json($project->project);

                    project_markers_array[{{$loop->index-1}}] = new google.maps.Marker({
                        position: latlon,
                        title: title,
                        map: map,
                        icon: '{{URL::asset('/front/images/icons/pin.png')}}',
                        animation: google.maps.Animation.BOUNCE,
                    });
                    project_info_windows_array[{{$loop->index-1}}] = new google.maps.InfoWindow({
                        content: content
                    });
                    google.maps.event.addListener(project_markers_array[{{$loop->index-1}}], 'click', function() {
                        project_info_windows_array[{{$loop->index-1}}].open(map, project_markers_array[{{$loop->index-1}}]);

                        var pos = map.getZoom();
                        map.setZoom(12);
                        map.setCenter(project_markers_array[{{$loop->index-1}}].getPosition());
                        window.setTimeout(function() {
                            map.setZoom(pos);
                        }, 3000);
                    });
                @endif
            @endforeach

            // unit makers
            @foreach($units as $unit)
                var content= `
                    <a href ="{{route('front.singleUnit', ['id' => $unit->id, 'title' => str_slug($unit->default_title)])}}">
                        {{__('inventory::inventory.title')}}:<p>{{$unit->title}}</p> <br>
                        {{__('inventory::inventory.area_from')}}:<p>{{$unit->area}}</p> <br>
                        {{__('inventory::inventory.price')}}:<p>{{$unit->price}} {{$unit->currency_code}}</p>
                    </a>
                    `;
                @if ($unit->latitude && $unit->longitude)
                    var latlon = new google.maps.LatLng({{ $unit->latitude}}, {{$unit->longitude}});
                    var title = @json($unit->unit_number);

                    unit_markers_array[{{$loop->index-1}}] = new google.maps.Marker({
                        position: latlon,
                        title: title,
                        map: map,
                        icon: '{{URL::asset('/front/images/icons/pin.png')}}',
                        animation: google.maps.Animation.BOUNCE,
                    });
                    unit_info_windows_array[{{$loop->index-1}}] = new google.maps.InfoWindow({
                        content: content
                    });
                    google.maps.event.addListener(unit_markers_array[{{$loop->index-1}}], 'click', function() {
                        unit_info_windows_array[{{$loop->index-1}}].open(map, unit_markers_array[{{$loop->index-1}}]);

                        var pos = map.getZoom();
                        map.setZoom(12);
                        map.setCenter(unit_markers_array[{{$loop->index-1}}].getPosition());
                        window.setTimeout(function() {
                            map.setZoom(pos);
                        }, 3000);
                    });
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