<script src="{{ asset('8x/assets/js/summernote-image-attributes.js') }}"></script>

<script>
    var elt = $('#seller_id');

    var sellers = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('id'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '{!! route('users.tagsinput') !!}' + '?needle=%QUERY%',
            wildcard: '%QUERY%',
        }
    });
    sellers.initialize();

    $('#seller_id').tagsinput({
        itemValue: 'id',
        itemText: 'name',
        maxChars: 100,
        maxTags: 1,
        trimValue: true,
        allowDuplicates: false,
        freeInput: false,
        focusClass: 'form-control',
        tagClass: function(item) {
            if (item.display)
                return 'kt-badge kt-badge--inline kt-badge--' + item.display;
            else
                return 'kt-badge kt-badge--inline kt-badge--info';

        },
        onTagExists: function(item, $tag) {
            $tag.hide().fadeIn();
        },
        typeaheadjs: [{
                hint: false,
                highlight: true
            },
            {
                name: 'seller_id',
                itemValue: 'id',
                displayKey: 'name',
                source: sellers.ttAdapter(),
                templates: {
                    empty: [
                        '<ul class="list-group"><li class="list-group-item">{{ trans('inventory::inventory.nothing_found') }}.</li></ul>'
                    ],
                    header: [
                        '<ul class="list-group">'
                    ],
                    suggestion: function(data) {
                        return '<li class="list-group-item">' + data.name + '</li>'
                    }
                }
            }
        ]
    });
</script>
<script>
    var elt = $('#buyer_id');

    var buyers = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('id'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '{!! route('users.tagsinput') !!}' + '?needle=%QUERY%',
            wildcard: '%QUERY%',
        }
    });
    buyers.initialize();

    $('#buyer_id').tagsinput({
        itemValue: 'id',
        itemText: 'name',
        maxChars: 100,
        maxTags: 1,
        trimValue: true,
        allowDuplicates: false,
        freeInput: false,
        focusClass: 'form-control',
        tagClass: function(item) {
            if (item.display)
                return 'kt-badge kt-badge--inline kt-badge--' + item.display;
            else
                return 'kt-badge kt-badge--inline kt-badge--info';

        },
        onTagExists: function(item, $tag) {
            $tag.hide().fadeIn();
        },
        typeaheadjs: [{
                hint: false,
                highlight: true
            },
            {
                name: 'buyer_id',
                itemValue: 'id',
                displayKey: 'name',
                source: buyers.ttAdapter(),
                templates: {
                    empty: [
                        '<ul class="list-group"><li class="list-group-item">{{ trans('inventory::inventory.nothing_found') }}.</li></ul>'
                    ],
                    header: [
                        '<ul class="list-group">'
                    ],
                    suggestion: function(data) {
                        return '<li class="list-group-item">' + data.name + '</li>'
                    }
                }
            }
        ]
    });
</script>

<script>
    var elt = $('#i_project_id');

    var projects = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('id'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '{!! route('inventory.projects.tagsinput') !!}' + '?needle=%QUERY%',
            wildcard: '%QUERY%',
        }
    });
    projects.initialize();

    $('#i_project_id').tagsinput({
        itemValue: 'id',
        itemText: 'name',
        maxChars: 100,
        maxTags: 1,
        trimValue: true,
        allowDuplicates: false,
        freeInput: false,
        focusClass: 'form-control',
        tagClass: function(item) {
            if (item.display)
                return 'kt-badge kt-badge--inline kt-badge--' + item.display;
            else
                return 'kt-badge kt-badge--inline kt-badge--info';

        },
        onTagExists: function(item, $tag) {
            $tag.hide().fadeIn();
        },
        typeaheadjs: [{
                hint: false,
                highlight: true
            },
            {
                name: 'i_project_id',
                itemValue: 'id',
                displayKey: 'name',
                source: projects.ttAdapter(),
                templates: {
                    empty: [
                        '<ul class="list-group"><li class="list-group-item">{{ trans('inventory::inventory.nothing_found') }}.</li></ul>'
                    ],
                    header: [
                        '<ul class="list-group">'
                    ],
                    suggestion: function(data) {
                        return '<li class="list-group-item">' + data.name + '</li>'
                    }
                }
            }
        ]
    });
