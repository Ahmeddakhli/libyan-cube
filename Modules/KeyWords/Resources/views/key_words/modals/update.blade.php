@extends('dashboard.layouts.basic')

@section('content')
<!--begin::Form-->
<form action="{{route('key_words.update')}}" method="POST" id="update_key_word_form" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="updateKeyWordCallback" data-parsley-validate enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="id" value="{{$key_word->id}}" />
    <div class="m-portlet__body">
        <div class="fancy-checkbox">
            <input name="is_featured" id="is_featured" type="checkbox" @if($key_word->is_featured == 1) checked=checked @endif class="form-control">
            <label for="is_featured">{{__('key_words::key_words.is_featured')}}</label>
        </div>
        <div class="form-group row">
            <div class="col-4">
                <label for="price_from">{{__('inventory::inventory.price_from')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                <input name="price_from" id="price_from" value="{{$key_word->price_from}}" type="number" class="form-control" placeholder="{{__('inventory::inventory.enter_price')}}" data-parsley-trigger="change focusout">
            </div>
            <div class="col-4">
                <label for="price_to">{{__('inventory::inventory.price_to')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                <input name="price_to" id="price_to" value="{{$key_word->price_to}}" type="number" class="form-control" placeholder="{{__('inventory::inventory.enter_price')}}" data-parsley-trigger="change focusout">
            </div>
            <div class="col-4">
                <label for="region_id">{{__('inventory::inventory.region')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                <select class="form-control selectpicker" multiple data-live-search="true" id="region_id" name="region_ids[]" data-parsley-trigger="change focusout" onchange="if($(this).val().length > 0){getRegionCities($(this).val())}">
                    <option value="" selected disabled>{{__('inventory::inventory.select_region')}}</option>
                    @foreach ($regions as $region)
                        <option value="{{$region->id}}" @if(in_array($region->id,collect($key_word->regions)->pluck('id')->toArray())) selected @endif >{{$region->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-4">
                <label for="city_id">{{__('inventory::inventory.city')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                <select class="form-control selectpicker" multiple data-live-search="true" id="city_id" name="city_ids[]" data-parsley-trigger="change focusout">
                    <option value="" selected disabled>{{__('inventory::inventory.select_city')}}</option>
                    {{-- @foreach ($cities as $city)
                                                                <option value="{{$city->id}}">{{$city->name}}</option>
                    @endforeach --}}
                </select>
            </div>
            <div class="col-4">
                <label for="i_purpose_id">{{__('inventory::inventory.purpose')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                <select class="form-control selectpicker" data-live-search="true" multiple id="i_purpose_id" name="type_ids[]" data-parsley-trigger="change focusout" onchange="getPurposePurposeTypes([$(this).find(':selected').val()])">
                    <option value="" disabled>{{__('inventory::inventory.select_purpose')}}</option>
                    
                    @foreach ($purposes as $purpose)
                        @if(in_array($purpose->purpose,['Residential','سكني','Commercial','تجاري','Administrative','إداري','Medical','طبي']))
                            <option value="{{$purpose->id}}" @if(in_array($purpose->id,collect($key_word->types)->pluck('id')->toArray())) selected @endif>{{$purpose->purpose}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-12 repeater">
                <div data-repeater-list="translations">
                    @foreach ($key_word->translations as $translation)
                    <div data-repeater-item class="row">
                        <div class="col-6">
                            {{-- <label for="language_id">{{__('key_words::key_words.language')}}</label> --}}
                            <select class="form-control" id="language_id" name="language_id" required data-parsley-required data-parsley-required-message="{{__('key_words::key_words.please_select_the_language')}}" data-parsley-trigger="change focusout">
                                <option value="" disabled>{{__('key_words::key_words.language')}}</option>
                                @foreach ($languages as $language)
                                <option value="{{$language->id}}" @if ($translation->language_id == $language->id) selected @endif>{{$language->code}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            {{-- <label for="key_word">{{__('key_words::key_words.key_word')}}</label> --}}
                            <input name="title" id="title" type="text" class="form-control" placeholder="{{__('key_words::key_words.please_enter_the_key_word')}}" required data-parsley-required data-parsley-required-message="{{__('key_words::key_words.please_enter_the_key_word')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('key_words::key_words.key_word_max_is_150_characters_long')}}" value="{{$translation->title}}">
                        </div>
                        <div class="col-md-2 col-sm-2">
                            {{-- <label class="control-label">&nbsp;</label> --}}
                            <a href="javascript:;" data-repeater-delete class="btn btn-brand data-repeater-delete">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                    @if (!$key_word->translations->count())
                    <div data-repeater-item class="row">
                        <div class="col-6">
                            {{-- <label for="language_id">{{__('key_words::key_words.language')}}</label> --}}
                            <select class="form-control" id="language_id" name="language_id" required data-parsley-required data-parsley-required-message="{{__('key_words::key_words.please_select_the_language')}}" data-parsley-trigger="change focusout">
                                <option value="" selected disabled>{{__('key_words::key_words.language')}}</option>
                                @foreach ($languages as $language)
                                <option value="{{$language->id}}" @if($language->id == 1) selected @endif>{{$language->code}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            {{-- <label for="title">{{__('key_words::key_words.key_word')}}</label> --}}
                            <input name="title" id="title" type="text" class="form-control" placeholder="{{__('key_words::key_words.please_enter_the_key_word')}}" required data-parsley-required data-parsley-required-message="{{__('key_words::key_words.please_enter_the_key_word')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('key_words::key_words.key_word_max_is_150_characters_long')}}">
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
                    <i class="fa fa-plus"></i> {{trans('key_words::key_words.add_key_word_translation')}}
                </a>
            </div>
        </div>
    </div>
    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
        <div class="m-form__actions m-form__actions--solid">
            <div class="row">
                <div class="col-lg-6">
                    <button type="submit" class="btn btn-success btn-brand">{{trans('key_words::key_words.update_key_word')}}</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
<!--end::Form-->
<script>
    $('.m_selectpicker').selectpicker();
</script>
<!-- Callback function -->
<script>
    function updateKeyWordCallback() {
        // Close modal
        $('#fast_modal').modal('toggle');
        // Reload datatable
        $('#key_words_table').DataTable().ajax.reload(null, false);
    }
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
    $("#region_id").selectpicker();
    $("#city_id").selectpicker();
    $("#i_purpose_id").selectpicker();
    // Initialize select picker for repeated items
    $("#repeater_btn").click(function() {
        setTimeout(function() {
            // $(".selectpicker").selectpicker('refresh');
        }, 100);
    });
</script>

<script>
        function getRegionCities(region_id, selected_city_id = null) {
        $('#city_id').empty();
        $("#city_id").selectpicker("refresh");

        // BlockUI
        KTApp.blockPage({
            overlayColor: "#000000",
            type: "loader",
            state: "success",
            message: "{{trans('main.please_wait')}}"
        });

        $.ajax({
            url: "{{route('locations.getRegionCities')}}",
            type: "GET",
            data: {
                region_id: region_id
            },
            success: function(response) {
                // UnblockUI
                KTApp.unblockPage();
                // Show notification
                if (response.status) {
                    // Insert empty city first
                    $('#city_id').append($('<option>', {
                        value: "",
                        text: "{{__('inventory::inventory.select_city')}}"
                    }));
                    $.each(response.data, function(i, city) {
                        $('#city_id').append($('<option>', {
                            value: city.id,
                            text: city.name
                        }));
                    });
                    if (selected_city_id) {
                        $('#city_id').selectpicker('val', selected_city_id);
                    }
                    $("#city_id").selectpicker("refresh");
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
    @if (!empty($key_word->regions))
    getRegionCities(@json(collect($key_word->regions)->pluck('id')->toArray()), @json(collect($key_word->cities)->pluck('id')->toArray()));
@endif
</script>
@endpush