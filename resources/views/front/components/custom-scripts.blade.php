<!-- Contact Form -->

<script>

    let date = new Date();
    $('.copyrights .date').text(date.getFullYear());
</script>
<script>
    function recaptchaCallback() {
        $('.myField').val('noempty');
    }
    $('.contact-from').on('click', function(e) {
        e.preventDefault();
        var form = $(this).closest('form');

        /* Parsley validate front-end */
        if (!form.parsley().isValid()) {
            // Display notification
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


        // Request parameters
        var url = "{{ route('contact_us.contact_us.store') }}";

        var best_time_to_call_from = $(this).closest('form').find("input[name='best_time_to_call_from']").val();
        var date_time = best_time_to_call_from ;
        var data = {
            '_token': $(this).closest('form').find("input[name='_token']").val(),
            'full_name': $(this).closest('form').find("input[name='full_name']").val(),
            'email': $(this).closest('form').find("input[name='email']").val(),
            'phone': $(this).closest('form').find("input[name='phone']").val(),
            'best_time_to_call_from': date_time,
            'message': $(this).closest('form').find("textarea[name='message']").val(),
            'link': $(this).closest('form').find("input[name='link']").val(),
            'type': $(this).closest('form').find("input[name='type']").val(),
            'position': $(this).closest('form').find("input[name='position']").val(),
            'city_id': $(this).closest('form').find("input[name='city_id']").val(),
            'model_name': $(this).closest('form').find("input[name='model_name']").val(),
        };
        var headers = {
            'content-type': 'appliction/json'
        };

        // Block UI
        $.blockUI({
            overlayColor: "#000000",
            type: "loader",
            state: "success",
            message: "<img src='{{ URL::asset('front/images/loader.gif') }}'/>"
        });
        console.log(data);
        // Send the request
        $.post(url, data, headers).done(function(response) {

            // Unblock UI     
            $.unblockUI();

            // Notification message
            if (response.message) {
                // Empty notificaion messages              
                $('.messages').empty();

                // Notification type
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
                console.log(response.data);
                if (response.data.redirect_to) {
                    // window.location.href = response.data.redirect_to
                }
            }
        }).fail(function(xhr, error_text, statusText) {
            // Unblock UI            
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

<!-- Add To Favorites -->
<script>
    $('.favorites-add').on('click', function() {
        // Request parameters
        var url = "{{ route('favorites.store') }}";
        var data = {
            "_token": "{{ csrf_token() }}",
            'unit_id': $(this).attr('unit-id')
        };
        var headers = {
            'content-type': 'appliction/json'
        };

        // Send the request
        $.post(url, data, headers).done(function(response) {
            // Notification message
            if (response.message) {

                // Notification type
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
            }
        }).fail(function(xhr, error_text, statusText) {
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

<!-- Rating -->
{{-- <script>
    $('.rating-input').on('click', function(e) {
        // Request parameters
        var url = "{{route('ratings.store')}}";
        var data = {
            "_token": "{{ csrf_token() }}",
            'rateable_type': $(this).closest('div.rating').find("input[name='rateable_type']").val(),
            'rateable_id': $(this).closest('div.rating').find("input[name='rateable_id']").val(),
            'rate': $(this).val()
        };
        var headers = {
            'content-type': 'appliction/json'
        };

        // Send the request
        $.post(url, data, headers).done(function(response) {
            // Notification message
            if (response.message) {
                // Notification type
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
            }
        }).fail(function(xhr, error_text, statusText) {
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
</script> --}}

<!-- Get Purpose Purpose Types -->
<script>
    function getPurposePurposeTypes(i_purpose_id, div_id = null, parent_div = null) {
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
            // $('#' + div_id).empty();
            // $("#" + div_id).selectpicker("refresh");
            return;
        }

        // $('#' + div_id).empty();
        // $("#" + div_id).selectpicker("refresh");
        // Block UI
        $.blockUI({
            overlayColor: "#000000",
            type: "loader",
            state: "success",
            message: "<img src='{{ URL::asset('front/images/loader.gif') }}'/>"
        });

        $.ajax({
            url: "{{ route('inventory.purpose_types.GetIPurposePurposeTypes') }}",
            type: "GET",
            data: {
                i_purpose_id: i_purpose_id
            },
            success: function(response) {
                // Unblock UI     
                $.unblockUI();
                console.log(response);
                if (response.status) {
                    // Insert empty purpose type first

                    types = [];
                    console.log(types);
                    // console.log(ddSelectPurposeType.length);
                    $.each(response.data, function(i, purpose_type) {
                        types[purpose_type.id] = {
                            value: purpose_type.purpose_type,
                            group: "#",
                            selected: false,
                            disabled: false,
                            description: purpose_type.value
                        };
                    });
                    if (ddSelectPurposeType.length > 1) {
                        $.each(ddSelectPurposeType, function(index, typeSelect) {
                            typeSelect.reload();
                            typeSelect.options.add(types);
                        })
                    } else if (ddSelectPurposeType.length == 1) {
                        ddSelectPurposeType.reload();
                        ddSelectPurposeType.options.add(types);
                    } else {
                        ddSelectPurposeType.options.add(types);
                    }
                }
            },
            error: function(xhr, error_text, statusText) {
                // Unblock UI     
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
            }
        });
    }

    function getPurposePurposeTypesRequest(i_purpose_id, div_id = null) {
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
            // $('#' + div_id).empty();
            // $("#" + div_id).selectpicker("refresh");
            return;
        }

        // $('#' + div_id).empty();
        // $("#" + div_id).selectpicker("refresh");
        // Block UI
        $.blockUI({
            overlayColor: "#000000",
            type: "loader",
            state: "success",
            message: "<img src='{{ URL::asset('front/images/loader.gif') }}'/>"
        });

        $.ajax({
            url: "{{ route('inventory.purpose_types.GetIPurposePurposeTypes') }}",
            type: "GET",
            data: {
                i_purpose_id: i_purpose_id
            },
            success: function(response) {
                // Unblock UI     
                $.unblockUI();

                if (response.status) {
                    // Insert empty purpose type first

                    types = [];
                    $('#i_purpose_type_id_sell').empty();
                    $.each(response.data, function(i, purpose_type) {
                        $('#i_purpose_type_id_sell').append("<option value=\"" + purpose_type.id + "\">" + purpose_type.purpose_type + "</option>");
                    });
                    $('#i_purpose_type_id_sell').multipleSelect( 'refresh' );
                }
            },
            error: function(xhr, error_text, statusText) {
                // Unblock UI     
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
            }
        });
    }
</script>
<script>
    function contactAgent() {
        var form = $(`.message-owner-form`);

        $.blockUI({
            overlayColor: "#000000",
            type: "loader",
            state: "success",
            message: "<img src='{{ URL::asset('front/images/loader.gif') }}'/>"
        });
        /* Parsley validate front-end */
        if (!form.parsley().isValid()) {
            $.unblockUI();
            // Display notificaction
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

        // Request parameters
        var url = "{{ route('front.message_unit_owner') }}";
        var data = $(`.message-owner-form`).serialize();
        var headers = {
            'Content-Type': 'appliction/json'
        };

        // Send the request
        $.post(url, data, headers).done(function(response) {

            $.unblockUI();
            // Notification message
            if (response.message) {
                // Notification type
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
            }
        }).fail(function(xhr, error_text, statusText) {

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
    }
</script>
<script>
    function getRegionCities(region_id, selected_city_id = null) {
        $('#city_id').empty();
        // BlockUI
        $.blockUI({
            overlayColor: "#000000",
            type: "loader",
            state: 'primary',
            message: "<img src='{{ URL::asset('front/img/loader.gif') }}'/>"
        });

        $.ajax({
            url: "{{ route('locations.getRegionCities') }}",
            type: "GET",
            data: {
                region_id: region_id
            },
            success: function(response) {
                // UnblockUI
                $.unblockUI();
                // Show notification
                if (response.status) {
                    // Insert empty city first
                    cities = [];
                    console.log(selected_city_id);
                    $.each(response.data, function(i, city) {
                        console.log(city.id);
                        if (selected_city_id) {

                            if ($.inArray(`${city.id}`, selected_city_id) != -1) {
                                console.log('here');
                                cities[city.id] = {
                                    value: city.name,
                                    group: "#",
                                    selected: true,
                                    disabled: false,
                                    description: city.value
                                };
                            } else {
                                cities[city.id] = {
                                    value: city.name,
                                    group: "#",
                                    selected: false,
                                    disabled: false,
                                    description: city.value
                                };
                            }
                        } else {
                            cities[city.id] = {
                                value: city.name,
                                group: "#",
                                selected: false,
                                disabled: false,
                                description: city.value
                            };
                        }

                    });
                    // ddSelect2.options.add(cities);
                    if (ddSelect2.length > 1) {
                        $.each(ddSelect2, function(index, ddSl) {
                            ddSl.reload();
                            ddSl.options.add(cities);
                        })
                    } else if (ddSelect2.length == 1) {
                        ddSelect2.reload();
                        ddSelect2.options.add(cities);
                    } else {
                        ddSelect2.options.add(cities);
                    }

                } else {
                    showNotification(response.message, "{{ trans('main.error') }}", 'la la-warning',
                        null,
                        'danger', true, true, true);
                }
            },
            error: function(xhr, error_text, statusText) {
                // UnblockUI
                $.unblockUI();;

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
    $(document).on('click', '.contact-dev-btn', function() {
        $('.message-owner-form .project_id_input').val($(this).attr('data-id'));
    });
</script>
<script>
    $('.submit-sell-request').on('click', function() {
        var form = $('#sell-from');
        $.blockUI({
            overlayColor: "#000000",
            type: "loader",
            state: "success",
            message: "<img src='{{ URL::asset('front/images/loader.gif') }}'/>"
        });
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

        // Request parameters
        var url = "{{ route('front.home.sell_request.store') }}";
        var formData = new FormData(document.getElementById("sell-from"));

        // Send Sell Request 
        $.ajax({
            url: url,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
        }).done(function(response) {
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
<script>
    function setOfferingType(id, divId) {
        $(`#${divId}`).find('.offering_types').val(id);
    }

    function setPurposeValue(value) {
        $('#filter-form').find('.purpose_select').hide();
        $('#filter-form').find('.purpose_ids').val(value);

        getPurposePurposeTypes([value]);
    }
</script>
