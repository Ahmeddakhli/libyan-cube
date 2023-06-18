<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
<script>
    window.jQuery || document.write('<script src="js/jquery-3.5.0.min.js"><\/script>')
</script>

<script src="{{URL::asset('/front/landing/js/main.js')}}"></script>

<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
{{--
<script>
    (function(b, o, i, l, e, r) {
        b.GoogleAnalyticsObject = l;
        b[l] || (b[l] =
            function() {
                (b[l].q = b[l].q || []).push(arguments)
            });
        b[l].l = +new Date;
        e = o.createElement(i);
        r = o.getElementsByTagName(i)[0];
        e.src = '//www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e, r)
    }(window, document, 'script', 'ga'));
    ga('create', 'UA-XXXXX-X', 'auto');
    ga('send', 'pageview');
</script>
--}}

<script src="{{URL::asset('/front/landing/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{URL::asset('/front/landing/js/bootstrap-select.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.0.4/gsap.min.js"></script>
@if(LaravelLocalization::getCurrentLocale() == 'en')
  <script src="{{URL::asset('/front/landing/js/splitting.min.js')}}"></script>
@endif
<script>
  var lang_status = "{{LaravelLocalization::getCurrentLocale()}}";
  if(lang_status == 'ar') {
    $('body').css('fontFamily', '"Tajawal", sans-serif');
  }else {
    $('body').css('fontFamily', '"Oswald", sans-serif');
  }
</script>
<script src="{{URL::asset('/front/landing/js/scroll-out.min.js')}}"></script>
<script src="{{URL::asset('/front/landing/js/jquery.fancybox.min.js')}}"></script>
<script src="{{URL::asset('/front/landing/js/slick.js')}}"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_KEY') }}&callback=initMap"></script>
<script src="{{URL::asset('/front/landing/js/main.js')}}"></script>
<script src="{{URL::asset('8x/assets/js/parsley.min.js')}}" type="text/javascript"></script>

<!-- Contact Form  -->
<script>
    $('.contact-from').on('click', function() {

        var form = $(this).closest('form');

        /* Parsley validate front-end */
        if (!form.parsley().isValid()) {

            // Display notificaction
            $('.messages').empty();
            $('#notification').css('background-color', 'red');
            $('#notification .messages').append(`<span>` + "{{trans('main.oh_snap_change_a_few_thing_up_and_try_submitting_again')}}" + `</span> <br>`);
            $('#notification').fadeIn("slow");
            $('.dismiss').click(function() {
                $('#notification').fadeOut('slow')
            });

            form.find( '[data-parsley-type]' ).each( function( i , v ){
                $(this).parsley().validate({
                    focusInvalid: false,
                    invalidHandler: function() {
                        $(this).find(":input.error:first").focus();
                    }
                });

                return;
            });
            form.find( '[data-parsley-pattern]' ).each(function( i, v ) {
                $(this).parsley().validate({
                    focusInvalid: false,
                    invalidHandler: function() {
                        $(this).find(":input.error:first").focus();
                    }
                });

                return;
            });
            form.parsley().validate({
                focusInvalid: false,
                invalidHandler: function() {
                    $(this).find(":input.error:first").focus();
                }
            });

            return;
        }

        var url = "{{route('contact_us.contact_us.store')}}";
        var headers = {
            'content-type': 'appliction/json'
        };
        var data = {
            '_token' : $(this).closest('form').find("input[name='_token']").val(),
            'full_name': $(this).closest('form').find("input[name='full_name']").val(),
            'email': $(this).closest('form').find("input[name='email']").val(),
            'phone': $(this).closest('form').find('.phone-input').intlTelInput('getSelectedCountryData').dialCode+$(this).closest('form').find("input[name='phone']").val(),
            'best_time_to_call_from':$(this).closest('form').find("input[name='best_time_to_call_from']").val() ,
            'message': $(this).closest('form').find("textarea[name='message']").val(),
            'link':$(this).closest('form').find("input[name='link']").val(),
            'type':$(this).closest('form').find("input[name='type']").val(),
            'position':$(this).closest('form').find("input[name='position']").val(),
            'city_id':$(this).closest('form').find("input[name='city_id']").val(),
            'model_name':$(this).closest('form').find("input[name='model_name']").val(),
            'unit_types':$(this).closest('form').find("input[name='unit_types']").val(),
        };
        $.post(url, data, headers).done(function(response) {
            // Empty notificaion messages
            $('.messages').empty();

            // Notification type
            if(response.status){
                $('#notification').css('background-color', 'green');
            }else{
                $('#notification').css('background-color', 'red');
            }

            // Display notification
            $('#notification .messages').append(`<span>` + response.message + `</span> <br>`);
            $('#notification').fadeIn("slow");

            // Dismiss
            $('.dismiss').click(function() {
                $('#notification').fadeOut('slow')
            });
            setTimeout(function() {
                $('#notification').fadeOut('slow')
            }, 2000);

        }).fail(function(xhr, error_text, statusText) {
            // Empty notification message
            $('.messages').empty();

            // Notification type
            $('#notification').css('background-color', 'red');

            // Display notificaion
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                $.each(xhr.responseJSON.errors, function(index, error) {
                    $('#notification .messages').append(`<span>` + error.message + `</span> <br>`);
                });
            } else {
                $('#notification .messages').append(`<span>` + statusText + `</span> <br>`);
            }
            $('#notification').fadeIn("slow");

            // Dismiss notification
            $('.dismiss').click(function() {
                $('#notification').fadeOut('slow')
            });
        });
    });
