@extends('dashboard.layouts.basic')


@section('content')
    <!--begin::Form-->
    <form action="{{ route('inventory.developers.store') }}" method="POST" id="create_i_developer_form"
        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async
        data-callback="createIDeveloperCallback" data-parsley-validate>
        @csrf
        <div class="m-portlet__body">
            <div class="form-group row">
                <div class="fancy-checkbox">
                    <input name="in_discover_by" id="in_discover_by" type="checkbox">
                    <label for="in_discover_by">{{ __('main.who_do_we_work_with') }}</label>
                </div>
            </div>
            <div class="form-group row">

                <div class="col-6">
                    <label for="developer_name">{{ __('inventory::inventory.developer_name') }}</label>
                    <input name="developer_name" id="developer_name" type="text" class="form-control"
                        placeholder="{{ __('inventory::inventory.developer_name') }}"
                        data-parsley-trigger="change focusout">
                </div>
                <div class="col-6">
                    <label for="developer_email">{{ __('inventory::inventory.developer_email') }}</label>
                    <input name="developer_email" id="developer_email" type="text" class="form-control"
                        placeholder="{{ __('inventory::inventory.developer_email') }}"
                        data-parsley-trigger="change focusout">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12 repeater">
                    <div data-repeater-list="translations">
                        <div data-repeater-item class="row">
                            <div class="col-6">
                                {{-- <label for="language_id">{{__('inventory::inventory.language')}}</label> --}}
                                <select class="form-control" id="language_id" name="language_id" required
                                    data-parsley-required
                                    data-parsley-required-message="{{ __('inventory::inventory.please_select_the_language') }}"
                                    data-parsley-trigger="change focusout">
                                    <option value="" selected disabled>{{ __('inventory::inventory.language') }}</option>
                                    @foreach ($languages as $language)
                                        <option value="{{ $language->id }}"
                                            @if ($language->id == 1) selected @endif>{{ $language->code }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-6">
                                {{-- <label for="developer">{{__('inventory::inventory.title')}}</label> --}}
                                <input name="developer" id="developer" type="text" class="form-control"
                                    placeholder="{{ __('inventory::inventory.please_enter_the_developer') }}" required
                                    data-parsley-required
                                    data-parsley-required-message="{{ __('inventory::inventory.please_enter_the_developer') }}"
                                    data-parsley-trigger="change focusout" data-parsley-maxlength="150"
                                    data-parsley-maxlength-message="{{ __('inventory::inventory.title_max_is_150_characters_long') }}">
                            </div>
                            <div class="col-12">
                                <label for="description">{{ __('inventory::inventory.description') }} </label>
                                <textarea rows="6" name="description" id="description-0" class="form-control description"
                                    placeholder="{{ __('inventory::inventory.enter_description') }}" required
                                    data-parsley-required
                                    data-parsley-required-message="{{ __('inventory::inventory.enter_description') }}"
                                    data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295"
                                    data-parsley-maxlength-message="{{ __('inventory::inventory.description_max_is_4294967295_characters_long') }}"></textarea>
                            </div>
                            <div class="col-6 mt-2">
                                <label for="meta_title">{{ __('inventory::inventory.meta_title') }} <small
                                        class="text-muted"> -
                                        {{ __('inventory::inventory.optional') }}</small></label>
                                <input name="meta_title" id="meta_title" type="text" class="form-control"
                                    placeholder="{{ __('inventory::inventory.meta_title') }}"
                                    data-parsley-trigger="change focusout" data-parsley-maxlength="150"
                                    data-parsley-maxlength-message="{{ __('inventory::inventory.title_max_is_150_characters_long') }}">
                            </div>
                            <div class="col-lg-6 mt-2">
                                <label for="meta_description">{{ __('inventory::inventory.description') }} <small
                                        class="text-muted"> -
                                        {{ __('inventory::inventory.optional') }}</small></label>
                                <textarea rows="6" name="meta_description" id="meta_description" class="form-control"
                                    placeholder="{{ __('inventory::inventory.meta_description') }}"
                                    data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295"
                                    data-parsley-maxlength-message="{{ __('inventory::inventory.description_max_is_4294967295_characters_long') }}"></textarea>
                            </div>
                            <div class="col-md-2 col-sm-2">
                                {{-- <label class="control-label">&nbsp;</label> --}}
                                <a href="javascript:;" data-repeater-delete class="btn btn-brand data-repeater-delete">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <a href="javascript:;" data-repeater-create id="repeater_btn" class="btn">
                        <i class="fa fa-plus"></i> {{ trans('inventory::inventory.add_developer_translation') }}
                    </a>
                </div>
            </div>
            <div class="form-group row">

            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <div class="row">
                        <div class="box">
                            <label for="attachments">{{ __('inventory::inventory.attachments') }} <small
                                    class="text-muted"> - {{ __('inventory::inventory.optional') }}
                                    {{ trans('inventory::inventory.only_one_image') }}</small></label>
                            <input type="file" name="attachments" class="inputfile inputfile-5" id="file-6" />
                            <label for="file-6">
                                <figure><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                                        <path
                                            d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z" />
                                    </svg></figure> <span></span>
                            </label>
                            <label for="image"><strong>{{__('settings::settings.image_dimensions')}}::130 × 130 px</strong></label>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="col-lg-6">
                        <button type="submit"
                            class="btn btn-success btn-brand">{{ trans('inventory::inventory.create_developer') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

<!--end::Form-->
@push('scripts')
    <!-- Callback function -->
    <script>
        function createIDeveloperCallback() {
            // Reload datatable
            $('#vcxl_modal').modal('toggle');
            i_developers_table.ajax.reload(null, false);
        }
    </script>
    <script src="{{ asset('8x/assets/js/repeater.js') }}" type="text/javascript"></script>
    <script src="{{ asset('8x/assets/js/summernote-image-attributes.js') }}"></script>

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
            $('#description-' + '0').summernote({
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
                height: 150, //set editable area's height

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
        $("#country_id").selectpicker("refresh");
        $("#city_id").selectpicker("refresh");
        $("#area_id").selectpicker("refresh");
        $("#region_id").selectpicker("refresh");

        function getCountryRegions(country_id, selected_region_id = null) {
            $('#city_id').empty();
            $("#city_id").selectpicker("refresh");
            $('#area_id').empty();
            $("#area_id").selectpicker("refresh");
            $('#region_id').empty();
            $("#region_id").selectpicker("refresh");

            // BlockUI
            KTApp.blockPage({
                overlayColor: "#000000",
                type: "loader",
                state: "success",
                message: "{{ trans('main.please_wait') }}"
            });

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
                        if (selected_region_id) {
                            $('#region_id').selectpicker('val', selected_region_id);
                        }
                        $("#region_id").selectpicker("refresh");
                    } else {
                        showNotification(response.message, "{{ trans('main.error') }}", 'la la-warning',
                            null,
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

        function getRegionCities(region_id, selected_city_id = null) {
            $('#city_id').empty();
            $("#city_id").selectpicker("refresh");

            // BlockUI
            KTApp.blockPage({
                overlayColor: "#000000",
                type: "loader",
                state: "success",
                message: "{{ trans('main.please_wait') }}"
            });

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
                        if (selected_city_id) {
                            $('#city_id').selectpicker('val', selected_city_id);
                        }
                        $("#city_id").selectpicker("refresh");
                    } else {
                        showNotification(response.message, "{{ trans('main.error') }}", 'la la-warning',
                            null,
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
                        showNotification(response.message, "{{ trans('main.error') }}", 'la la-warning',
                            null,
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
@endpush
