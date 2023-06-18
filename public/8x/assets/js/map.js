var MapHelper = function () {
    // Get input
    var input = document.getElementById('pac-input');

    var map;
    var latlng;
    var geocoder;
    var marker;
    var infoWindow;

    // Area of polygons
    var area = [];
    // Cost of polygons
    var cost = [];
    // Array of coordinates of maps
    var coordinates = [];
    // Counters
    var i = 0;
    var c = 0;
    var j = 0;

    // Markers control
    var markerCount = 0;
    var markersArray = [];

    // Array of polygons check if closed
    var isClosed = [];
    // Poly line
    var poly;
    var path;

    // Declare of polygon single
    var polygon;

    // Declare array of polygons
    var polygons = [];
    var polygonsCordinates = [];
    // Centers of polygons
    var centerLat;
    var centerLng;

    // Global app cost for meter
    var applicationCost = 0;

    var coordinatesJson;

    // Display
    var points = [];

    var init = function () {
        // initMap(true, true);

        // google.maps.event.addDomListener(window, 'load', initMap);
    };

    var initMap = function (clickable, searchable, draggable, drawable, customMap = null){

        /* New Map */
        var lat = $('#lat').val();
        var lng = $('#lng').val();
        var mapID = 'map';

        if(typeof customMap === 'object' && customMap != null){
            /* Custom Map */
            lat = customMap.lat;
            lng = customMap.lng;
            mapID = customMap.id;
            mapClass = customMap.class;
            elems = document.getElementsByClassName(mapClass);
        } else {
            elems = new Array();
        }
        
        if (lat && lng && lat != 0 && lng != 0) {
            latlng = new google.maps.LatLng('29.976631', '31.285002');
        } else {  
            latlng = new google.maps.Map(document.getElementById(mapID), {
              center: {lat: -34.397, lng: 150.644},
              zoom: 8
            });
        }

        if ((!lat && !lng) || (lat == 0 && lng == 0)) {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    // Get the latitude and the longitude
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;
                    latlng = new google.maps.LatLng(latitude, longitude);

                    // Set map options
                    var mapOptions = {
                        center: latlng,
                        zoom: 18,
                        draggable: true,
                        fullscreenControl: true
                    }

                    if (!draggable) {
                        mapOptions.draggable = false
                    }

                    if (elems.length) {                    
                        for (var i = 0; i < elems.length; i++) {
                            map = new google.maps.Map(elems[i], mapOptions);
                            
                            if (!drawable) {
                                if (lat && lng && lat != 0 && lng != 0) {
                                    geocode(map, latlng, customMap);
                                }
                            }

                            if (clickable) {
                                mapOnClick();
                            }

                            if (searchable) {
                                search(drawable, customMap);
                            }


                            if (drawable) {
                                isClosed[i] = false;
                                drawOnePolygon();
                            }
                        }
                    } else {                    
                        map = new google.maps.Map(document.getElementById(mapID), mapOptions);
                        
                        if (!drawable) {
                            if (lat && lng && lat != 0 && lng != 0) {
                                geocode(map, latlng, customMap);
                            }
                        }

                        if (clickable) {
                            mapOnClick();
                        }

                        if (searchable) {
                            search(drawable, customMap);
                        }


                        if (drawable) {
                            isClosed[i] = false;
                            drawOnePolygon();
                        }
                    }
                });
            }
        } else {
            latlng = new google.maps.LatLng(lat, lng);
        }

        // Set map options
        var mapOptions = {
            center: latlng,
            zoom: 18,
            draggable: true
        }

        if (!draggable) {
            mapOptions.draggable = false
        }

        if (elems.length) {                    
            for (var i = 0; i < elems.length; i++) {
                map = new google.maps.Map(elems[i], mapOptions);

                if (!drawable) {
                    if (lat && lng && lat != 0 && lng != 0) {
                        geocode(map, latlng, customMap);
                    }
                }


                if (clickable) {
                    mapOnClick();
                }

                if (searchable) {
                    search(drawable, customMap);
                }

                if (drawable) {
                    isClosed[i] = false;
                    drawOnePolygon();
                }
            }
        } else {        
            map = new google.maps.Map(document.getElementById(mapID), mapOptions);

            if (!drawable) {
                if (lat && lng && lat != 0 && lng != 0) {
                    geocode(map, latlng, customMap);
                } else {
                    map = new google.maps.Map(document.getElementById(mapID), {
                      center: {lat: 29.976631, lng: 31.285002},
                      zoom: 18,
                      draggable: true
                    });
                }
            }


            if (clickable) {
                mapOnClick();
            }

            if (searchable) {
                search(drawable, customMap);
            }

            if (drawable) {
                isClosed[i] = false;
                drawOnePolygon();
            }
        }
    }

    var geocode = function (map, latlng, customMap = null) {

        latID = 'lat';
        lngID = 'lng';
        searchID = 'map_search';

        if(typeof customMap === 'object' && customMap != null){
            /* Custom Map */
            latID = customMap.latInput;
            lngID = customMap.lngInput;
            searchID = customMap.map_search;
        }

        geocoder = new google.maps.Geocoder();
        geocoder.geocode({'location': latlng}, function (results, status) {
            if (status === 'OK') {
                if (results[0]) {
                    map.setZoom(15);
                    createMarker(map, latlng, false, results[0].formatted_address);
                    if (document.getElementById(latID)) {
                        document.getElementById(latID).value = latlng.lat();
                    }
                    if (document.getElementById(lngID)) {
                        document.getElementById(lngID).value = latlng.lng();
                    }
                    if (document.getElementById(searchID) !== null) {
                        document.getElementById(searchID).value = results[0].formatted_address;
                    }
                } else {
                    window.alert(lang.no_results_found);
                }
            } else {
                // window.alert(lang.geocode_failed_due_to + ':' + status);
            }
        });
    }

    var mapOnClick = function () {
        google.maps.event.addListener(map, 'click', function (event) {
            if (marker === undefined || marker === null) {
                // Undefined or Null
            } else {
                marker.setMap(null);
            }
            geocode(map, event.latLng);

        });
    }

    var addInfoWindow = function (marker, content, latlng) {
        var infoWindowOptions = {
            content: content,
            position: latlng
        }

        infoWindow = new google.maps.InfoWindow(infoWindowOptions);
        infoWindow.open(map, marker);
    }

    var createMarker = function (map, latlng, drag, content) {
        var markerOptions = {
            position: latlng,
            map: map
        }

        if (drag) {
            markerOptions.draggable = true;
            markerOptions.index = markerCount;
        }

        marker = new google.maps.Marker(markerOptions);
        if (content !== null) {
            addInfoWindow(marker, content, latlng);
        }

        return marker;
    }

    var search = function (dragable, customMap = null) {
        latID = 'lat';
        lngID = 'lng';
        searchID = 'map_search';

        if(typeof customMap === 'object' && customMap != null){
            /* Custom Map */
            latID = customMap.latInput;
            lngID = customMap.lngInput;
            searchID = customMap.map_search;
        }

        var input = document.getElementById(searchID);

        var autocomplete = new google.maps.places.Autocomplete((input), {
            types: ['geocode']
        });
        autocomplete.bindTo('bounds', map);

        autocomplete.addListener('place_changed', function () {
            if (infoWindow !== undefined) {
                infoWindow.close();
            }
            if (marker !== undefined) {
                marker.setVisible(false);
            }

            var place = autocomplete.getPlace();
            if (!place.geometry) {
                autocomplete_returned_place_contains_no_geometry
                window.alert("Autocomplete returned place contains no geometry");
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }

            if (!dragable) {
                createMarker(map, place.geometry.location, false, place.formatted_address);
            }

            document.getElementById(latID).value = place.geometry.location.lat();
            document.getElementById(lngID).value = place.geometry.location.lng();
        });
    }

    var drawPoly = function (map) {
        poly = new google.maps.Polyline({
            map: map,
            path: [],
            strokeColor: "#FF0000",
            strokeOpacity: 1.0,
            strokeWeight: 2
        });
    }

    var polygonPoints = function (polygon) {
        var len = polygon.getPath().getLength();
        for (var i = 0; i < len; i++) {
            var lat = polygon.getPath().getAt(i).lat();
            var lng = polygon.getPath().getAt(i).lng();
            coordinates.push({"lat": lat, "lng": lng});
        }
    }

    var polygonCenter = function (poly) {
        var lowx,
            highx,
            lowy,
            highy,
            lats = [],
            lngs = [],
            vertices = poly.getPath();

        for (var i = 0; i < vertices.length; i++) {
            lngs.push(vertices.getAt(i).lng());
            lats.push(vertices.getAt(i).lat());
        }

        lats.sort();
        lngs.sort();
        lowx = lats[0];
        highx = lats[vertices.length - 1];
        lowy = lngs[0];
        highy = lngs[vertices.length - 1];
        center_x = lowx + ((highx - lowx) / 2);
        center_y = lowy + ((highy - lowy) / 2);

        centerLat = center_x;
        centerLng = center_y;
    }

    var drawPolygon = function (map, path) {
        return new google.maps.Polygon({
            map: map,
            path: path,
            strokeColor: "#FF0000",
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: "#FF0000",
            fillOpacity: 0.35
        });
    }

    var drawOnePolygon = function () {
        drawPoly(map);

        // Click event listener
        google.maps.event.addListener(map, 'click', function (clickEvent) {
            if (polygons.length == 1) {
                return;
            }
            if (isClosed[i]) {
                return;
            }

            var markerIndex = poly.getPath().length;
            var isFirstMarker = markerIndex === 0;

            createMarker(map, clickEvent.latLng, true, null);

            markersArray[markerCount] = marker;
            markerCount++;

            // First marker
            if (isFirstMarker) {
                google.maps.event.addListener(marker, 'click', function () {

                    if (isClosed[i]) {
                        return;
                    } else {
                        if (poly.getPath().length > 3) {
                            // Get area of poly
                            area[j] = google.maps.geometry.spherical.computeArea(poly.getPath());
                            area[j] = area[j].toFixed(0);

                            // Get paths of poly
                            polygonPoints(poly);

                            // Get center of polygon
                            polygonCenter(poly);
                        } else {
                            alert(lang.please_specify_at_least_4_directions);
                            return;
                        }
                    }

                    path = poly.getPath();
                    poly.setMap(null);
                    polygon = drawPolygon(map, path);

                    polygons[i] = polygon;
                    polygonsCordinates[i] = coordinates[j];
                    isClosed[i] = true;
                    i++;
                    j++;
                    isClosed[i] = false;

                    drawPoly(map);
                });
            }
            // Drag event listener
            google.maps.event.addListener(marker, 'drag', function (dragEvent) {
                polygon.getPath().setAt(markerIndex, dragEvent.latLng);
                j--;

                // Get area of poly
                area[j] = google.maps.geometry.spherical.computeArea(polygon.getPath());
                area[j] = area[j].toFixed(0);


                // Get paths of poly
                polygonPoints(poly);

                // Get center of polygon
                polygonCenter(polygon);

                j++;
            });
            poly.getPath().push(clickEvent.latLng);
        });
    }

    var resetMap = function () {
        area = [];
        cost = [];
        coordinates = [];
        i = 0;
        c = 0;
        j = 0;
        markerCount = 0;
        isClosed = [];
        polygons = [];
        Map.initMap(false, true, true, true);

    }

    return {
        init: function () {
            init();
        },
        initMap: function (clickable, searchable, draggable, drawable, customMap) {
            initMap(clickable, searchable, draggable, drawable, customMap);
            search(false, customMap);
        },
        calculateLatLngs: function () {
            return JSON.stringify(coordinates);
        },
        getAreaCoordinates: function () {
            return JSON.stringify(coordinates);
        },
        resetMap: function () {
            return resetMap();
        },
    };
}();

jQuery(document).ready(function () {
    MapHelper.init();
});
