<script>
    $('.m_selectpicker').selectpicker();
</script>

<script>
    // Filter Action
    var globalQueryURL = "{{ route('inventory.units.index') }}";
    var globalQueryFilterForm = '';
    var globalQueryQuickFilterForm = '';

    var globalExportRoute = '';

    function init_BITable(url) {
        var table = $('#units_table');
        return table.DataTable({
            order: [0, 'desc'],
            dom: '<"top"i>Bfrtlp',
            buttons: [],
            responsive: true,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            language: {
                search: "{{ __('datatables.search') }}",
                emptyTable: "{{ __('datatables.no_records_available') }}",
                info: "{{ __('datatables.showing_page') }} _START_ {{ __('datatables.of') }} _END_ {{ __('datatables.of') }} _TOTAL_ ",

                infoEmpty: "{{ __('datatables.showing_page') }} _START_ {{ __('datatables.of') }} _END_ {{ __('datatables.of') }} _TOTAL_",
            },
            pagingType: 'full_numbers',
            ajax: {
                url: url,
                type: 'POST',
                data: {
                    // Parameters
                    columnsDef: [
                        //
                    ],
                },
            },
            columns: [{
                    data: 'id',
                    visible: true,
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'title',
                    visible: true,
                    orderable: false,
                    searchable: true
                },
                {
                    data: 'area',
                    visible: true,
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'offering_type',
                    visible: true,
                    orderable: true,
                    searchable: false
                },
                {
                    data: 'city',
                    visible: true,
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'price',
                    visible: true,
                    orderable: true,
                    searchable: false
                },
            ],
            columnDefs: [{
                    targets: 0,
                    title: '#',
                    render: function(data, type, full, meta) {
                        return full.id;
                    }
                },
                {
                    targets: 1,
                    title: "{{ __('inventory::inventory.title') }}",
                    render: function(data, type, full, meta) {

                        return full.title;

                    },
                },
                {
                    targets: 2,
                    title: "{{ trans('inventory::inventory.space') }}",
                    render: function(data, type, full, meta) {
                        if (full.area) {
                            return '<i class="icon fa fa-expand-arrows-alt kt-margin-r-5"></i>' +
                                full.area + ' ' + full.area_unit;
                        } else {
                            return '<small>--</small>';
                        }
                    },
                },
                {
                    targets: 3,
                    title: "{{ trans('inventory::inventory.offering_type') }}",
                    render: function(data, type, full, meta) {
                        if (full.offering_type) {
                            return full.offering_type;
                        } else {
                            return '<small>--</small>';
                        }
                    },
                },
                {
                    targets: 4,
                    title: "{{ trans('inventory::inventory.location') }}",
                    render: function(data, type, full, meta) {
                        var text = '';
                        text += full.country ? full.country : '';
                        text += full.region ? (full.country ? ' - ' : '') + full.region : '';
                        text += full.city ? (full.country || full.region ? ' - ' : '') + full.city : '';
                        text += full.area_place ? (full.country || full.region || full.city ? ' - ' :
                            '') + full.area_place : '';
                        text += full.address ? ' - ' + full.address : '';
                        text = (text == '') ? '--' : text;
                        return '<span data-skin="brand" data-toggle="kt-tooltip" data-placement="top" title="' +
                            text + '" data-original-title="' + text +
                            '"><i class="fas fa-map-marker-alt kt-margin-r-5"></i>' + text + '</span>';
                    },
                },
                {
                    targets: 5,
                    title: "{{ trans('inventory::inventory.price') }}",
                    render: function(data, type, full, meta) {
                        if (full.payment_method) {
                            var payment_method =
                                '<span class="kt-badge kt-badge--primary kt-badge--inline kt-badge--pill kt-margin-l-5">' +
                                full.payment_method + '</span>';
                        } else {
                            var payment_method = '';
                        }
                        if (full.price) {
                            return '<i class="fas fa-money-bill kt-margin-r-5"></i>' + full
                                .price + ' ' + full.currency_code + payment_method;
                        } else {
                            return '<small>--</small>' + payment_method;
                        }
                    },
                },
                // {
                //     targets: 6,
                //     title: "{{ trans('inventory::inventory.description') }}",
                //     render: function(data, type, full, meta) {
                //        return full.description;
                //     },
                // },
                {
                    targets: 6,
                    title: "{{ trans('inventory::inventory.created_at') }}",
                    render: function(data, type, full, meta) {
                        return full.created_at
                    },
                },
                {
                    targets: 7,
                    title: "{{ trans('inventory::inventory.last_updated_at') }}",
                    render: function(data, type, full, meta) {
                        return full.last_updated_at
                    },
                },
                {
                    targets: 8,
                    title: "{{ trans('inventory::inventory.last_updated_by') }}",
                    render: function(data, type, full, meta) {
                        return full.last_updated_by
                    },
                },
                {
                    targets: 9,
                    title: '',
                    render: function(data, type, full, meta) {
                        var view_url =
                            "{{ route('front.singleUnit', ['id' => 'id', 'title' => 'title']) }}";
                        view_url = view_url.replace('id', full.id);
                        view_url = view_url.replace('title',
                            `${full.title ? full.title.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,'') :(full.default_title?full.default_title.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,''):'')}`
                            );

                        var landing = "{{ route('landing', ':id-slug') }}";
                        landing = landing.replace(':id', full.id);
                        landing = landing.replace('slug', full.slug);

                        var update_url = "{{ route('inventory.units.modals.update', ':id') }}";
                        update_url = update_url.replace(':id', full.id);

                        var delete_url = "{{ route('inventory.units.delete', 'id=:id') }}";
                        delete_url = delete_url.replace(':id', full.id);

                        @if (auth()->user()->hasPermission('update-inventory-unit') ||
    auth()->user()->hasPermission('delete-inventory-unit'))
                            var value = ``;
                            @if (auth()->user()->hasPermission('index-inventory-units'))
                                value += `<a href="`+view_url+`" class="btn btn-outline-hover-brand btn-sm btn-circle"><i
                                        class="fas fa-info-circle"></i> {{ trans('inventory::inventory.view_unit') }}</a>`;
                            @endif
                            @if (auth()->user()->hasPermission('delete-inventory-unit'))
                                value += `<a class="btn btn-outline-hover-brand btn-sm btn-circle"
                                    data-8x-delete-it='{"container":false, "path":"` + delete_url + `", "callback": "DeleteIUnitCallback"}'
                                    href="#"><i class="la la-trash"></i> {{ __('inventory::inventory.delete') }}</a>`;
                            @endif
                            @if (auth()->user()->hasPermission('update-inventory-unit'))
                                value += `<a href="`+update_url+`" title="{{ trans('inventory::inventory.update_unit') }}"
                                    data-path="`+update_url+`" data-title="{{ trans('inventory::inventory.update_unit') }}"
                                    data-id="`+full.id+`" data-modal-load class="btn btn-outline-hover-brand btn-sm btn-circle"><i
                                        class="fas fa-pen"></i> {{ trans('inventory::inventory.update') }}</a>`;
                            @endif
                            return value;
                        @else
                            return ``;
                        @endif
                    },
                },

            ],
            initComplete: function(settings, json) {
                KTApp.initTooltips({
                    html: true
                });
                KTApp.initPopovers({
                    html: true
                });
            },
            drawCallback: function(settings, json) {
                KTApp.initTooltips({
                    html: true
                });
                KTApp.initPopovers({
                    html: true
                });
            }
        });
    }

    jQuery(document).ready(function() {
        // Init datatable
        var units_table = init_BITable(globalQueryURL);

        // Search datatable
        $('#m_search').on('click', function(e) {
            e.preventDefault();
            var query = $('#search_units_form').serialize();
            var table = $('#units_table').DataTable();
            table.ajax.url("{{ route('inventory.units.index') }}" + '?' + query).load();
        });

        // Export datatable
        $('#m_export').on('click', function(e) {
            $("#search_units_form").submit();
        });

        // Reset search form
        $('#m_reset').on('click', function(e) {
            e.preventDefault();
            $(this).closest('form').trigger("reset");
            var table = $('#units_table').DataTable();
            table.ajax.url("{{ route('inventory.units.index') }}").load();
        });

    });

    function moreDetails(full) {
        var system_id = "{{ trans('inventory::inventory.system_id') }}<b>'" + full.id + "'</b><br>";
        var seller_name = '';
        var seller_phones = '';
        var purpose = '';
        var bedroom = '';
        var bathroom = '';

        if (full.seller && full.seller.full_name) {
            seller_name = "{{ trans('inventory::inventory.seller') }}: <b>'" + full.seller.full_name + "'</b><br>";
        }

        if (full.seller && full.seller.phones) {
            var phones = full.seller.phones;

            phones.forEach(element => {
                seller_phones += element.phone + ' - ';
            });

            seller_phones = seller_phones.slice(0, -3);
            seller_phones = "{{ trans('inventory::inventory.phone') }}: <b>'" + seller_phones + "'</b><br>";
        }

        if (full.purpose) {
            purpose = "{{ trans('inventory::inventory.type') }}: <b>'" + full.purpose + "'</b><br>";
        }

        if (full.bedroom) {
            bedroom = "{{ trans('inventory::inventory.bedrooms') }}: <b>'" + full.bedroom + "'</b><br>";
        }

        if (full.bathroom) {
            bathroom = "{{ trans('inventory::inventory.bathrooms') }}: <b>'" + full.bathroom + "'</b><br>";
        }



        return seller_name + seller_phones + purpose + bedroom + bathroom + '<hr>' + system_id;
    }
