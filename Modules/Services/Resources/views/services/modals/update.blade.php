@extends('dashboard.layouts.basic')

@section('content')
<style>
    .fade:not(.show) {
        opacity: 1
    }

    .popover {
        max-width: 361.656px !important;
    }
</style>
<!--begin::Form-->
<form action="{{route('services.update')}}" method="POST" id="update_service_form" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="updateServiceCallback" data-parsley-validate enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="id" value="{{$service->id}}" />
    <div class="m-portlet__body">

        <div class="form-group row">
            <div class="fancy-checkbox col-12 mb-2">
                <input name="is_featured" id="is_featured" type="checkbox" @if($service->is_featured == 1) checked=checked @endif>
                <label for="is_featured">{{__('services::services.is_featured')}}</label>
            </div>
            <div class="col-12 repeater">
                <div data-repeater-list="translations">
                    @foreach ($service->translations as $translation)
                    <div data-repeater-item class="row">
                        <div class="col-6">
                            {{-- <label for="language_id">{{__('services::services.language')}}</label> --}}
                            <select class="form-control" id="language_id" name="language_id" required data-parsley-required data-parsley-required-message="{{__('services::services.please_select_the_language')}}" data-parsley-trigger="change focusout">
                                <option value="" disabled>{{__('services::services.language')}}</option>
                                @foreach ($languages as $language)
                                <option value="{{$language->id}}" @if ($translation->language_id == $language->id) selected @endif>{{$language->code}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-6">
                            {{-- <label for="service">{{__('services::services.service')}}</label> --}}
                            <input name="title" id="title" type="text" class="form-control" placeholder="{{__('services::services.please_enter_the_service')}}" required data-parsley-required data-parsley-required-message="{{__('services::services.please_enter_the_service')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('services::services.service_max_is_150_characters_long')}}" value="{{$translation->title}}">
                        </div>
                        <div class="col-lg-12">
                            <label for="description">{{__('services::services.description')}}</label>
                            <textarea rows="6" name="description" id="description" class="form-control" placeholder="{{__('services::services.enter_description')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295" data-parsley-maxlength-message="{{__('services::services.description_max_is_4294967295_characters_long')}}" required data-parsley-required data-parsley-required-message="{{__('services::services.please_enter_the_service')}}">{{$translation->description}}</textarea>
                        </div>                     
                        <div class="col-md-2 col-sm-2 mt-2">
                            {{-- <label class="control-label">&nbsp;</label> --}}
                            <a href="javascript:;" data-repeater-delete class="btn btn-brand data-repeater-delete">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                    @if (!$service->translations->count())
                    <div data-repeater-item class="row">
                        <div class="col-6">
                            {{-- <label for="language_id">{{__('services::services.language')}}</label> --}}
                            <select class="form-control" id="language_id" name="language_id" required data-parsley-required data-parsley-required-message="{{__('services::services.please_select_the_language')}}" data-parsley-trigger="change focusout">
                                <option value="" selected disabled>{{__('services::services.language')}}</option>
                                @foreach ($languages as $language)
                                <option value="{{$language->id}}" @if($language->id == 1) selected @endif>{{$language->code}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            {{-- <label for="service">{{__('services::services.service')}}</label> --}}
                            <input name="service" id="service" type="text" class="form-control" placeholder="{{__('services::services.please_enter_the_service')}}" required data-parsley-required data-parsley-required-message="{{__('services::services.please_enter_the_service')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('services::services.service_max_is_150_characters_long')}}">
                        </div>
                        <div class="col-lg-12">
                            <label for="description">{{__('services::services.description')}} <small class="text-muted"> - {{__('services::services.optional')}}</small></label>
                            <textarea rows="6" name="description" id="description" class="form-control" placeholder="{{__('services::services.enter_description')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295" data-parsley-maxlength-message="{{__('services::services.description_max_is_4294967295_characters_long')}}"></textarea>
                        </div>
                        <div class="col-md-2 col-sm-2 mt-2">
                            {{-- <label class="control-label">&nbsp;</label> --}}
                            <a href="javascript:;" data-repeater-delete class="btn btn-brand data-repeater-delete">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
                <a href="javascript:;" data-repeater-create id="repeater_btn" class="btn">
                    <i class="fa fa-plus"></i> {{trans('services::services.add_service_translation')}}
                </a>
            </div>

            <div class="form-group row">
                <div class="col-lg-12 mr-auto">
                    <div class="col-6 mt-5">
                        <label for="icon">{{__('socials::social.icon')}}</label>
                        <input name="icon" id="icon" autocomplete="OFF" value="{{$service->icon}}" type="text" class="form-control icon-font" placeholder="{{__('socials::social.please_enter_the_social')}}" required data-parsley-required data-parsley-required-message="{{__('socials::social.please_enter_the_social')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('socials::social.social_max_is_150_characters_long')}}">
                    </div>    
            </div>
        </div>
    </div>
    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
        <div class="m-form__actions m-form__actions--solid">
            <div class="row">
                <div class="col-lg-6">
                    <button type="submit" class="btn btn-success btn-brand">{{trans('services::services.update_service')}}</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

<!--end::Form-->

<!-- Callback function -->
<script>
    function updateServiceCallback() {
        // Close modal
        $('#fast_modal').modal('toggle');
        // Reload datatable
        $('#services_table').DataTable().ajax.reload(null, false);
    }
</script>
<script>
    setTimeout(function() {
        $('.icon-font').iconpicker('refresh');
    }, 100);
</script>
@push('scripts')
<script src="{{URL::asset('8x/assets/js/repeater.js')}}" type="text/javascript"></script>
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
            }]
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
@endpush