</script>

<!-- Zoom Meeting request -->
<script>
    $('.zoom_request').on('click',function(e){
        e.preventDefault();

        // Request parameters
        var url ="{{route('meetings.store')}}";
        var data = {
            'user_id':"{{ auth()->user() ? auth()->user()->id : ''}}",
            'meeting_type':"zoom_meeting",
            "_token": "{{ csrf_token() }}",
        }
        var headers = {
            'Content-Type':'application/json'
        };

        // Send the request
        $.post(url, data, headers).done(function(response) {
            // Notification message
            if (response.message) {
                // Empty notificaion messages
                $('.messages').empty();

                // Notification type
                if (response.status) {
                    $('#notification').css('background-color', 'green');
                } else {
                    $('#notification').css('background-color', 'red');
                }

                // Display notification
                $('#notification .messages').append(`<span>` + response.message + `</span> <br>`);
                $('#notification').fadeIn("slow");
                $('.dismiss').click(function() {
                    $('#notification').fadeOut('slow')
                });

                // Dismiss notification
                setTimeout(function() {
                    $('#notification').fadeOut('slow')
                }, 2000);
            }
        }).fail(function(xhr, error_text, statusText) {
            // Empty notification messages
            $('.messages').empty();

            // Notification type
            $('#notification').css('background-color', 'red');

            // Display notificaion
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                $.each(xhr.responseJSON.errors, function(index, error) {
                    $('#notification .messages').append(`<span>` + error.message + `</span> <br>`);
                });
            } else {
                $('#notification .messages').append(`<span>` + statusText + `</span> <br>`);
            }
            $('#notification').fadeIn("slow");

            // Dismiss notification
            $('.dismiss').click(function() {
                $('#notification').fadeOut('slow')
            });
        });
    });
</script>

<script>

  @if(LaravelLocalization::getCurrentLocale() == 'en')
    // INIT SCROLLOUT PLUGIN
    ScrollOut();
    // INIT SPLITTING PLUGIN
    Splitting();
  @endif

  //  INIT PROPERTY SLIDER
    $('.prop-slider').slick({
        autoplay: true,
        pauseOnHover: true,
        speed: 1800,
        slidesToShow: 1,
        slidesToScroll: 1,
        cssEase: 'cubic-bezier(.84, 0, .08, .99)',
        dots: false,
        arrows: true,
        prevArrow: '.prop-slider-controllers .PrevArrow',
        nextArrow: '.prop-slider-controllers .NextArrow',
    })
/*
    $('.slider-for').slick({
        autoplay: true,
        pauseOnHover: true,
        autoplaySpeed: 10000,
        speed: 600,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        arrows: true,
        fade: true,
        prevArrow: '.panorama-slider-controllers .PrevArrow',
        nextArrow: '.panorama-slider-controllers .NextArrow',
    });
    var sliderNav = $('.slider-nav').children('div.item-nav');
    var maxItems = sliderNav.length;
    $('.slider-nav').slick({
        autoplay: true,
        pauseOnHover: true,
        autoplaySpeed: 10000,
        speed: 600,
        slidesToShow: maxItems,
        slidesToScroll: 1,
        cssEase: 'cubic-bezier(.84, 0, .08, .99)',
        dots: false,
        arrows: false,
        asNavFor: '.slider-for',
        focusOnSelect: true,
        responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,
                }
            }
        ]
    });
*/

    //  GOOGLE MAPS API

    function initMap() {

        var latLng = {
            lat: @json($unit->latitude),
            lng: @json($unit->longitude)
        }; // latitude and longitude

        var options = {
            zoom: 12,
            center: latLng,
            mapTypeId: 'satellite', // hybrid , satellite , roadmap ,
            scrollwheel: false,
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
            ]
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

        var marker = new google.maps.Marker({
            position: latLng,
            map: map,
            icon: '{{URL::asset('/front/landing/img/pin.png')}}',
            animation: google.maps.Animation.BOUNCE,
            title: '{{$unit->title}}'
        });

        var infoWindow = new google.maps.InfoWindow({
            content: '<p>{{$unit->title}}</p>'
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

    // Init Map
    @if ($unit->latitude && $unit->longitude)
        initMap();
    @endif

    // INIT FANCYBOX GALLERY PLUGIN
    $('[data-fancybox="gallery"]').fancybox({
        // loop: false,
        // closeExisting: false,
        // parentEl: ".gallery-parent",
        // hideScrollbar: false,
        // hash: null,
    });
</script>