</script>

<script>
    @if ($i_unit->project)
        $('#i_project_id').tagsinput('add', {"id":"{{ $i_unit->i_project_id }}","name":"{{ $i_unit->project->value }}"});
    @endif
</script>

<script>
    function getPurposePurposeTypes(i_purpose_id, selected_i_purpose_type_id = null, div_id = null) {
        // If div is null, set default div
        if (!div_id) {
            div_id = 'i_purpose_type_id';
        }

        // Return if not array
        if (!Array.isArray(i_purpose_id)) {
            return;
        }
        // If empty array, empty then return
        if (i_purpose_id && Array.isArray(i_purpose_id) && !i_purpose_id.length) {
            $('#' + div_id).empty();
            $("#" + div_id).selectpicker("refresh");
            return;
        }

        $('#' + div_id).empty();
        $("#" + div_id).selectpicker("refresh");

        // BlockUI
        if (i_purpose_id.length) {
            KTApp.blockPage({
                overlayColor: "#000000",
                type: "loader",
                state: "success",
                message: "{{ trans('main.please_wait') }}"
            });
            $.ajax({
                url: "{{ route('inventory.purpose_types.GetIPurposePurposeTypes') }}",
                type: "GET",
                data: {
                    i_purpose_id: i_purpose_id
                },
                success: function(response) {
                    // UnblockUI
                    KTApp.unblockPage();
                    // Show notification
                    if (response.status) {
                        // Insert empty purpose type first
                        // $("#"+div_id).append($('<option>', {
                        //     value: "",
                        //     text: "{{ __('inventory::inventory.select_purpose_type') }}"
                        // }));
                        $("#" + div_id).append(
                            '<option value="" selected disabled>{{ trans('inventory::inventory.select_deselect_purpose_types') }}</option>'
                            );
                        $.each(response.data, function(i, purpose_type) {
                            $('#i_purpose_type_id').append($('<option>', {
                                value: purpose_type.id,
                                text: purpose_type.purpose_type
                            }));
                        });
                        if (selected_i_purpose_type_id) {
                            $("#" + div_id).selectpicker('val', selected_i_purpose_type_id);
                        }
                        $("#" + div_id).selectpicker("refresh");
                    } else {
                        showNotification(response.message, "{{ trans('main.error') }}", 'la la-warning',
                            null, 'danger', true, true, true);
                    }
                },
                error: function(xhr, error_text, statusText) {
                    // UnblockUI
                    KTApp.unblockPage();

                    if (xhr.status == 401) {
                        // Unauthorized
                        if (xhr.responseJSON.error) {
                            setTimeout(function() {
                                window.scrollTo({
                                    top: 0,
                                    behavior: 'smooth'
                                });
                                showMsg(form, 'danger', xhr.responseJSON.error, true);
                            }, 500);
                            showNotification(xhr.responseJSON.error, "{{ trans('main.error') }}",
                                'la la-warning', null, 'danger', true, true, true);
                        } else {
                            setTimeout(function() {
                                window.scrollTo({
                                    top: 0,
                                    behavior: 'smooth'
                                });
                                showMsg(form, 'danger', statusText, true);
                            }, 500);
                            showNotification(statusText, "{{ trans('main.error') }}", 'la la-warning',
                                null, 'danger', true, true, true);
                        }
                    } else if (xhr.status == 422) {
                        // HTTP_UNPROCESSABLE_ENTITY
                        if (xhr.responseJSON.errors) {
                            window.scrollTo({
                                top: 0,
                                behavior: 'smooth'
                            });
                            $.each(xhr.responseJSON.errors, function(index, error) {
                                setTimeout(function() {
                                    if (index === 0) {
                                        var remove_previous_alerts = true;
                                    } else {
                                        var remove_previous_alerts = false;
                                    }
                                    showMsg(form, 'danger', error.message,
                                        remove_previous_alerts);
                                }, 500);
                                showNotification(error.message, "{{ trans('main.error') }}",
                                    'la la-warning', null, 'danger', true, true, true);
                            });
                        } else {
                            setTimeout(function() {
                                window.scrollTo({
                                    top: 0,
                                    behavior: 'smooth'
                                });
                                showMsg(form, 'danger', statusText, true);
                            }, 500);
                            showNotification(statusText, "{{ trans('main.error') }}", 'la la-warning',
                                null, 'danger', true, true, true);
                        }
                    } else if (xhr.status == 500) {
                        // Internal Server Error
                        var error = xhr.responseJSON.message;
                        if (xhr.responseJSON.error) {
                            setTimeout(function() {
                                window.scrollTo({
                                    top: 0,
                                    behavior: 'smooth'
                                });
                                showMsg(form, 'danger', xhr.responseJSON.error, true);
                            }, 500);
                            showNotification(xhr.responseJSON.error, "{{ trans('main.error') }}",
                                'la la-warning', null, 'danger', true, true, true);
                        } else {
                            setTimeout(function() {
                                window.scrollTo({
                                    top: 0,
                                    behavior: 'smooth'
                                });
                                showMsg(form, 'danger', statusText, true);
                            }, 500);
                            showNotification(statusText, "{{ trans('main.error') }}", 'la la-warning',
                                null, 'danger', true, true, true);
                        }
                    }
                }
            });
        }
    }
