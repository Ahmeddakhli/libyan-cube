@extends('dashboard.layouts.basic')

@section('content')
    <!--begin::Form-->
    <form action="{{route('inventory.purpose_types.update')}}" method="POST" id="update_purpose_type_form" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="updatePurposeTypeCallback" data-parsley-validate>
        @csrf
        <input type="hidden" name="id" id="id" value="{{$i_purpose_type->id}}" />
        <div class="m-portlet__body">
            <div class="form-group row">
                <div class="col-6">
                    {{-- <label for="order">{{__('inventory::inventory.order')}}</label> --}}
                    <input name="order" id="order" type="text" class="form-control" placeholder="{{__('inventory::inventory.order')}}"  data-parsley-trigger="change focusout" data-parsley-type="integer" data-parsley-min="0" value="{{$i_purpose_type->order}}">
                </div>
            </div>
            <div class="form-group m-form__group row">
                {{-- <label for="i_purpose_id" class="col-lg-4 col-form-label">{{trans('inventory::inventory.select_purpose')}}</label> --}}
                <div class="col-lg-8">
                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="i_purpose_id" name="i_purpose_id" required data-parsley-required data-parsley-required-message="{{trans('inventory::inventory.purpose_is_required')}}" data-parsley-trigger="change focusout" data-parsley-errors-container="#purpose_container">
                        <option value="" selected disabled>{{trans('inventory::inventory.select_purpose')}}</option>
                        @foreach ($purposes as $purpose)
                            <option @if ($i_purpose_type->i_purpose_id == $purpose->id) selected @endif value="{{$purpose->id}}">{{$purpose->value}}</option>
                        @endforeach
                    </select>
                    <div id="purpose_container" class="error_container"></div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12 repeater">
                    <div data-repeater-list="translations">
                        @foreach ($i_purpose_type->translations as $translation)
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

                                <div class="col-6">
                                    {{-- <label for="purpose_type">{{__('inventory::inventory.purpose_type')}}</label> --}}
                                    <input name="purpose_type" id="purpose_type" type="text" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_purpose_type')}}" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_enter_the_purpose_type')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('inventory::inventory.purpose_type_max_is_150_characters_long')}}" value="{{$translation->purpose_type}}">
                                </div>

                                <div class="col-md-2 col-sm-2">
                                    {{-- <label class="control-label">&nbsp;</label> --}}
                                    <a href="javascript:;" data-repeater-delete class="btn btn-brand data-repeater-delete">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        @if (!$i_purpose_type->translations->count())
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

                                <div class="col-6">
                                    {{-- <label for="purpose_type">{{__('inventory::inventory.purpose_type')}}</label> --}}
                                    <input name="purpose_type" id="purpose_type" type="text" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_purpose_type')}}" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_enter_the_purpose_type')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('inventory::inventory.purpose_type_max_is_150_characters_long')}}">
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
                    <a href="javascript:;" data-repeater-create id="repeater_btn" class="btn">
                        <i class="fa fa-plus"></i> {{trans('inventory::inventory.add_purpose_type_translation')}}
                    </a>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <label for="svg">{{__('inventory::inventory.svg')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <textarea rows="6" name="svg" id="svg" class="form-control" placeholder="{{__('inventory::inventory.svg')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295" data-parsley-maxlength-message="{{__('inventory::inventory.svg_max_is_4294967295_characters_long')}}">{{$i_purpose_type->svg}}</textarea>
                </div>
            </div>
        </div>
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-success btn-brand">{{trans('inventory::inventory.update_purpose_type')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

<!--end::Form-->

<!-- Callback function -->
<script>
    function updatePurposeTypeCallback() {
        // Close modal
        $('#fast_modal').modal('toggle');
        // Reload datatable
        purpose_types_table.ajax.reload(null, false);
    }
</script>

@push('scripts')
    <script src="{{asset('8x/assets/js/repeater.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
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
        $("#repeater_btn").click(function(){
            setTimeout(function(){
                // $(".selectpicker").selectpicker('refresh');
            }, 100);
        });
    </script>
@endpush