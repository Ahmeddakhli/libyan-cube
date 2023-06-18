@extends('dashboard.layouts.basic')


@section('content')
<!--begin::Form-->
<form action="{{route('inventory.purpose_types.store')}}" method="POST" id="create_purpose_type_form" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="createPurposeTypeCallback" data-parsley-validate>
    @csrf
    <div class="m-portlet__body">
        <div class="form-group row">
            <div class="col-6">
                {{-- <label for="order">{{__('inventory::inventory.order')}}</label> --}}
                <input name="order" id="order" type="text" class="form-control" placeholder="{{__('inventory::inventory.order')}}"  data-parsley-trigger="change focusout" data-parsley-type="integer" data-parsley-min="0">
            </div>
        </div>
        <div class="form-group m-form__group row">
            {{-- <label for="i_purpose_id" class="col-lg-4 col-form-label">{{trans('inventory::inventory.select_purpose')}}</label> --}}
            <div class="col-lg-8">
                <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="i_purpose_id" name="i_purpose_id" required data-parsley-required data-parsley-required-message="{{trans('inventory::inventory.purpose_is_required')}}" data-parsley-trigger="change focusout" data-parsley-errors-container="#purpose_container">
                    <option value="" selected disabled>{{trans('inventory::inventory.select_purpose')}}</option>
                    @foreach ($purposes as $purpose)
                    <option value="{{$purpose->id}}">{{$purpose->value}}</option>
                    @endforeach
                </select>
                <div id="purpose_container" class="error_container"></div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-12 repeater">
                <div data-repeater-list="translations">
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
                </div>
                <a href="javascript:;" data-repeater-create id="repeater_btn" class="btn">
                    <i class="fa fa-plus"></i> {{trans('inventory::inventory.add_purpose_type_translation')}}
                </a>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-12">
                <label for="svg">{{__('inventory::inventory.svg')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                <textarea rows="6" name="svg" id="svg" class="form-control" placeholder="{{__('inventory::inventory.svg')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295" data-parsley-maxlength-message="{{__('inventory::inventory.svg_max_is_4294967295_characters_long')}}"></textarea>
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
                        <a href="{{route('inventory.purpose_types.create')}}" data-8xload class="btn btn-brand btn-icon-sm">
                    <i class="flaticon2-plus"></i> {{trans('inventory::inventory.create_new')}}
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
    function createPurposeTypeCallback() {
        $('#fast_modal').modal('toggle');
        // Reload datatable
        purpose_types_table.ajax.reload(null, false);
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
@endpush