</script>
<script>
    function getCountryRegions(country_id, selected_region_id = null) {
        // BlockUI
        KTApp.blockPage({
            overlayColor: "#000000",
            type: "loader",
            state: "success",
            message: "{{ trans('main.please_wait') }}"
        });

        if (country_id) {
            $('#region_id').empty();
            $("#region_id").selectpicker("refresh");
            $('#city_id').empty();
            $("#city_id").selectpicker("refresh");
            $('#area_id').empty();
            $("#area_id").selectpicker("refresh");

            $.ajax({
                url: "{{ route('locations.getCountryRegions') }}",
                type: "GET",
                data: {
                    country_id: country_id
                },
                success: function(response) {
                    // UnblockUI
                    KTApp.unblockPage();

                    // Show notification
                    if (response.status) {
                        // Insert empty region first
                        $('#region_id').append($('<option>', {
                            value: "",
                            text: "{{ __('inventory::inventory.select_region') }}"
                        }));
                        $.each(response.data, function(i, region) {
                            $('#region_id').append($('<option>', {
                                value: region.id,
                                text: region.name
                            }));
                        });
                        console.log(selected_region_id);
                        if (selected_region_id) {
                            $('#region_id').selectpicker('val', selected_region_id);
                        }
                        $("#region_id").selectpicker("refresh");
                    } else {
                        showNotification(response.message, "{{ trans('main.error') }}", 'la la-warning',
                            null, 'danger', true, true, true);
                    }
                },
                error: function(xhr, error_text, statusText) {
                    // UnblockUI
                    KTApp.unblockPage();

                    if (xhr.status == 401) {
                        // Unauthorized
                        if (xhr.responseJSON.error) {
                            setTimeout(function() {
                                window.scrollTo({
                                    top: 0,
                                    behavior: 'smooth'
                                });
                                showMsg(form, 'danger', xhr.responseJSON.error, true);
                            }, 500);
                            showNotification(xhr.responseJSON.error, "{{ trans('main.error') }}",
                                'la la-warning', null, 'danger', true, true, true);
                        } else {
                            setTimeout(function() {
                                window.scrollTo({
                                    top: 0,
                                    behavior: 'smooth'
                                });
                                showMsg(form, 'danger', statusText, true);
                            }, 500);
                            showNotification(statusText, "{{ trans('main.error') }}", 'la la-warning',
                                null, 'danger', true, true, true);
                        }
                    } else if (xhr.status == 422) {
                        // HTTP_UNPROCESSABLE_ENTITY
                        if (xhr.responseJSON.errors) {
                            window.scrollTo({
                                top: 0,
                                behavior: 'smooth'
                            });
                            $.each(xhr.responseJSON.errors, function(index, error) {
                                setTimeout(function() {
                                    if (index === 0) {
                                        var remove_previous_alerts = true;
                                    } else {
                                        var remove_previous_alerts = false;
                                    }
                                    showMsg(form, 'danger', error.message,
                                        remove_previous_alerts);
                                }, 500);
                                showNotification(error.message, "{{ trans('main.error') }}",
                                    'la la-warning', null, 'danger', true, true, true);
                            });
                        } else {
                            setTimeout(function() {
                                window.scrollTo({
                                    top: 0,
                                    behavior: 'smooth'
                                });
                                showMsg(form, 'danger', statusText, true);
                            }, 500);
                            showNotification(statusText, "{{ trans('main.error') }}", 'la la-warning',
                                null, 'danger', true, true, true);
                        }
                    } else if (xhr.status == 500) {
                        // Internal Server Error
                        var error = xhr.responseJSON.message;
                        if (xhr.responseJSON.error) {
                            setTimeout(function() {
                                window.scrollTo({
                                    top: 0,
                                    behavior: 'smooth'
                                });
                                showMsg(form, 'danger', xhr.responseJSON.error, true);
                            }, 500);
                            showNotification(xhr.responseJSON.error, "{{ trans('main.error') }}",
                                'la la-warning', null, 'danger', true, true, true);
                        } else {
                            setTimeout(function() {
                                window.scrollTo({
                                    top: 0,
                                    behavior: 'smooth'
                                });
                                showMsg(form, 'danger', statusText, true);
                            }, 500);
                            showNotification(statusText, "{{ trans('main.error') }}", 'la la-warning',
                                null, 'danger', true, true, true);
                        }
                    }
                }
            });
        }
    }

    function getRegionCities(region_id, selected_city_id = null) {
        // BlockUI
        KTApp.blockPage({
            overlayColor: "#000000",
            type: "loader",
            state: "success",
            message: "{{ trans('main.please_wait') }}"
        });

        if (region_id) {
            $('#city_id').empty();
            $("#city_id").selectpicker("refresh");
            $('#area_id').empty();
            $("#area_id").selectpicker("refresh");

            $.ajax({
                url: "{{ route('locations.getRegionCities') }}",
                type: "GET",
                data: {
                    region_id: region_id
                },
                success: function(response) {
                    // UnblockUI
                    KTApp.unblockPage();
                    // Show notification
                    if (response.status) {
                        // Insert empty city first
                        $('#city_id').append($('<option>', {
                            value: "",
                            text: "{{ __('inventory::inventory.select_city') }}"
                        }));
                        $.each(response.data, function(i, city) {
                            $('#city_id').append($('<option>', {
                                value: city.id,
                                text: city.name
                            }));
                        });
                        console.log(jQuery.type(selected_city_id));

                        if (selected_city_id != null) {
                            $('#city_id').selectpicker('val', selected_city_id);
                        }
                        $("#city_id").selectpicker("refresh");
                    } else {
                        showNotification(response.message, "{{ trans('main.error') }}", 'la la-warning',
                            null, 'danger', true, true, true);
                    }
                },
                error: function(xhr, error_text, statusText) {
                    // UnblockUI
                    KTApp.unblockPage();

                    if (xhr.status == 401) {
                        // Unauthorized
                        if (xhr.responseJSON.error) {
                            setTimeout(function() {
                                window.scrollTo({
                                    top: 0,
                                    behavior: 'smooth'
                                });
                                showMsg(form, 'danger', xhr.responseJSON.error, true);
                            }, 500);
                            showNotification(xhr.responseJSON.error, "{{ trans('main.error') }}",
                                'la la-warning', null, 'danger', true, true, true);
                        } else {
                            setTimeout(function() {
                                window.scrollTo({
                                    top: 0,
                                    behavior: 'smooth'
                                });
                                showMsg(form, 'danger', statusText, true);
                            }, 500);
                            showNotification(statusText, "{{ trans('main.error') }}", 'la la-warning',
                                null, 'danger', true, true, true);
                        }
                    } else if (xhr.status == 422) {
                        // HTTP_UNPROCESSABLE_ENTITY
                        if (xhr.responseJSON.errors) {
                            window.scrollTo({
                                top: 0,
                                behavior: 'smooth'
                            });
                            $.each(xhr.responseJSON.errors, function(index, error) {
                                setTimeout(function() {
                                    if (index === 0) {
                                        var remove_previous_alerts = true;
                                    } else {
                                        var remove_previous_alerts = false;
                                    }
                                    showMsg(form, 'danger', error.message,
                                        remove_previous_alerts);
                                }, 500);
                                showNotification(error.message, "{{ trans('main.error') }}",
                                    'la la-warning', null, 'danger', true, true, true);
                            });
                        } else {
                            setTimeout(function() {
                                window.scrollTo({
                                    top: 0,
                                    behavior: 'smooth'
                                });
                                showMsg(form, 'danger', statusText, true);
                            }, 500);
                            showNotification(statusText, "{{ trans('main.error') }}", 'la la-warning',
                                null, 'danger', true, true, true);
                        }
                    } else if (xhr.status == 500) {
                        // Internal Server Error
                        var error = xhr.responseJSON.message;
                        if (xhr.responseJSON.error) {
                            setTimeout(function() {
                                window.scrollTo({
                                    top: 0,
                                    behavior: 'smooth'
                                });
                                showMsg(form, 'danger', xhr.responseJSON.error, true);
                            }, 500);
                            showNotification(xhr.responseJSON.error, "{{ trans('main.error') }}",
                                'la la-warning', null, 'danger', true, true, true);
                        } else {
                            setTimeout(function() {
                                window.scrollTo({
                                    top: 0,
                                    behavior: 'smooth'
                                });
                                showMsg(form, 'danger', statusText, true);
                            }, 500);
                            showNotification(statusText, "{{ trans('main.error') }}", 'la la-warning',
                                null, 'danger', true, true, true);
                        }
                    }
                }
            });
        }
    }

    function getCityAreas(city_id, selected_area_id = null) {

        // BlockUI
        KTApp.blockPage({
            overlayColor: "#000000",
            type: "loader",
            state: "success",
            message: "{{ trans('main.please_wait') }}"
        });
        if (city_id) {
            $('#area_id').empty();
            $("#area_id").selectpicker("refresh");
            $.ajax({
                url: "{{ route('locations.getCityAreas') }}",
                type: "GET",
                data: {
                    city_id: city_id
                },
                success: function(response) {
                    // UnblockUI
                    KTApp.unblockPage();
                    // Show notification
                    if (response.status) {
                        // Insert empty area first
                        $('#area_id').append($('<option>', {
                            value: "",
                            text: "{{ __('inventory::inventory.select_area') }}"
                        }));
                        $.each(response.data, function(i, area) {
                            $('#area_id').append($('<option>', {
                                value: area.id,
                                text: area.name
                            }));
                        });
                        if (selected_area_id) {
                            $('#area_id').selectpicker('val', selected_area_id);
                        }
                        $("#area_id").selectpicker("refresh");
                    } else {
                        showNotification(response.message, "{{ trans('main.error') }}", 'la la-warning',
                            null, 'danger', true, true, true);
                    }
                },
                error: function(xhr, error_text, statusText) {
                    // UnblockUI
                    KTApp.unblockPage();

                    if (xhr.status == 401) {
                        // Unauthorized
                        if (xhr.responseJSON.error) {
                            setTimeout(function() {
                                window.scrollTo({
                                    top: 0,
                                    behavior: 'smooth'
                                });
                                showMsg(form, 'danger', xhr.responseJSON.error, true);
                            }, 500);
                            showNotification(xhr.responseJSON.error, "{{ trans('main.error') }}",
                                'la la-warning', null, 'danger', true, true, true);
                        } else {
                            setTimeout(function() {
                                window.scrollTo({
                                    top: 0,
                                    behavior: 'smooth'
                                });
                                showMsg(form, 'danger', statusText, true);
                            }, 500);
                            showNotification(statusText, "{{ trans('main.error') }}", 'la la-warning',
                                null, 'danger', true, true, true);
                        }
                    } else if (xhr.status == 422) {
                        // HTTP_UNPROCESSABLE_ENTITY
                        if (xhr.responseJSON.errors) {
                            window.scrollTo({
                                top: 0,
                                behavior: 'smooth'
                            });
                            $.each(xhr.responseJSON.errors, function(index, error) {
                                setTimeout(function() {
                                    if (index === 0) {
                                        var remove_previous_alerts = true;
                                    } else {
                                        var remove_previous_alerts = false;
                                    }
                                    showMsg(form, 'danger', error.message,
                                        remove_previous_alerts);
                                }, 500);
                                showNotification(error.message, "{{ trans('main.error') }}",
                                    'la la-warning', null, 'danger', true, true, true);
                            });
                        } else {
                            setTimeout(function() {
                                window.scrollTo({
                                    top: 0,
                                    behavior: 'smooth'
                                });
                                showMsg(form, 'danger', statusText, true);
                            }, 500);
                            showNotification(statusText, "{{ trans('main.error') }}", 'la la-warning',
                                null, 'danger', true, true, true);
                        }
                    } else if (xhr.status == 500) {
                        // Internal Server Error
                        var error = xhr.responseJSON.message;
                        if (xhr.responseJSON.error) {
                            setTimeout(function() {
                                window.scrollTo({
                                    top: 0,
                                    behavior: 'smooth'
                                });
                                showMsg(form, 'danger', xhr.responseJSON.error, true);
                            }, 500);
                            showNotification(xhr.responseJSON.error, "{{ trans('main.error') }}",
                                'la la-warning', null, 'danger', true, true, true);
                        } else {
                            setTimeout(function() {
                                window.scrollTo({
                                    top: 0,
                                    behavior: 'smooth'
                                });
                                showMsg(form, 'danger', statusText, true);
                            }, 500);
                            showNotification(statusText, "{{ trans('main.error') }}", 'la la-warning',
                                null, 'danger', true, true, true);
                        }
                    }
                }
            });
        }
    };
