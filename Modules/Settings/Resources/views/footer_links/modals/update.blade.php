@extends('dashboard.layouts.basic')

@section('content')
<style>
    .fade:not(.show) {
        opacity: 1
    }
</style>
<!--begin::Form-->
<form action="{{route('settings.footer_links.update')}}" method="POST" id="update_footer_link_form" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="updateFooterlinkCallback" data-parsley-validate enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="id" value="{{$footer_link->id}}" />
    <div class="m-portlet__body">
        <div class="form-group row col-12">
            <div class="repeater">
                <div data-repeater-list="translations">
                    @foreach ($footer_link->translations as $translation)
                    <div data-repeater-item class="row">
                        <div class="col-5 mt-5">
                            <label for="language_id">{{__('settings::settings.language')}}</label>
                            <select class="form-control" id="language_id" name="language_id" required data-parsley-required data-parsley-required-message="{{__('settings::settings.please_select_the_language')}}" data-parsley-trigger="change focusout">
                                <option value="" disabled>{{__('settings::settings.language')}}</option>
                                @foreach ($languages as $language)
                                <option value="{{$language->id}}" @if ($translation->language_id == $language->id) selected @endif>{{$language->code}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-5 mt-5">
                            <label for="title">{{__('settings::settings.title')}}</label>
                            <input name="title" id="title" type="text" class="form-control" placeholder="{{__('settings::settings.please_enter_the_footerlink')}}" required data-parsley-required data-parsley-required-message="{{__('settings::settings.please_enter_the_footerlink')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('settings::settings.settings_max_is_150_characters_long')}}" value="{{$translation->title}}">
                        </div>
                        <div class="col-md-2 col-sm-2 mt-auto">
                            {{-- <label class="control-label">&nbsp;</label> --}}
                            <a href="javascript:;" data-repeater-delete class="btn btn-brand data-repeater-delete">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                    @if (!$footer_link->translations->count())
                    <div data-repeater-item class="row">
                        <div class="col-5 mt-5">
                            <label for="language_id">{{__('settings::settings.language')}}</label>
                            <select class="form-control" id="language_id" name="language_id" required data-parsley-required data-parsley-required-message="{{__('settings::settings.please_select_the_language')}}" data-parsley-trigger="change focusout">
                                <option value="" selected disabled>{{__('settings::settings.language')}}</option>
                                @foreach ($languages as $language)
                                <option value="{{$language->id}}" @if($language->id == 1) selected @endif>{{$language->code}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-5 mt-5">
                            <label for="title">{{__('settings::settings.title')}}</label>
                            <input name="title" id="title" type="text" class="form-control" placeholder="{{__('settings::settings.please_enter_the_footerlink')}}" required data-parsley-required data-parsley-required-message="{{__('settings::settings.please_enter_the_footerlink')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('settings::settings.settings_max_is_150_characters_long')}}">
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
                    <i class="fa fa-plus"></i> {{trans('settings::settings.add_footerlink_translation')}}
                </a>
            </div>
            <div class="form-group col-12 position-relative">
                <div class="col-12 mt-5 position-relative">
                    <label for="link">{{__('settings::settings.link')}}</label>
                    <input name="link" id="link" value="{{$footer_link->link}}" type="link" class="form-control" placeholder="{{__('settings::settings.please_enter_the_footerlink')}}" required data-parsley-required data-parsley-required-message="{{__('settings::settings.please_enter_the_footerlink')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('settings::settings.settings_max_is_150_characters_long')}}">
                </div>

            </div>
        </div>
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-success btn-brand">{{trans('settings::settings.update_footerlink')}}</button>
                    </div>
                </div>
            </div>
        </div>
</form>
@endsection
<!--end::Form-->
<!-- Callback function -->
<script>
    function updateFooterlinkCallback() {
        // Close modal
        $('#fast_modal').modal('toggle');
        // Reload datatable
        var footer_links_table = $('#footer_links_table').DataTable();
        footer_links_table.ajax.reload(null, false);
    }
    $('.icon-font').iconpicker();
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
@endpush