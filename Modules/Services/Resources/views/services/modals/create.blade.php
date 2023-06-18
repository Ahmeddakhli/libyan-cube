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
<form action="{{route('services.store')}}" method="POST" id="create_service_form" enctype="multipart/form-data" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="createServiceCallback" data-parsley-validate>
    @csrf
    <div class="m-portlet__body">

        <div class="form-group row ">
            <div class="fancy-checkbox ml-3">
                <input name="is_featured" id="is_featured" type="checkbox">
                <label for="is_featured">{{__('services::services.is_featured')}}</label>
            </div>
            <div class="col-12 repeater">
                <div data-repeater-list="translations">
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
                            {{-- <label for="title">{{__('services::services.title')}}</label> --}}
                            <input name="title" id="title" type="text" class="form-control" placeholder="{{__('services::services.please_enter_the_service')}}" required data-parsley-required data-parsley-required-message="{{__('services::services.please_enter_the_service')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('services::services.title_max_is_150_characters_long')}}">
                        </div>
                        <div class="col-lg-12">
                            <label for="description">{{__('services::services.description')}}</label>
                            <textarea rows="6" name="description" id="description" class="form-control" placeholder="{{__('services::services.enter_description')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295" data-parsley-maxlength-message="{{__('services::services.description_max_is_4294967295_characters_long')}}" required data-parsley-required data-parsley-required-message="{{__('services::services.please_enter_the_service')}}"></textarea>
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
                    <i class="fa fa-plus"></i> {{trans('services::services.add_service_translation')}}
                </a>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-5 mt-5">
                <label for="icon">{{__('socials::social.icon')}}</label>
                <input name="icon" id="icon" type="text" autocomplete="off" class="form-control icon-font" placeholder="{{__('socials::social.please_enter_the_social_icon')}}" required data-parsley-required data-parsley-required-message="{{__('socials::social.please_enter_the_social_icon')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('socials::social.social_max_is_150_characters_long')}}">
            </div>
        </div>
    </div>
    </div>
    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
        <div class="m-form__actions m-form__actions--solid">
            <div class="row">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-success">{{__('main.submit')}}</button>
                    <button type="reset" class="btn btn-secondary">{{__('main.reset')}}</button>
                    {{--
                        <a href="{{route('services.create')}}" data-8xload class="btn btn-brand btn-icon-sm">
                    <i class="flaticon2-plus"></i> {{trans('services::services.create_new')}}
                    </a>
                    --}}
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
    function createServiceCallback() {
        $('#fast_modal').modal('toggle');

        // Reload datatable
        services_table.ajax.reload(null, false);
    }
</script>

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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/3.2.0/css/fontawesome-iconpicker.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/3.2.0/js/fontawesome-iconpicker.min.js"></script>
<script>
    setTimeout(function() {
        $('.icon-font').iconpicker('refresh');
    }, 100);
</script>
@endpush