</script>

<script>
    @if ($i_unit->latitude && $i_unit->longitude)
        MapHelper.initMap(true, true, true, false, {
        'lat': '{{ $i_unit->latitude }}',
        'lng': '{{ $i_unit->longitude }}',
        'id': 'map',
        'map_search': 'map_search'
        });
    @else
        MapHelper.initMap(true, true, true, false);
    @endif
</script>

<script>
    function appendProjectData(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var headers = {
            'Content-Type': 'application/json',
        }
        var data = {
            'id': id
        }
        var url = '{{ route('inventory.projects.select') }}'

        $.post(url, data, headers).done(function(response) {
            // Area unit selection
            if (response.i_area_unit_id) {
                $(`#i_area_unit_id`).val(response.i_area_unit_id).change();
            }

            // Area min and max restriction
            if (response.area_from && response.area_to) {
                $('#area').attr({
                    'max': response.area_to,
                    'min': response.area_from
                });
            }

            // Map location
            if (response.latitude && response.longitude) {
                $('#lat').val(response.latitude);
                $('#lng').val(response.longitude);
                MapHelper.initMap(true, true, true, false, {
                    'lat': response.latitude,
                    'lng': response.longitude,
                    'id': 'map',
                    'map_search': 'map_search'
                });
            }

            // Currency code
            if (response.currency_code) {
                $(`#currency_code`).val(response.currency_code).change();
            }

            // Down payment restriction
            if (response.down_payment_from && response.down_payment_to) {
                $('#down_payment').attr({
                    'max': response.down_payment_to,
                    'min': response.down_payment_from
                });
            }

            // Price restriction
            if (response.price_from && response.price_to) {
                $('#price').attr({
                    'max': response.price_to,
                    'min': response.price_from
                });
            }

            // Number of installments restriction
            if (response.number_of_installments_from && response.number_of_installments_to) {
                $('#number_of_installments').attr({
                    'max': response.number_of_installments_to,
                    'min': response.number_of_installments_from
                });
            }

            // Facilities selection
            if (response.facilities && response.facilities.length > 0) {
                var facilities = response.facilities;
                var values = new Array();
                for (var i = 0; i < facilities.length; i++) {
                    values.push(facilities[i].id);
                    $('#facilities').val(values).trigger('change');
                }
            }

            // Amenities selection
            if (response.amenities && response.amenities.length > 0) {
                var amenities = response.amenities;
                var values = new Array();
                for (var i = 0; i < amenities.length; i++) {
                    values.push(amenities[i].id);
                    $('#amenities').val(values).trigger('change');
                }
            }

            // Tags selection
            if (response.tags && response.tags.length > 0) {
                var tags = response.tags;
                var values = new Array();
                for (var i = 0; i < tags.length; i++) {
                    values.push(tags[i].id);
                    $('#tags').val(values).trigger('change');
                }
            }
            // Unit Types Selection 
            if (response.unit_types && response.unit_types.length > 0) {
                var unit_types = response.unit_types;
                $.each(unit_types, function(i, unit_type) {
                    $('#unit_types').append($('<option>', {
                        value: unit_type.id,
                        text: unit_type.value ? unit_type.value : unit_type.value,
                        selected: (unit_type.id ==
                            {{ $i_unit->i_unit_type_id ? $i_unit->i_unit_type_id : 0 }}
                            ) ? "selected" : ""
                    }));
                });
                $('#unit_types').selectpicker("refresh");
            }
            // Country, region, city, area
            if (response.country_id) {
                $(`#country_id`).val(response.country_id).change();
                if (response.region_id) {
                    getCountryRegions(response.country_id, response.region_id);
                    if (response.city_id) {
                        getRegionCities(response.region_id, response.city_id);
                        if (response.area_id) {
                            /* Delay the loading until areas reload occurs */
                            setTimeout(
                                function() {
                                    getCityAreas(response.city_id, response.area_id);
                                }, 5000);
                        } else {
                            getCityAreas(response.city_id);
                        }
                    }
                }
            }
        })
    }

    $('#i_project_id').on('change', function() {
        var project_data = appendProjectData($(this).val());
    });
