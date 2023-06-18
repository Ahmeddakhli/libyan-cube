@extends('dashboard.layouts.basic')

@section('content')
<!--begin::Form-->
<style>
    .select.bs-select-hidden,
    .bootstrap-select>select.bs-select-hidden,
    select.selectpicker {
        display: block !important;
    }
</style>
<form action="{{route('inventory.phases.update')}}" method="POST" id="update_phase_form" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="updatephaseCallback" data-parsley-validate>
    @csrf
    <input type="hidden" name="id" id="id" value="{{$i_phase->id}}" />
    <div class="m-portlet__body">
        <div class="form-group row">
            <div class="col-6">
                {{-- <label for="delevery_time">{{__('inventory::inventory.delevery_time')}}</label> --}}
                <input name="delivery_date" autocomplete="off" class="form-control datetimepicker-init" placeholder="{{trans('inventory::inventory.delivery_date')}}" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.from_date_is_required')}}" data-parsley-trigger="change focusout" value="{{$i_phase->delivery_date  }}" />
            </div>
        </div>
        <div class="form-group row">
            <div class="col-12 repeater">
                <div data-repeater-list="translations">
                    @foreach ($i_phase->translations as $translation)
                    <div data-repeater-item class="row">
                        <div class="col-6">
                            {{-- <label for="language_id">{{__('inventory::inventory.language')}}</label> --}}
                            <select class="form-control" id="language_id" name="language_id" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_select_the_language')}}" data-parsley-trigger="change focusout">
                                <option value="" disabled>{{__('inventory::inventory.language')}}</option>
                                @foreach ($languages as $language)
                                <option value="{{$language->id}}" @if ($translation->language_id == $language->id) selected @endif>{{$language->code}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row col-6 form-group">
                            {{-- <label for="phase">{{__('inventory::inventory.phase')}}</label> --}}
                            <input name="name" id="phase" value="{{$translation->name}}" type="text" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_phase')}}" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_enter_the_phase')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('inventory::inventory.phase_max_is_150_characters_long')}}">
                        </div>
                        <div class="row col-6 form-group">
                            {{-- <label for="description">{{__('inventory::inventory.description')}}</label> --}}
                            <input name="description" id="description" value="{{$translation->description}}" type="text" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_description')}}" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_enter_the_phase')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="16777215" data-parsley-maxlength-message="{{__('inventory::inventory.phase_description_max_is_16777215_characters_long')}}">
                        </div>>

                        <div class="col-md-2 col-sm-2">
                            {{-- <label class="control-label">&nbsp;</label> --}}
                            <a href="javascript:;" data-repeater-delete class="btn btn-brand data-repeater-delete">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                    @if (!$i_phase->translations->count())
                    <div data-repeater-item class="row">
                        <div class="col-6">
                            {{-- <label for="language_id">{{__('inventory::inventory.language')}}</label> --}}
                            <select class="form-control" id="language_id" name="language_id" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_select_the_language')}}" data-parsley-trigger="change focusout">
                                <option value="" selected disabled>{{__('inventory::inventory.language')}}</option>
                                @foreach ($languages as $language)
                                <option value="{{$language->id}}" @if($language->id == 1) selected @endif>{{$language->code}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row col-6 form-group">
                            {{-- <label for="phase">{{__('inventory::inventory.phase')}}</label> --}}
                            <input name="name" id="phase" type="text" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_phase')}}" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_enter_the_phase')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('inventory::inventory.phase_max_is_150_characters_long')}}">
                        </div>
                        <div class="row col-6 form-group">
                            {{-- <label for="description">{{__('inventory::inventory.description')}}</label> --}}
                            <input name="description" id="description" type="text" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_description')}}" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_enter_the_phase')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="16777215" data-parsley-maxlength-message="{{__('inventory::inventory.phase_description_max_is_16777215_characters_long')}}">
                        </div>

                        <div class="col-md-2 col-sm-2">
                            {{-- <label class="control-label">&nbsp;</label> --}}
                            <a href="javascript:;" data-repeater-delete class="btn btn-brand data-repeater-delete">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="box">
                            <label for="description">{{__('inventory::inventory.attachments')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                            <input type="file" name="attachments[]" multiple class="inputfile inputfile-5" id="file-6" data-multiple-caption="{count} {{trans('inventory::inventory.files_selected')}}" />
                            <label for="file-6">
                                <figure><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                                        <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z" /></svg></figure> <span></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row col-6  form-group">
                    <label for="i_project_id">{{__('inventory::inventory.project')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <select class="form-control selectpicker" data-live-search="true" id="i_project_id" name="project_id" data-parsley-trigger="change focusout">
                        <option value="" selected disabled>{{__('inventory::inventory.select_project')}}</option>
                        @foreach ($projects as $project)
                        <option value="{{$project->id}}">{{$project->project}}</option>
                        @endforeach
                    </select>
                </div>
                <a href="javascript:;" data-repeater-create id="repeater_btn" class="btn">
                    <i class="fa fa-plus"></i> {{trans('inventory::inventory.add_phase_translation')}}
                </a>
            </div>
        </div>
    </div>
    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
        <div class="m-form__actions m-form__actions--solid">
            <div class="row">
                <div class="col-lg-6">
                    <button type="submit" class="btn btn-success btn-brand">{{trans('inventory::inventory.update_phase')}}</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

<!--end::Form-->

<!-- Callback function -->
<script>
    function updatephaseCallback() {
        // Close modal
        $('#fast_modal').modal('toggle');
        // Reload datatable
        phases_table.ajax.reload(null, false);
    }
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