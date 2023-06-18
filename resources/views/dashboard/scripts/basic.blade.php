<!-- Alert Sound -->
<script>
    function runNotificationSound(){
        var audio = new Audio('{{URL::asset('assets/sounds/definite.mp3')}}');
        audio.play();
    }
</script>

<!-- Toastr -->
<script>
    function toast(message, type = 'success') {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "positionClass": "toast-top-right",
            "showDuration": "1000",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            iconClasses: {
                error: 'alert-error',
                info: 'alert-info',
                success: 'alert-success',
                warning: 'alert-warning'
            }
        }
        if (type == 'success') {
            toastr.options.onShown = runNotificationSound();
            toastr.success(message, {timeOut: 5000});
        } else if (type == 'error') {
            toastr.options.onShown = runNotificationSound();
            toastr.error(message, {timeOut: 5000});
        }
    }
</script>

<!-- Notifications -->
<script>
    function showNotification(message, title, icon, url, type, allow_dismiss, newest_on_top, pause_on_hover) {
        var content = {};

        content.message = message;
        if (title) {
            content.title = title;
        }
        if (icon) {
            content.icon = 'icon ' + icon;
        }
        if (url) {
            content.url = url;
            content.target = '_blank';
        }

        var notify = $.notify(content, { 
            type: type,
            allow_dismiss: allow_dismiss,
            newest_on_top: newest_on_top,
            mouse_over:  pause_on_hover
        });
    }
</script>
<!-- Messages Division -->
<script>
    function showMsg(form, type, msg, remove_previous_alerts = null) {
        if (type == 'success') {
            var alert = $('\
                <div class="row justify-content-md-center alert-row" style="margin-top:15px;">\
                    <div class="col-lg-10 m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-success alert-dismissible fade show" role="alert">\
                        <div class="m-alert__icon">\
                            <i class="la la-warning"></i>\
                            <span></span>\
                        </div>\
                        <div class="m-alert__text">\
                            <strong>{{trans('main.well_done')}}!</strong> ' + msg + '\
                        </div>\
                        <div class="m-alert__close">\
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>\
                        </div>\
                    </div>\
                </div>\
            ');
        } else if (type == 'danger') {
            var alert = $('\
                <div class="row justify-content-md-center alert-row" style="margin-top:15px;">\
                    <div class="col-lg-10 m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">\
                        <div class="m-alert__icon">\
                            <i class="la la-warning"></i>\
                            <span></span>\
                        </div>\
                        <div class="m-alert__text">\
                            <strong>{{trans('main.error')}}!</strong> ' + msg + '\
                        </div>\
                        <div class="m-alert__close">\
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
                            </button>\
                        </div>\
                    </div>\
                </div>\
            ');
        }
        if (remove_previous_alerts !== false) {
            form.find('.alert-row').remove();
        }

        alert.prependTo(form);
        // mUtil.animateClass(alert[0], 'fadeIn animated');
    }
</script>

{{--
<!-- AJAX requests -->
<script>

    $('form[data-async]').on('submit', function(e) {
        // Prevent submitting
        e.preventDefault();

        // Get the form
        var form = $(this).closest('form');

        // Parsley validate front-end
        if (!form.parsley().isValid()) {
            form.find( '[data-parsley-type]' ).each( function( i , v ){
                $(this).parsley().validate({
                    focusInvalid: false,
                    invalidHandler: function() {
                        $(this).find(":input.error:first").focus();
                    }
                });
                showNotification("{{trans('main.oh_snap_change_a_few_thing_up_and_try_submitting_again')}}", "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
                showMsg(form, 'danger', "{{trans('main.oh_snap_change_a_few_thing_up_and_try_submitting_again')}}", true);
                return;
            });
            form.find( '[data-parsley-pattern]' ).each(function( i, v ) {
                $(this).parsley().validate({
                    focusInvalid: false,
                    invalidHandler: function() {
                        $(this).find(":input.error:first").focus();
                    }
                });
                showNotification("{{trans('main.oh_snap_change_a_few_thing_up_and_try_submitting_again')}}", "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
                showMsg(form, 'danger', "{{trans('main.oh_snap_change_a_few_thing_up_and_try_submitting_again')}}", true);
                return;
            });
            form.parsley().validate({
                focusInvalid: false,
                invalidHandler: function() {
                    $(this).find(":input.error:first").focus();
                }
            });
            showNotification("{{trans('main.oh_snap_change_a_few_thing_up_and_try_submitting_again')}}", "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
            showMsg(form, 'danger', "{{trans('main.oh_snap_change_a_few_thing_up_and_try_submitting_again')}}", true);
            return;
        }

        // BlockUI
        KTApp.blockPage({overlayColor:"#000000",type:"loader",state:"success",message:"{{trans('main.please_wait')}}"});

        // Get form data
        var formData = new FormData($(this).closest('form')[0]);

        // Callback function
        var callback = $(this).attr('data-callback');

        // Appended data
        var appended_data = $(this).attr('data-append');
        // If appended data is a function
        if (typeof window[appended_data] == "function") {
            // Call the function to get appended data object
            var appended_data = window[appended_data].call();
            if (appended_data instanceof Object) {
                // Appending the appended data to the form data
                for (key in appended_data) {
                    // If appended data value is an array, append it to form data as an array
                    if (Array.isArray(appended_data[key])) {
                        for (var i = 0; i < appended_data[key].length; i++) {
                            formData.append(key, appended_data[key][i]);
                        }
                    } else {
                        formData.append(key, appended_data[key]);
                    }
                }
            }
        }

        // Submit AJAX request
        $.ajax({
            url: $(this).attr('action'),
            type: "POST",
            processData: false,
            contentType: false,
            data: formData,
            success: function(response) {
                // Callback
                if(typeof window[callback] == "function")
                    window[callback].call();

                // UnblockUI
                KTApp.unblockPage();

                // Show notification
                if (response.status) {
                    showNotification(response.message, "{{trans('main.well_done')}}", 'la la-warning', null, 'success', true, true, true);
                } else {
                    showNotification(response.message, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
                }

                // Show message
                setTimeout(function() {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                    showMsg(form, 'success', response.message, true);
                }, 500);

                if (response.data && response.data.redirect_url) {
                    window.location.replace(response.data.redirect_url);
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
    });

</script>
--}}