</script>

<script>
    @if ($i_unit->seller)
        $('#seller_id').tagsinput('add', {"id":"{{ $i_unit->seller->id }}","name":"{{ $i_unit->seller->full_name }}"});
    @endif
    @if ($i_unit->buyer)
        $('#buyer_id').tagsinput('add', {"id":"{{ $i_unit->buyer->id }}","name":"{{ $i_unit->buyer->full_name }}"});
    @endif

    @if ($i_unit->i_purpose_id && $i_unit->i_purpose_type_id)
        getPurposePurposeTypes([{{ $i_unit->i_purpose_id }}],{{ $i_unit->i_purpose_type_id }})
    @endif
</script>

<script>
    $(document).ready(function() {
        $('.repeater').repeater({
            // (Required if there is a nested repeater)
            // Specify the configuration of the nested repeaters.
            // Nested configuration follows the same format as the base configuration,
            // supporting options "defaultValues", "show", "hide", etc.
            // Nested repeaters additionally require a "selector" field.
            repeaters: [{
                // (Required)
                // Specify the jQuery selector for this nested repeater
                selector: '.inner-repeater'
            }],
            show: function() {
                // Get items count
                var items_count = $('.repeater').repeaterVal().translations.length;
                var current_index = items_count - 1;

                /* Summernote */
                // Update the textarea id
                $(this).find('.note-editor').remove(); // Remove repeated summernote
                $(this).find('.description').attr('id', 'description-' + current_index);

                $('#description-' + current_index).summernote({
                    imageTitle: {
                        specificAltField: true,
                    },
                    popover: {
                        image: [
                            ['imagesize', ['imageSize100', 'imageSize50',
                                'imageSize25'
                            ]],
                            ['float', ['floatLeft', 'floatRight', 'floatNone']],
                            ['remove', ['removeMedia']],
                            ['custom', ['imageAttributes']],
                        ],
                    },
                    height: '300px',
                });

                // Showing the item
                $(this).show();
            }
        });
    });