</script>

<script>
    var elt = $('#seller_ids');

    var sellers = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('id'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '{!! route('users.tagsinput') !!}' + '?needle=%QUERY%',
            wildcard: '%QUERY%',
        }
    });
    sellers.initialize();

    $('#seller_ids').tagsinput({
        itemValue: 'id',
        itemText: 'name',
        maxChars: 100,
        // maxTags: 1,
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
                name: 'seller_ids',
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

    var elt = $('#buyer_ids');

    var buyers = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('id'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '{!! route('users.tagsinput') !!}' + '?needle=%QUERY%',
            wildcard: '%QUERY%',
        }
    });
    buyers.initialize();

    $('#buyer_ids').tagsinput({
        itemValue: 'id',
        itemText: 'name',
        maxChars: 100,
        // maxTags: 1,
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
                name: 'buyer_ids',
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
    $('.tagsinput-free').tagsinput({
        maxChars: 191,
        // maxTags: 1,
        trimValue: true,
        allowDuplicates: false,
        freeInput: true,
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
        confirmKeys: [44], // Change the confirm key to be a comma instead of submitting the form using enter
    });
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
                            $("#" + div_id).append($('<option>', {
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
    function getCountryRegions(country_ids, selected_region_id = null) {
        $('#region_id').empty();
        $("#region_id").selectpicker("refresh");
        $('#city_id').empty();
        $("#city_id").selectpicker("refresh");
        $('#area_id').empty();
        $("#area_id").selectpicker("refresh");

        // BlockUI
        if (country_ids.length) {
            KTApp.blockPage({
                overlayColor: "#000000",
                type: "loader",
                state: "success",
                message: "{{ trans('main.please_wait') }}"
            });
        }

        if (!Array.isArray(country_ids)) {
            country_ids = [country_ids];
        }

        for (var i = 0; i < country_ids.length; i++) {
            if (country_ids[i]) {
                $.ajax({
                    url: "{{ route('locations.getCountryRegions') }}",
                    type: "GET",
                    data: {
                        country_id: country_ids[i]
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
                            if (selected_region_id) {
                                $('#region_id').selectpicker('val', selected_region_id);
                            }
                            $("#region_id").selectpicker("refresh");
                        } else {
                            showNotification(response.message, "{{ trans('main.error') }}",
                                'la la-warning', null, 'danger', true, true, true);
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
    }

    function getRegionCities(region_ids, selected_city_id = null) {
        $('#city_id').empty();
        $("#city_id").selectpicker("refresh");
        $('#area_id').empty();
        $("#area_id").selectpicker("refresh");

        // BlockUI
        if (region_ids.length) {
            KTApp.blockPage({
                overlayColor: "#000000",
                type: "loader",
                state: "success",
                message: "{{ trans('main.please_wait') }}"
            });
        }

        if (!Array.isArray(region_ids)) {
            region_ids = [region_ids];
        }

        for (var i = 0; i < region_ids.length; i++) {
            if (region_ids[i]) {
                $.ajax({
                    url: "{{ route('locations.getRegionCities') }}",
                    type: "GET",
                    data: {
                        region_id: region_ids[i]
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
                            if (selected_city_id) {
                                $('#city_id').selectpicker('val', selected_city_id);
                            }
                            $("#city_id").selectpicker("refresh");
                        } else {
                            showNotification(response.message, "{{ trans('main.error') }}",
                                'la la-warning', null, 'danger', true, true, true);
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
    }

    function getCityAreas(city_id, selected_area_id = null) {
        $('#area_id').empty();
        $("#area_id").selectpicker("refresh");

        // BlockUI
        KTApp.blockPage({
            overlayColor: "#000000",
            type: "loader",
            state: "success",
            message: "{{ trans('main.please_wait') }}"
        });

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
                    showNotification(response.message, "{{ trans('main.error') }}", 'la la-warning', null,
                        'danger', true, true, true);
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
                        showNotification(statusText, "{{ trans('main.error') }}", 'la la-warning', null,
                            'danger', true, true, true);
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
                        showNotification(statusText, "{{ trans('main.error') }}", 'la la-warning', null,
                            'danger', true, true, true);
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
                        showNotification(statusText, "{{ trans('main.error') }}", 'la la-warning', null,
                            'danger', true, true, true);
                    }
                }
            }
        });
    }
</script>

<script>
    function DeleteIUnitCallback() {
        var units_table = $('#units_table').DataTable();
        units_table.ajax.reload(null, false);
    }
</script>

<script>
    var elt = $('#i_project_ids');

    var projects = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('id'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '{!! route('inventory.projects.tagsinput') !!}' + '?needle=%QUERY%',
            wildcard: '%QUERY%',
        }
    });
    projects.initialize();

    $('#i_project_ids').tagsinput({
        itemValue: 'id',
        itemText: 'name',
        maxChars: 100,
        // maxTags: 1,
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
                name: 'i_project_ids',
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
