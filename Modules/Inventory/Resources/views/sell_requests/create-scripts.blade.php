<script>
    function getPurposePurposeTypes(i_purpose_id, div_id = null)
    {
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
            $('#'+div_id).empty();
            $("#"+div_id).selectpicker("refresh");
            return;
        }

        $('#'+div_id).empty();
        $("#"+div_id).selectpicker("refresh");

        // BlockUI
        KTApp.blockPage({overlayColor:"#000000",type:"loader",state:"success",message:"{{trans('main.please_wait')}}"});

        $.ajax({
            url: "{{route('inventory.purpose_types.GetIPurposePurposeTypes')}}",
            type: "GET",
            data: {i_purpose_id: i_purpose_id},
            success: function(response) {
                // UnblockUI
                KTApp.unblockPage();

                // Show notification
                if (response.status) {
                    // Insert empty purpose type first
                    $('#'+div_id).append($('<option>', {
                        value: "",
                        text: "{{__('inventory::inventory.select_purpose_type')}}"
                    }));
                    $.each(response.data, function(i, purpose_type) {
                        $('#'+div_id).append($('<option>', {
                            value: purpose_type.id,
                            text: purpose_type.purpose_type
                        }));
                    });
                    $('#'+div_id).selectpicker("refresh");
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
                            window.scrollTo({ top: 0, behavior: 'smooth' });
                            showMsg(form, 'danger', xhr.responseJSON.error, true);
                        }, 500);
                        showNotification(xhr.responseJSON.error, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
                    } else {
                        setTimeout(function() {
                            window.scrollTo({ top: 0, behavior: 'smooth' });
                            showMsg(form, 'danger', statusText, true);
                        }, 500);
                        showNotification(statusText, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
                    }
                } else if (xhr.status == 422) {
                    // HTTP_UNPROCESSABLE_ENTITY
                    if (xhr.responseJSON.errors) {
                        window.scrollTo({ top: 0, behavior: 'smooth' });
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
                            window.scrollTo({ top: 0, behavior: 'smooth' });
                            showMsg(form, 'danger', statusText, true);
                        }, 500);
                        showNotification(statusText, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
                    }
                } else if (xhr.status == 500) {
                    // Internal Server Error
                    var error = xhr.responseJSON.message;
                    if (xhr.responseJSON.error) {                       
                        setTimeout(function() {
                            window.scrollTo({ top: 0, behavior: 'smooth' });
                            showMsg(form, 'danger', xhr.responseJSON.error, true);
                        }, 500);
                        showNotification(xhr.responseJSON.error, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
                    } else {
                        setTimeout(function() {
                            window.scrollTo({ top: 0, behavior: 'smooth' });
                            showMsg(form, 'danger', statusText, true);
                        }, 500);
                        showNotification(statusText, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
                    }
                }
            }
        });
    }
</script>