</script>
<script>
    // Initialize select picker for repeated items
    $("#repeater_btn").click(function() {
        setTimeout(function() {
            // $(".selectpicker").selectpicker('refresh');
        }, 100);
    });
</script>

<script>
    $(document).ready(function() {
        $('.repeater-attachments').repeater({
            // (Required if there is a nested repeater)
            // Specify the configuration of the nested repeaters.
            // Nested configuration follows the same format as the base configuration,
            // supporting options "defaultValues", "show", "hide", etc.
            // Nested repeaters additionally require a "selector" field.
            repeaters: [{
                // (Required)
                // Specify the jQuery selector for this nested repeater
                selector: '.inner-repeater'
            }],
            show: function() {
                $(this).find('.card').hide();
                // Showing the item
                $(this).show();
            }
        });
    });
</script>
<script>
    // Initialize select picker for repeated items
    $("#repeater_btn_attachments").click(function() {
        setTimeout(function() {
            // $(".selectpicker").selectpicker('refresh');
        }, 100);
    });
</script>

<script>
    $(document).ready(function() {
        $('.repeater-floor_plans').repeater({
            // (Required if there is a nested repeater)
            // Specify the configuration of the nested repeaters.
            // Nested configuration follows the same format as the base configuration,
            // supporting options "defaultValues", "show", "hide", etc.
            // Nested repeaters additionally require a "selector" field.
            repeaters: [{
                // (Required)
                // Specify the jQuery selector for this nested repeater
                selector: '.inner-repeater'
            }],
            show: function() {
                $(this).find('.card').hide();
                // Showing the item
                $(this).show();
            }
        });
    });
