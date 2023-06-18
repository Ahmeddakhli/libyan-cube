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
<form action="{{route('socials.update')}}" method="POST" id="update_social_form" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="updateSocialCallback" data-parsley-validate enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="id" value="{{$social->id}}" />
    <div class="m-portlet__body">
        <div class="form-group row col-12">
        <div class="fancy-checkbox col-12 mb-2">
                <input name="is_featured" id="is_featured" type="checkbox" @if($social->is_featured == 1) checked=checked @endif>
                <label for="is_featured">{{__('blog::blog.is_featured')}}</label>
            </div>
            <div class="repeater">
                <div data-repeater-list="translations">
                    @foreach ($social->translations as $translation)
                    <div data-repeater-item class="row">
                        <div class="col-5 mt-5">
                            <label for="language_id">{{__('socials::social.language')}}</label>
                            <select class="form-control" id="language_id" name="language_id" required data-parsley-required data-parsley-required-message="{{__('socials::social.please_select_the_language')}}" data-parsley-trigger="change focusout">
                                <option value="" disabled>{{__('socials::social.language')}}</option>
                                @foreach ($languages as $language)
                                <option value="{{$language->id}}" @if ($translation->language_id == $language->id) selected @endif>{{$language->code}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-5 mt-5">
                            <label for="title">{{__('socials::social.title')}}</label>
                            <input name="title" id="title" type="text" class="form-control" placeholder="{{__('socials::social.please_enter_the_social')}}" required data-parsley-required data-parsley-required-message="{{__('socials::social.please_enter_the_social')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('socials::social.social_max_is_150_characters_long')}}" value="{{$translation->title}}">
                        </div>
                        <div class="col-md-2 col-sm-2 mt-auto">
                            {{-- <label class="control-label">&nbsp;</label> --}}
                            <a href="javascript:;" data-repeater-delete class="btn btn-brand data-repeater-delete">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                    @if (!$social->translations->count())
                    <div data-repeater-item class="row">
                        <div class="col-5 mt-5">
                            <label for="language_id">{{__('socials::social.language')}}</label>
                            <select class="form-control" id="language_id" name="language_id" required data-parsley-required data-parsley-required-message="{{__('socials::social.please_select_the_language')}}" data-parsley-trigger="change focusout">
                                <option value="" selected disabled>{{__('socials::social.language')}}</option>
                                @foreach ($languages as $language)
                                <option value="{{$language->id}}" @if($language->id == 1) selected @endif>{{$language->code}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-5 mt-5">
                            <label for="title">{{__('socials::social.title')}}</label>
                            <input name="title" id="title" type="text" class="form-control" placeholder="{{__('socials::social.please_enter_the_social')}}" required data-parsley-required data-parsley-required-message="{{__('socials::social.please_enter_the_social')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('socials::social.social_max_is_150_characters_long')}}">
                        </div>

                        <div class="col-md-2 col-sm-2 mt-auto">
                            {{-- <label class="control-label">&nbsp;</label> --}}
                            <a href="javascript:;" data-repeater-delete class="btn btn-brand data-repeater-delete">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
                <a href="javascript:;" data-repeater-create id="repeater_btn" class="btn">
                    <i class="fa fa-plus"></i> {{trans('socials::social.add_social_translation')}}
                </a>
            </div>
            <div class="form-group col-12 position-relative d-flex">
                <div class="col-6 mt-5 position-relative">
                    <label for="link">{{__('socials::social.social')}}</label>
                    <input name="link" id="link" value="{{$social->link}}" type="text" class="form-control" placeholder="{{__('socials::social.please_enter_the_social')}}" required data-parsley-required data-parsley-required-message="{{__('socials::social.please_enter_the_social')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('socials::social.social_max_is_150_characters_long')}}">
                </div>
                <div class="col-6 mt-5">
                    <label for="icon">{{__('socials::social.icon')}}</label>
                    <input name="icon" id="icon" autocomplete="OFF" value="{{$social->icon}}" type="text" class="form-control icon-font" placeholder="{{__('socials::social.please_enter_the_social')}}" required data-parsley-required data-parsley-required-message="{{__('socials::social.please_enter_the_social')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('socials::social.social_max_is_150_characters_long')}}">
                </div>
            </div>
        </div>
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-success btn-brand">{{trans('socials::social.update_social')}}</button>
                    </div>
                </div>
            </div>
        </div>
</form>
@endsection
<!--end::Form-->

<!-- Callback function -->
<script>
    function updateSocialCallback() {
        // Close modal
        $('#fast_modal').modal('toggle');

        // Reload datatable
        socials_table.ajax.reload(null, false);
    }
</script>
<script>
    setTimeout(function() {
        $('.icon-font').iconpicker('refresh');
    }, 100);
</script>
@push('scripts')
<script src="{{asset('8x/assets/js/repeater.js')}}" type="text/javascript"></script>
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
            url: "{{route('socials.deleteAttachment')}}",
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