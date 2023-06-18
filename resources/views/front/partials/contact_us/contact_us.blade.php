<nav aria-label="breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('front.home') }}">{{ __('main.home_title') }}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('main.contact_us') }}</li>
        </ol>
    </div>
</nav>
<section class="contact-page pb-5">

    <div class="container">
        <div class="section-title">
            <h1 class="title h2">{{ __('main.contact_us') }}</h1>
            {{-- <p>Talk to us about whatever you like, ask us a question or tell us what you want. We're all ears.</p> --}}
        </div>

        <div class="row mt-5">

            <div class="col-lg-6 mb-5">
                <div class="contact-form">
                    <form action="{{ route('contact_us.contact_us.store') }}" method="POST" class="form-contact"
                        data-parsley-validate>
                        @csrf
                        <input type="hidden" name="link" value="{{ Request::url() }}">
                        <ul class="nav mb-3">
                            <li class="form-check form-check-inline">
                                <input type="radio" name="type" class="form-check-input" id="call-req" value="request_a_call">
                                <label class="form-check-label" for="call-req">{{ __('main.request_a_call') }}</label>
                            </li>
                            <li class="form-check form-check-inline">
                                <input type="radio" name="type" class="form-check-input" id="meeting-req" value="set_a_visit">
                                <label class="form-check-label" for="meeting-req">{{ __('main.set_a_visit') }}</label>
                            </li>
                        </ul>

                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="ri-calendar-check-fill"></i>
                            </span>
                            <input type="text" class="full-date-input form-control" name="best_time_to_call_from" placeholder="Best time to reach">
                        </div>

                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" inputmode="text" name="full_name"
                                placeholder="{{ __('users.full_name') }}" data-parsley-trigger="change focusout"
                                required data-parsley-required-message="{{ __('main.please_enter_your_name') }}">
                            <label>Name</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="email" class="form-control" inputmode="email" name="email"
                                placeholder="{{ __('users.email') }}" required
                                data-parsley-required-message="{{ __('main.please_enter_your_email') }}">
                            <label class="contact-label">{{ __('users.email') }}</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" inputmode="tel"
                                placeholder="{{ __('users.mobile_number') }}" name="phone"
                                data-parsley-trigger="change focusout" required
                                data-parsley-required-message="{{ __('main.please_enter_your_mobile_number') }}">
                            <label class="contact-label">{{ __('users.mobile_number') }}</label>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" inputmode="text" placeholder="{{ __('contactus::contact_us.message') }}"
                                name="message" data-parsley-trigger="change focusout"></textarea>
                            <label class="contact-label">{{ __('contactus::contact_us.message') }}</label>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="site-btn contact-from">{{ __('main.send') }}</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-6 mb-5">

                <div class="newsletter-widget">
                    <h5 class="mb-2">{{ __('main.newsletter') }}</h5>
                    <p class="mb-3">
                        {{ __('main.subscribe_your_email_to_get_the_latest_news_and_new_offer_also_discount') }}</p>
                    <form class="form-subscribe" data-parsley-validate>
                        @csrf
                        <div class="d-flex gap-3 align-items-center">
                            <input type="email" name="email" class='form-control' inputmode="email" name="email"
                                placeholder="{{ __('users.email') }}" required
                                data-parsley-required-message="{{ __('main.please_enter_your_email') }}">
                            <button class='site-btn subscribe-from'><i class="ri-navigation-line"></i></button>
                        </div>
                    </form>
                </div>

                <hr>

                <ul class="contact-info d-flex align-items-center flex-wrap gap-3">
                    @foreach ($contacts as $key => $contact)
                        @if ($key == 'address')
                            @foreach ($contact as $address)
                                <li>
                                    <span class="icon"><i class="ri-map-pin-line"></i></span>
                                    <address class="mb-0">
                                        @if (App::getLocale() == 'ar')
                                            {{ $address->contact_ar }}
                                        @else
                                            {{ $address->contact }}
                                        @endif
                                    </address>
                                </li>
                            @endforeach
                        @endif
                    @endforeach
                    @foreach ($contacts as $key => $contact)
                        @if ($key == 'phone')
                            @foreach ($contact as $phone)
                                <li>
                                    <span class="icon"><i class="ri-phone-line"></i></span>
                                    <a href='tel:{{ $phone->contact }}'>
                                        <bdi>{{ $phone->contact }}</bdi>
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    @endforeach
                    @foreach ($contacts as $key => $contact)
                        @if ($key == 'email')
                            @foreach ($contact as $email)
                                <li>
                                    <span class="icon"><i class="ri-mail-line"></i></span>
                                    <a href='mailto:{{ $email->contact }}'
                                        target='_blank'>{{ $email->contact }}</a>
                                </li>
                            @endforeach
                        @endif
                    @endforeach
                </ul>
            </div>

        </div>

        <div class="col-12">
            <div class="ratio ratio-21x9" id="map">
            </div>
        </div>

    </div>
</section>


@push('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_KEY') }}&callback=initMap&&libraries=places"
        defer></script>
    <script>
        // GOOGLE MAPS API
        function initMap() {
            @if (count($branches))
                var latLng = {
                    lat: {{ $branches[0]->latitude }},
                    lng: {{ $branches[0]->longitude }}
                }; // latitude and longitude
            @endif

            var options = {
                zoom: 18,
                center: latLng,
                mapTypeId: 'roadmap', // hybrid , satellite , roadmap , terrain
                scrollwheel: false,
                draggable: true,
                streetViewControl: false,

            };

            var map = new google.maps.Map(document.getElementById('map'), options);

            var marker = new google.maps.Marker({
                position: latLng,
                map: map,
                icon: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png',
                animation: google.maps.Animation.BOUNCE,
                title: @if (!empty($branches[0]->branch))
                    "{{ $branches[0]->branch }}"
                @else
                    '{{ env('APP_NAME') }}'
                @endif
            });

            var infoWindow = new google.maps.InfoWindow({
                content: @if (!empty($branches[0]->branch))
                    '<p>{{ $branches[0]->branch }}</p>'
                @else
                    '<p>{{ env('APP_NAME') }}</p>'
                @endif
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

            // Add other markers if any
            var markers_array = [];
            var info_windows_array = [];

            @foreach ($branches as $branch)
                @if ($loop->index != 0)
                    @if ($branch->latitude && $branch->longitude)
                        latLng = {
                            lat: {{ $branch->latitude }},
                            lng: {{ $branch->longitude }}
                        }; // latitude and longitude

                        markers_array[{{ $loop->index - 1 }}] = new google.maps.Marker({
                            position: latLng,
                            map: map,
                            icon: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png',
                            animation: google.maps.Animation.BOUNCE,
                            title: @if (!empty($branch->branch))
                                '{{ $branch->branch }}'
                            @else
                                '{{ env('APP_NAME') }}'
                            @endif
                        });

                        info_windows_array[{{ $loop->index - 1 }}] = new google.maps.InfoWindow({
                            content: @if (!empty($branch->branch))
                                '<p>{{ $branch->branch }}</p>'
                            @else
                                '<p>{{ env('APP_NAME') }}</p>'
                            @endif
                        })

                        markers_array[{{ $loop->index - 1 }}].addListener('click', function() {
                            info_windows_array[{{ $loop->index - 1 }}].open(map, markers_array[
                                {{ $loop->index - 1 }}]);
                        });

                        google.maps.event.addListener(markers_array[{{ $loop->index - 1 }}], 'click', function() {
                            var pos = map.getZoom();
                            map.setZoom(12);
                            map.setCenter(markers_array[{{ $loop->index - 1 }}].getPosition());
                            window.setTimeout(function() {
                                map.setZoom(pos);
                            }, 3000);
                        });
                    @endif
                @endif
            @endforeach
        }
    </script>


    <script>
        $('.subscribe-from').on('click', function(e) {
            e.preventDefault()
            var form = $(this).closest('form');

            /* Parsley validate front-end */
            if (!form.parsley().isValid()) {
                // Display notification

                $.unblockUI();

                $.alert("{{ __('main.oh_snap_change_a_few_thing_up_and_try_submitting_again') }}", {
                    title: '',
                    type: 'warning',
                    position: ['top-right', [0, 20]],
                });
                form.find('[data-parsley-type]').each(function(i, v) {
                    $(this).parsley().validate({
                        focusInvalid: false,
                        invalidHandler: function() {
                            $(this).find(":input.error:first").focus();
                        }
                    });

                    return;
                });
                form.find('[data-parsley-pattern]').each(function(i, v) {
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

            var url = "{{ route('front.subscribe') }}";
            var headers = {
                'content-type': 'appliction/json'
            };
            var data = $('.form-subscribe').serialize()

            // Send  subscribe request
            $.post(url, data, headers).done(function(response) {
                // Un Block UI
                $.unblockUI();

                if (response.status) {
                    $.alert(response.message, {
                        title: '',
                        type: 'info',
                        position: ['top-right', [0, 20]],
                    });

                } else {
                    $.alert(response.message, {
                        title: '',
                        type: 'warning',
                        position: ['top-right', [0, 20]],
                    });
                }
            }).fail(function(xhr, error_text, statusText) {
                // Un Block UI
                $.unblockUI();

                // Display notificaion
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    $.each(xhr.responseJSON.errors, function(index, error) {
                        $.alert(error.message, {
                            title: '',
                            type: 'warning',
                            position: ['top-right', [0, 20]],
                        });
                    });
                } else {
                    $.alert(statusText, {
                        title: '',
                        type: 'warning',
                        position: ['top-right', [0, 20]],
                    });
                }
            });
        });
    </script>
@endpush