</script>
<script>
    // Initialize select picker for repeated items
    $("#repeater_btn_floor_plans").click(function() {
        setTimeout(function() {
            // $(".selectpicker").selectpicker('refresh');
        }, 100);
    });
</script>

<script>
    $(document).ready(function() {
        $('.repeater-master_plans').repeater({
            // (Required if there is a nested repeater)
            // Specify the configuration of the nested repeaters.
            // Nested configuration follows the same format as the base configuration,
            // supporting options "defaultValues", "show", "hide", etc.
            // Nested repeaters additionally require a "selector" field.
            repeaters: [{
                // (Required)
                // Specify the jQuery selector for this nested repeater
                selector: '.inner-repeater'
            }],
            show: function() {
                $(this).find('.card').hide();
                // Showing the item
                $(this).show();
            }
        });
    });
</script>
<script>
    // Initialize select picker for repeated items
    $("#repeater_btn_master_plans").click(function() {
        setTimeout(function() {
            // $(".selectpicker").selectpicker('refresh');
        }, 100);
    });
</script>

<script>
    $(document).ready(function() {
        $('.repeater-images-360').repeater({
            // (Required if there is a nested repeater)
            // Specify the configuration of the nested repeaters.
            // Nested configuration follows the same format as the base configuration,
            // supporting options "defaultValues", "show", "hide", etc.
            // Nested repeaters additionally require a "selector" field.
            repeaters: [{
                // (Required)
                // Specify the jQuery selector for this nested repeater
                selector: '.inner-repeater'
            }]
        });
    });
