<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#374afb",
                "light": "#ffffff",
                "dark": "#282a3c",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
            }
        }
    };
    //history.replaceState(null, "@yield('title') | {{env('APP_NAME')}}", "{{Request::url()}}");
</script>
<!-- end::Global Config -->

<!-- config && lang -->
<script>
    var config = {
        //
    };
    var lang = {
        please_specify_at_least_4_directions: "{{trans('map.please_specify_at_least_4_directions')}}",
        no_results_found: "{{trans('main.no_results_found')}}",
        geocode_failed_due_to: "{{trans('map.geocode_failed_due_to')}}",
        autocomplete_returned_place_contains_no_geometry: "{{trans('map.autocomplete_returned_place_contains_no_geometry')}}",
    };
</script>
<!-- end:: config && lang -->
<!--begin:: Global Mandatory Vendors -->
<script src="{{asset('8x/assets/vendors/general/jquery/dist/jquery.js')}}" type="text/javascript"></script>
<!-- Socket IO -->
<script src="{{URL::asset('assets/packages/socket/socket.io.js')}}"></script>
<script>
    // Connect to socket
    var socket = io.connect('http://{{request()->getHost()}}:3003?id={{Auth::user()->id}}&channel={{Auth::user()->group_id}}&host={{request()->getHost()}}', {transports: ['websocket']});
    {{--
    var socket = io.connect('https://{{request()->getHost()}}:2053?id={{Auth::user()->id}}&channel={{Auth::user()->group_id}}&host={{request()->getHost()}}', {transports: ['websocket'], rejectUnauthorized: false, secure: true});
    --}}
</script>
<script src="{{asset('8x/assets/vendors/general/popper.js/dist/umd/popper.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/bootstrap/dist/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/js-cookie/src/js.cookie.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/moment/min/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/moment/min/moment-timezone.min.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/tooltip.js/dist/umd/tooltip.min.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/perfect-scrollbar/dist/perfect-scrollbar.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/sticky-js/dist/sticky.min.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/wnumb/wNumb.js')}}" type="text/javascript"></script>
<!--end:: Global Mandatory Vendors -->

<!--begin:: Global Optional Vendors -->
<script src="{{asset('8x/assets/vendors/general/jquery-form/dist/jquery.form.min.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/block-ui/jquery.blockUI.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/custom/components/vendors/bootstrap-datepicker/init.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/custom/components/vendors/bootstrap-timepicker/init.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/bootstrap-daterangepicker/daterangepicker.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/bootstrap-maxlength/src/bootstrap-maxlength.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/custom/vendors/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/bootstrap-select/dist/js/bootstrap-select.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/bootstrap-switch/dist/js/bootstrap-switch.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/custom/components/vendors/bootstrap-switch/init.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/select2/dist/js/select2.full.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/ion-rangeslider/js/ion.rangeSlider.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/typeahead.js/dist/typeahead.bundle.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/handlebars/dist/handlebars.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/inputmask/dist/jquery.inputmask.bundle.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/inputmask/dist/inputmask/inputmask.date.extensions.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/inputmask/dist/inputmask/inputmask.numeric.extensions.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/nouislider/distribute/nouislider.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/owl.carousel/dist/owl.carousel.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/autosize/dist/autosize.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/clipboard/dist/clipboard.min.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/dropzone/dist/dropzone.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/markdown/lib/markdown.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/bootstrap-markdown/js/bootstrap-markdown.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/custom/components/vendors/bootstrap-markdown/init.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/bootstrap-notify/bootstrap-notify.min.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/custom/components/vendors/bootstrap-notify/init.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/jquery-validation/dist/jquery.validate.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/jquery-validation/dist/additional-methods.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/custom/components/vendors/jquery-validation/init.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/toastr/build/toastr.min.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/raphael/raphael.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/morris.js/morris-06.min.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/chart.js/dist/Chart.bundle.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/custom/vendors/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/custom/vendors/jquery-idletimer/idle-timer.min.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/waypoints/lib/jquery.waypoints.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/counterup/jquery.counterup.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/es6-promise-polyfill/promise.min.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/sweetalert2/dist/sweetalert2.min.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/custom/components/vendors/sweetalert2/init.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/jquery.repeater/src/lib.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/jquery.repeater/src/jquery.input.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/jquery.repeater/src/repeater.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/dompurify/dist/purify.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/vendors/general/jquery.8x-editable/js/jquery.8x-editable.js')}}"></script>
<!--end:: Global Optional Vendors -->

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="{{asset('8x/assets/demo/demo2/base/scripts.bundle.js')}}" type="text/javascript"></script>
<!--end::Global Theme Bundle -->

