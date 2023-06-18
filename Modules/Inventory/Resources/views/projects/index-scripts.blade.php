<script>
    $('.m_selectpicker').selectpicker();
</script>

<script>
    // Filter Action
    var globalQueryURL = "{{ route('inventory.projects.index') }}";
    var globalQueryFilterForm = '';
    var globalQueryQuickFilterForm = '';

    var globalExportRoute = '';

    function init_BITable(url) {
        var table = $('#projects_table');
        return table.DataTable({
            order: [0, 'desc'],
            dom: '<"top"i>Bfrtlp',
            buttons: [],
            responsive: true,
            searchDelay: 500,
            processing: true,
                        serverSide: true,
            language:{
                search:"{{__('datatables.search')}}",
                emptyTable:"{{__('datatables.no_records_available')}}",
                info:"{{__('datatables.showing_page')}} _START_ {{__('datatables.of')}} _END_ {{__('datatables.of')}} _TOTAL_ ",

                infoEmpty:"{{__('datatables.showing_page')}} _START_ {{__('datatables.of')}} _END_ {{__('datatables.of')}} _TOTAL_",
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
                    data: 'value',
                    visible: true,
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'area_from',
                    visible: true,
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'city',
                    visible: true,
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'price_from',
                    visible: true,
                    orderable: true,
                    searchable: true
                },
            ],
            columnDefs: [{
                    targets: 0,
                    title: '#',
                    render: function(data, type, full, meta) {
                        var project = '<span class="kt-badge kt-badge--primary kt-badge--inline kt-badge--pill kt-margin-l-5"><i class="fas fa-plus-circle kt-margin-r-5"></i>' + (full.value ? full.value : full.default_value) + '</span>';

                        var more_details = moreDetails(full);

                        return '<span data-toggle="kt-popover" title="" data-html="true" data-content="' + more_details + '" data-original-title="#' + (full.value ? full.value : full.default_value) + '">' + project + '</span>';
                    },
                },
                {
                    targets: 1,
                    title: "{{trans('inventory::inventory.area_from')}}",
                    render: function(data, type, full, meta) {
                        if (full.area_from) {
                            var area_unit = full.area_unit != null ? full.area_unit.value : '';
                            return '<i class="icon fa fa-expand-arrows-alt kt-margin-r-5"></i>' + full.area_from + ' ' + area_unit;
                        } else {
                            return '<small>--</small>';
                        }
                    },
                },
                // {
                //     targets: 2,
                //     title: "{{trans('inventory::inventory.area_to')}}",
                //     render: function(data, type, full, meta) {
                //         if (full.area_to) {
                //             var area_unit = full.area_unit != null ? full.area_unit.value : '';
                //             return '<i class="icon fa fa-expand-arrows-alt kt-margin-r-5"></i>' + digits(full.area_to) + ' ' + area_unit;
                //         } else {
                //             return '<small>--</small>';
                //         }
                //     },
                // },
                {
                    targets: 2,
                    title: "{{trans('inventory::inventory.location')}}",
                    render: function(data, type, full, meta) {
                        var text = '';
                        text += full.country ? full.country.value : '';
                        text += full.region ? (full.country ? ' - ' : '') + full.region.value : '';
                        text += full.city ? (full.country || full.region ? ' - ' : '') + full.city.value : '';
                        text += full.area ? (full.country || full.region || full.city  ? ' - ' : '') + full.area.value : '';
                        text += full.address ? ' - ' + full.address : '';
                        text = (text == '') ? '--' : text;
                        return '<span data-skin="brand" data-toggle="kt-tooltip" data-placement="top" title="' + text + '" data-original-title="' + text + '"><i class="fas fa-map-marker-alt kt-margin-r-5"></i>' + (full.city ? full.city.value : '--') + '</span>';
                    },
                },
                {
                    targets: 3,
                    title: "{{trans('inventory::inventory.price_from')}}",
                    render: function(data, type, full, meta) {
                        if (full.currency_code) {
                            var currency_code = '<span class="kt-badge kt-badge--primary kt-badge--inline kt-badge--pill kt-margin-l-5">' + full.currency_code + '</span>';
                        } else {
                            var currency_code = '';
                        }
                        if (full.price_from) {
                            return '<i class="fas fa-money-bill kt-margin-r-5"></i>' + full.price_from + ' ' + full.currency_code + currency_code;
                        } else {
                            return '<small>--</small>' + currency_code;
                        }
                    },
                },
                {
                    targets: 4,
                    title: "{{trans('inventory::inventory.status')}}",
                    render: function(data, type, full, meta) {
                        return full.is_featured ? '{{__("inventory::inventory.featured")}}' : ''
                    },
                },
                {
                    targets: 5,
                    title: "{{trans('inventory::inventory.published')}}",
                    render: function(data, type, full, meta) {
                        return full.is_published ? '{{__("inventory::inventory.published")}}' : '{{__("inventory::inventory.un_publish")}}'
                    },
                },
                {
                    targets: 6,
                    title: "{{trans('inventory::inventory.created_at')}}",
                    render: function(data, type, full, meta) {
                        return full.created_at
                    },
                },
                {
                    targets: 7,
                    title: "{{trans('inventory::inventory.last_updated_at')}}",
                    render: function(data, type, full, meta) {
                        return full.last_updated_at
                    },
                },
                {
                    targets: 8,
                    title: "{{trans('inventory::inventory.last_updated_by')}}",
                    render: function(data, type, full, meta) {
                        return full.last_updated_by
                    },
                },
                {
                    targets: 9,
                    title: '',
                    render: function(data, type, full, meta) {

                        var view_url = "{{route('front.singleProject',['id' => 'id','slug'=>'slug'])}}";
                        view_url = view_url.replace('id', full.id);
                        view_url = view_url.replace('slug',`${ full.value ? full.value.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,'') :full.default_value.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,'')}`);

                        var update_url = "{{route('inventory.projects.modals.update',':id')}}";
                        update_url = update_url.replace(':id', full.id);

                        var delete_url = "{{route('inventory.projects.delete', 'id=:id')}}";
                        delete_url = delete_url.replace(':id', full.id);

                        var publish_url = "{{route('inventory.projects.publish', 'id=:id')}}";
                        publish_url = publish_url.replace(':id', full.id);
                        var publish_view_url = "{{route('front.publishedProject', 'publish_id=:id')}}";
                        publish_view_url = publish_view_url.replace('publish_id=:id', full.slug);

                        var get_project = "";
                        get_project = full.value ? full.value : full.default_value;

                        @if(auth()->user()->hasPermission('index-inventory-projects') || auth()->user()->hasPermission('update-inventory-project') || auth()->user()->hasPermission('delete-inventory-project'))
                            var value = ``;
                            @if(auth()->user()->hasPermission('index-inventory-projects'))
                                value += `<a href="` + view_url + `" class="btn btn-outline-hover-brand btn-sm btn-circle"><i class="fas fa-info-circle"></i> {{trans('inventory::inventory.view_project')}}</a>`;
                                if(full.is_published){
                                    value += `<a href="` + publish_view_url + `"> {{trans('main.landing')}}</a>`;
                                }

                            @endif
                            @if(auth()->user()->hasPermission('update-inventory-project'))
                                value += `<a href="` + update_url + `" title="{{trans('inventory::inventory.update_project')}}"  data-path="` + update_url + `" data-title="{{trans('inventory::inventory.update_project')}}" data-id="` + full.id + `" data-modal-load class="btn btn-outline-hover-brand btn-sm btn-circle"><i class="fas fa-pen"></i> {{trans('inventory::inventory.update')}}</a>`;
                                value += `<a class="dropdown-item" data-8x-publish-it='{"container":false, "path":"` + publish_url + `", "callback": "PublishIProjectCallback"}' href="#"> ${full.is_published ? '{{__("inventory::inventory.un_publish")}}' : '{{__("inventory::inventory.published")}}'}</a>`;
                            @endif
                            @if(auth()->user()->hasPermission('delete-inventory-project'))
                                value += `<a class="dropdown-item" data-8x-delete-it='{"container":false, "path":"` + delete_url + `", "callback": "DeleteIProjectCallback"}' href="#"><i class="la la-trash"></i> {{__('inventory::inventory.delete_project')}}</a>`;
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
        var projects_table = init_BITable(globalQueryURL);

        // Search datatable
        $('#m_search').on('click', function(e) {
            e.preventDefault();
            var query = $('#search_projects_form').serialize();
            var table = $('#projects_table').DataTable();
            table.ajax.url("{{ route('inventory.projects.index')}}" + '?' + query).load();
        });

        // Export datatable
        $('#m_export').on('click', function(e) {
            $("#search_projects_form").submit();
        });

        // Reset search form
        $('#m_reset').on('click', function(e) {
            e.preventDefault();
            $(this).closest('form').trigger("reset");
            var table = $('#projects_table').DataTable();
            table.ajax.url("{{ route('inventory.projects.index')}}").load();
        });

    });

    function moreDetails(full) {
        var system_id = "{{trans('inventory::inventory.system_id')}}<b>'" + full.id + "'</b><br>";
        return system_id;
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
                message: "{{trans('main.please_wait')}}"
            });
        }

        if (!Array.isArray(country_ids)) {
            country_ids = [country_ids];
        }

        for (var i = 0; i < country_ids.length; i++) {
            if (country_ids[i]) {
                $.ajax({
                    url: "{{route('locations.getCountryRegions')}}",
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
                                text: "{{__('inventory::inventory.select_region')}}"
                            }));
                            $.each(response.data, function(i, region) {
                                $('#region_id').append($('<option>', {
                                    value: region.id,
                                    text: region.name
                                }));
                                console.log(1)
                            });
                            if (selected_region_id) {
                                $('#region_id').selectpicker('val', selected_region_id);
                            }
                            $("#region_id").selectpicker("refresh");
                        } else {
                            showNotification(response.message, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
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
                                showNotification(xhr.responseJSON.error, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
                            } else {
                                setTimeout(function() {
                                    window.scrollTo({
                                        top: 0,
                                        behavior: 'smooth'
                                    });
                                    showMsg(form, 'danger', statusText, true);
                                }, 500);
                                showNotification(statusText, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
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
                                        showMsg(form, 'danger', error.message, remove_previous_alerts);
                                    }, 500);
                                    showNotification(error.message, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
                                });
                            } else {
                                setTimeout(function() {
                                    window.scrollTo({
                                        top: 0,
                                        behavior: 'smooth'
                                    });
                                    showMsg(form, 'danger', statusText, true);
                                }, 500);
                                showNotification(statusText, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
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
                                showNotification(xhr.responseJSON.error, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
                            } else {
                                setTimeout(function() {
                                    window.scrollTo({
                                        top: 0,
                                        behavior: 'smooth'
                                    });
                                    showMsg(form, 'danger', statusText, true);
                                }, 500);
                                showNotification(statusText, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
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
                message: "{{trans('main.please_wait')}}"
            });
        }

        if (!Array.isArray(region_ids)) {
            region_ids = [region_ids];
        }

        for (var i = 0; i < region_ids.length; i++) {
            if (region_ids[i]) {
                $.ajax({
                    url: "{{route('locations.getRegionCities')}}",
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
                                text: "{{__('inventory::inventory.select_city')}}"
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
                            showNotification(response.message, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
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
                                showNotification(xhr.responseJSON.error, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
                            } else {
                                setTimeout(function() {
                                    window.scrollTo({
                                        top: 0,
                                        behavior: 'smooth'
                                    });
                                    showMsg(form, 'danger', statusText, true);
                                }, 500);
                                showNotification(statusText, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
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
                                        showMsg(form, 'danger', error.message, remove_previous_alerts);
                                    }, 500);
                                    showNotification(error.message, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
                                });
                            } else {
                                setTimeout(function() {
                                    window.scrollTo({
                                        top: 0,
                                        behavior: 'smooth'
                                    });
                                    showMsg(form, 'danger', statusText, true);
                                }, 500);
                                showNotification(statusText, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
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
                                showNotification(xhr.responseJSON.error, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
                            } else {
                                setTimeout(function() {
                                    window.scrollTo({
                                        top: 0,
                                        behavior: 'smooth'
                                    });
                                    showMsg(form, 'danger', statusText, true);
                                }, 500);
                                showNotification(statusText, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
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
            message: "{{trans('main.please_wait')}}"
        });

        $.ajax({
            url: "{{route('locations.getCityAreas')}}",
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
                        text: "{{__('inventory::inventory.select_area')}}"
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
                    showNotification(response.message, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
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
                        showNotification(xhr.responseJSON.error, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
                    } else {
                        setTimeout(function() {
                            window.scrollTo({
                                top: 0,
                                behavior: 'smooth'
                            });
                            showMsg(form, 'danger', statusText, true);
                        }, 500);
                        showNotification(statusText, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
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
                                showMsg(form, 'danger', error.message, remove_previous_alerts);
                            }, 500);
                            showNotification(error.message, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
                        });
                    } else {
                        setTimeout(function() {
                            window.scrollTo({
                                top: 0,
                                behavior: 'smooth'
                            });
                            showMsg(form, 'danger', statusText, true);
                        }, 500);
                        showNotification(statusText, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
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
                        showNotification(xhr.responseJSON.error, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
                    } else {
                        setTimeout(function() {
                            window.scrollTo({
                                top: 0,
                                behavior: 'smooth'
                            });
                            showMsg(form, 'danger', statusText, true);
                        }, 500);
                        showNotification(statusText, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
                    }
                }
            }
        });
    }
</script>

<script>
    function DeleteIProjectCallback() {
        var projects_table = $('#projects_table').DataTable();
        projects_table.ajax.reload(null, false);
    }

    function PublishIProjectCallback() {
        var projects_table = $('#projects_table').DataTable();
        projects_table.ajax.reload(null, false);
    }
</script>

<script>
    var elt = $('#developer_ids');

    var developers = new Bloodhound({
          datumTokenizer: Bloodhound.tokenizers.obj.whitespace('id'),
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          remote: {
                url: '{!!route("inventory.developers.tagsinput")!!}' + '?needle=%QUERY%',
                wildcard: '%QUERY%',                
          }
    });
    developers.initialize();

    $('#developer_ids').tagsinput({
          itemValue : 'id',
          itemText  : 'name',
          maxChars: 100,
          // maxTags: 1,
          trimValue: true,
          allowDuplicates : false,   
          freeInput: false,
          focusClass: 'form-control',
          tagClass: function(item) {
              if(item.display)
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
                    name: 'developer_ids',
                    itemValue: 'id',
                    displayKey: 'name',
                    source: developers.ttAdapter(),
                    templates: {
                        empty: [
                            '<ul class="list-group"><li class="list-group-item">{{trans("inventory::inventory.nothing_found")}}.</li></ul>'
                        ],
                        header: [
                            '<ul class="list-group">'
                        ],
                        suggestion: function (data) {
                            return '<li class="list-group-item">' + data.name + '</li>'
                        }
                    }
                }
            ]
    });
</script>