</script>

<script>
    @if ($i_unit->translations->count())
        @foreach ($i_unit->translations as $index => $translation)
            // Summernote
            $('#description-'+'{{ $index }}').summernote({
            imageTitle: {
            specificAltField: true,
            },
            popover: {
            image: [
            ['imagesize', ['imageSize100', 'imageSize50',
            'imageSize25'
            ]],
            ['float', ['floatLeft', 'floatRight', 'floatNone']],
            ['remove', ['removeMedia']],
            ['custom', ['imageAttributes']],
            ],
            },
            height: '300px',
            });
        @endforeach
    @else
        // Summernote
        $('#description-'+'0').summernote({
        imageTitle: {
        specificAltField: true,
        },
        popover: {
        image: [
        ['imagesize', ['imageSize100', 'imageSize50',
        'imageSize25'
        ]],
        ['float', ['floatLeft', 'floatRight', 'floatNone']],
        ['remove', ['removeMedia']],
        ['custom', ['imageAttributes']],
        ],
        },
        height: '300px',
        });
    @endif
</script>

<script>
    $('.save-continue').click(function() {
        $('#creation_type').val('save_continue');
        $('#update_unit_form').submit();
    });
    $('.save-only').click(function() {
        $('#creation_type').val('save_only');
        $('#update_unit_form').submit();
    });
</script>

<script>
    $(document).ready(function() {
        $('.repeater_payment_plans').repeater({
            // (Required if there is a nested repeater)
            // Specify the configuration of the nested repeaters.
            // Nested configuration follows the same format as the base configuration,
            // supporting options "defaultValues", "show", "hide", etc.
            // Nested repeaters additionally require a "selector" field.
            repeaters: [{
                // (Required)
                // Specify the jQuery selector for this nested repeater
                selector: '.inner-repeater'
            }],
            show: function() {
                $(this).find('.payment_plan_delivery_date').datepicker({
                    format: 'yyyy-mm',
                    startView: "months",
                    minViewMode: "months"
                });
                $(this).show();
            }
        });
        $('.payment_plan_delivery_date').datepicker({
            format: 'yyyy-mm',
            startView: "months",
            minViewMode: "months"
        });
    });
</script>