<!--begin::Page Vendors(used by this page) -->
<script src="{{asset('8x/assets/vendors/custom/fullcalendar/fullcalendar.bundle.js')}}" type="text/javascript"></script>
{{-- <script src="//maps.google.com/maps/api/js?key={{ env('MAP_KEY') }}" type="text/javascript"></script> --}}
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_KEY') }}&libraries=places&language={{App::getLocale()}}"></script>
{{-- <script src="{{asset('8x/assets/vendors/custom/gmaps/gmaps.js')}}" type="text/javascript"></script> --}}
<!--end::Page Vendors -->

<script src="{{asset('8x/assets/vendors/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
<!--begin::8X Scripts(used by all pages) -->
<script src="{{URL::asset('8x/assets/js/js.cookie.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('8x/assets/js/parsley.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('8x/assets/js/jquery.jscroll.min.js')}}"></script>
<script src="{{URL::asset('8x/assets/js/jquery.appear.js')}}"></script>
<script src="{{asset('8x/assets/js/map.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/js/jstree.min.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/js/animatedModal.min.js')}}" type="text/javascript"></script>

<script src="{{asset('8x/assets/js/g8x.js?ver='.env('FILES_VER'))}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/js/8worx.js?ver='.env('FILES_VER'))}}" type="text/javascript"></script>
<!--end::8X Scripts -->

<!--begin::Page Scripts(used by this page) -->
<script src="{{asset('8x/assets/app/custom/general/dashboard.js')}}" type="text/javascript"></script>
<script src="{{asset('8x/assets/app/custom/general/components/utils/session-timeout.js')}}" type="text/javascript"></script>
<!--end::Page Scripts -->

<!--begin::Global App Bundle(used by all pages) -->
<script src="{{asset('8x/assets/app/bundle/app.bundle.js')}}" type="text/javascript"></script>
<!--end::Global App Bundle -->

<script src="{{URL::asset('8x/assets/js/bootstrap-tagsinput.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('8x/assets/packages/bootstrapValidator/js/bootstrapValidator.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('8x/assets/js/upload_button.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/3.2.0/js/fontawesome-iconpicker.min.js"></script>
<!-- TOKEN -->
<script>
document.addEventListener('DOMContentLoaded', function(){
    $(document).ready(function() {
        window.Laravel = <?php echo json_encode([
            'user' => Auth::user(),
            'csrfToken' => csrf_token(),
            'vapidPublicKey' => config('webpush.vapid.public_key'),
            'pusher' => [
                'key' => config('broadcasting.connections.pusher.key'),
                'cluster' => config('broadcasting.connections.pusher.options.cluster'),
            ],
            'baseUrl' => url('/'),
            'host' => request()->getHttpHost()
        ]); ?>;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
}, false);
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
</script>
<!-- TOKEN -->
{{--
<script type="text/javascript">
    @if (Auth::user())
        socket.on('user_connected', function(data) {
            data = JSON.parse(data);
            showNotification(data.username+' is now online', "{{trans('main.connected')}}", 'la la-warning', null, 'success', true, true, true);
        });
        socket.on('user_disconnected', function(data) {
            data = JSON.parse(data);
            showNotification(data.username+' disconnected', "{{trans('main.disconnected')}}", 'la la-warning', null, 'danger', true, true, true);
        });
    @endif
</script>
--}}

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<!-- Globals -->
@include('8x.inc.global_variables')
@include('8x.inc.global_translations')
@include('8x.inc.global_routes')
@include('8x.inc.delete-script')

<!-- Module Socket Events (Solves PJAX doesn't flush events issue) -->
@include('8x.inc.load_module_socket_events')
<script>
    function deleteAttachment(id) {
        KTApp.blockPage({
            overlayColor: "#000000",
            type: "loader",
            state: "success",
            message: "{{trans('main.please_wait')}}"
        });
        $.ajax({
            url: "{{route('delete.media')}}",
            type: "POST",
            data: {
                id: id
            },
            success: function(response) {
                // UnblockUI
                KTApp.unblockPage();

                // Show notification
                if (response.status) {
                    // Remove attachment div
                    $('#card-' + id).remove();
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
    function deleteAttachmentables(id) {
        KTApp.blockPage({
            overlayColor: "#000000",
            type: "loader",
            state: "success",
            message: "{{trans('main.please_wait')}}"
        });
        $.ajax({
            url: "{{route('delete.attachmentables')}}",
            type: "POST",
            data: {
                id: id
            },
            success: function(response) {
                // UnblockUI
                KTApp.unblockPage();

                // Show notification
                if (response.status) {
                    // Remove attachment div
                    $('#card-' + id).remove();
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