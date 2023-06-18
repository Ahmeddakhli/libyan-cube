@if ($single_project->video)
    <div class='accordion-tabs'>
        <div class="accordion" id="product-acc">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-capitalize" data-toggle="collapse" aria-expanded="true" data-target="#video">
                        {{ __('inventory::inventory.video') }}
                        <svg width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </h5>
                </div>
                <div id="video" class="collapse panel-collapse show" data-parent="#product-acc">
                    <div class="card-body">
                        <div class="media-holder">
                            {!! $single_project->video !!}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endif

@push('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_KEY') }}&callback=initMap&&libraries=places"
        defer></script>
    <script>
        // FIX SLIDERS ISSUES INSIDE BOOTSTRAP ACCORDION

        //  GOOGLE MAPS API

        function initMap() {
            var latLng = {
                lat: @json($single_project->latitude),
                lng: @json($single_project->longitude)
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

            map = new google.maps.Map(document.getElementById("map"), options);

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
