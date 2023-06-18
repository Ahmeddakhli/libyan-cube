@extends('dashboard.layouts.basic')


@section('content')
<style>
    .fade:not(.show) {
        opacity: 1
    }
</style>
<!--begin::Form-->
<form action="{{route('welcome_messages.store')}}" method="POST" id="create_welcome_message_form" enctype="multipart/form-data" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="createWelcomeMessageCallback" data-parsley-validate>
    @csrf
    <div class="m-portlet__body">
        <div class="form-group row">
            <div class="col-6 mt-5">
                <label for="link">{{__('welcome_messages::welcome_messages.link')}}</label>
                <input name="link" id="link" type="text" class="form-control" placeholder="{{__('welcome_messages::welcome_messages.link')}}">
            </div>
            <div class="col-6 mt-5">
                <label for="time">{{__('welcome_messages::welcome_messages.time')}} <small>{{__('welcome_messages::welcome_messages.with_seconds')}}</small> </label>
                <input name="time" id="time" type="number" class="form-control" placeholder="{{__('welcome_messages::welcome_messages.time')}}" required data-parsley-required-message="{{__('welcome_messages::welcome_messages.time')}}">
            </div>
            <div class="form-group row col-12">
                <div class="col-12 repeater">
                    <div data-repeater-list="translations">
                        <div data-repeater-item class="row">
                            <div class="col-6 mt-5">
                                <label for="language_id">{{__('welcome_messages::welcome_messages.language')}}</label>
                                <select class="form-control" id="language_id" name="language_id" required data-parsley-required data-parsley-required-message="{{__('welcome_messages::welcome_messages.please_select_the_language')}}" data-parsley-trigger="change focusout">
                                    <option value="" selected disabled>{{__('welcome_messages::welcome_messages.language')}}</option>
                                    @foreach ($languages as $language)
                                    <option value="{{$language->id}}" @if($language->id == 1) selected @endif>{{$language->code}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-6 mt-5">
                                <label for="title">{{__('welcome_messages::welcome_messages.title')}}</label>
                                <input name="title" id="title" type="text" required data-parsley-required-message="{{__('welcome_messages::welcome_messages.title')}}" class="form-control" placeholder="{{__('welcome_messages::welcome_messages.title')}}" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('welcome_messages::welcome_messages.welcome_message_max_is_150_characters_long')}}">
                            </div>

                            <div class="col-md-2 col-sm-2 mt-auto">
                                {{-- <label class="control-label">&nbsp;</label> --}}
                                <a href="javascript:;" data-repeater-delete class="btn btn-brand data-repeater-delete">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <a href="javascript:;" data-repeater-create id="repeater_btn" class="btn">
                        <i class="fa fa-plus"></i> {{trans('welcome_messages::welcome_messages.add_translation')}}
                    </a>
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
                        <a href="{{route('welcome_messages.welcome_messages.create')}}" data-8xload class="btn btn-brand btn-icon-sm">
                        <i class="flaticon2-plus"></i> {{trans('welcome_messages::welcome_messages.create_new')}}
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
    function createWelcomeMessageCallback() {
        // Close modal
        $('#fast_modal').modal('toggle');
        // Reload datatable
        welcome_messages_table.ajax.reload(null, false);
    }
</script>

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
    $('.icon-font').iconpicker();
</script>
@endpush