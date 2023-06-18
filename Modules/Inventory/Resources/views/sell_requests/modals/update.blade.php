@extends('dashboard.layouts.basic')

@section('content')
<!--begin::Form-->
<form action="{{route('inventory.sell_requests.update')}}" method="POST" id="update_sell_request_form" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="UpdateISellRequestCallback" data-parsley-validate>
    @csrf
    <input type="hidden" name="id" id="id" value="{{$i_sell_request->id}}" />
    <div class="m-portlet__body">
        <div class="form-group row">
            <div class="col-6">
                <label for="compound">{{__('inventory::inventory.compound')}}</label>
                <input name="compound" id="compound" value="{{$i_sell_request->compound}}" type="text" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_compound')}}" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_enter_the_compound')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('inventory::inventory.title_max_is_150_characters_long')}}">
            </div>
        </div>
        <div class="form-group row">
            <!-- Purpose -->
            <div class="col-6">
                <label for="i_purpose_id">{{__('inventory::inventory.purpose')}}</label>
                <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="i_purpose_id" name="i_purpose_id" data-parsley-trigger="change focusout" onchange="getPurposePurposeTypes([$(this).find(':selected').val()])" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_select_the_purpose')}}">
                    <option value="" selected disabled>{{__('inventory::inventory.select_purpose')}}</option>
                    @foreach ($purposes as $purpose)
                        <option value="{{$purpose->id}}" @if ($i_sell_request->i_purpose_id == $purpose->id) selected @endif>{{$purpose->purpose}}</option>
                    @endforeach
                </select>
            </div>
            <!-- Purpose Type -->
            <div class="col-6">
                <label for="i_purpose_type_id">{{__('inventory::inventory.purpose_type')}}</label>
                <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="i_purpose_type_id" name="i_purpose_type_id" data-parsley-trigger="change focusout" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_select_the_purpose_type')}}">
                    <option value="" selected disabled>{{__('inventory::inventory.select_purpose_type')}}</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-6">
                <label for="unit_name">{{__('inventory::inventory.unit_name')}}</label>
                <input name="unit_name" value="{{$i_sell_request->unit_name}}" id="unit_name" type="text" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_unit_name')}}" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_enter_the_unit_name')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('inventory::inventory.title_max_is_150_characters_long')}}">
            </div>
            <div class="col-6">
                <label for="name">{{__('inventory::inventory.name')}}</label>
                <input name="name" value="{{$i_sell_request->name}}" id="name" type="text" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_name')}}" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_enter_the_name')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('inventory::inventory.title_max_is_150_characters_long')}}">
            </div>
            <div class="col-6">
                <label for="email">{{__('inventory::inventory.email')}}</label>
                <input name="email" value="{{$i_sell_request->email}}" id="email" type="text" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_email')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('inventory::inventory.title_max_is_150_characters_long')}}">
            </div>
            <div class="col-6">
                <label for="phone">{{__('inventory::inventory.phone')}}</label>
                <input name="phone" value="{{$i_sell_request->phone}}" id="phone" type="text" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_phone')}}" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_enter_the_phone')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('inventory::inventory.title_max_is_150_characters_long')}}">
            </div>
            <div class="col-6">
                <label for="comments">{{__('inventory::inventory.comments')}}</label>
                <textarea name="comments" id="comments" type="text" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_comments')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295" data-parsley-maxlength-message="{{__('inventory::inventory.comments_max_is_4294967295_characters_long')}}">{{$i_sell_request->comments}}</textarea>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-4">

                <div class="row">
                    <div class="box">
                        <label for="description">{{__('inventory::inventory.attachments')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                        <input type="file" name="attachments[]" multiple class="inputfile inputfile-5" id="file-6" multiple />
                        <label for="file-6">
                            <figure>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                                    <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z" />
                                </svg>
                            </figure>
                            <span></span>
                        </label>
                    </div>
                </div>
                @foreach ($attachments as $attachment)
                    @if (in_array($attachment->mime_type, ['tiff', 'image/tiff', 'jpeg', 'image/jpeg', 'gif', 'image/gif', 'png', 'image/png']))
                        <div class="card" id="card-{{$attachment->id}}">
                            <a class="html5lightbox" title="" data-group="image_group" href="{{asset('storage/'.$attachment->id.'/'.$attachment->file_name)}}" data-width="800" data-height="800" title="{{trans('inventory::inventory.view_image')}}">
                                <img class="card-img-top" src="{{asset('storage/'.$attachment->id.'/'.$attachment->file_name)}}" alt="{{trans('inventory::inventory.image')}}">
                            </a>
                            @if (auth()->user()->hasPermission('delete-inventory-unit-attachment'))
                                <div class="card-body" style="text-align: center !important;">
                                    {{-- <h5 class="card-title">Card title that wraps to a new line</h5> --}}
                                    {{-- <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> --}}
                                    <button type="button" class="btn btn-danger" onclick="deleteAttachment({{$attachment->id}});"><i class="fas fa-trash-alt"></i> {{trans('inventory::inventory.delete')}}</button>
                                </div>
                            @endif
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    </div>
    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
        <div class="m-form__actions m-form__actions--solid">
            <div class="row">
                <div class="col-lg-6">
                    <button type="submit" class="btn btn-success btn-brand">{{trans('inventory::inventory.update_sell_request')}}</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

<!--end::Form-->

<!-- Callback function -->
<script>
    function UpdateISellRequestCallback() {
        // Close modal
        $('#fast_modal').modal('toggle');
        // Reload datatable
        sell_requests_table.ajax.reload(null, false);
    }
    $("#i_purpose_type_id").selectpicker("refresh");
</script>
<script>
    function getPurposePurposeTypes(i_purpose_id, selected_i_purpose_type_id = null, div_id = null)
    {
        // If div is null, set default div
        if (!div_id) {
            div_id = 'i_purpose_type_id';
        }

        // Return if not array
        if (!Array.isArray(i_purpose_id)) {
            return;
        }
        // If empty array, empty then return
        if (i_purpose_id && Array.isArray(i_purpose_id) && !i_purpose_id.length) {
            $('#'+div_id).empty();
            $("#"+div_id).selectpicker("refresh");
            return;
        }

        $('#'+div_id).empty();
        $("#"+div_id).selectpicker("refresh");

        // BlockUI
        if (i_purpose_id.length) {
            KTApp.blockPage({overlayColor:"#000000",type:"loader",state:"success",message:"{{trans('main.please_wait')}}"});
            $.ajax({
                url: "{{route('inventory.purpose_types.GetIPurposePurposeTypes')}}",
                type: "GET",
                data: {i_purpose_id: i_purpose_id},
                success: function(response) {
                    // UnblockUI
                    KTApp.unblockPage();
                    // Show notification
                    if (response.status) {
                        // Insert empty purpose type first
                        // $('#'+div_id).append($('<option>', {
                        //     value: "",
                        //     text: "{{__('inventory::inventory.select_purpose_type')}}"
                        // }));
                        $('#'+div_id).append('<option value="" selected disabled>{{trans("inventory::inventory.select_deselect_purpose_types")}}</option>');
                        $.each(response.data, function(i, purpose_type) {
                            $('#'+div_id).append($('<option>', {
                                value: purpose_type.id,
                                text: purpose_type.purpose_type
                            }));
                        });
                        if (selected_i_purpose_type_id) {
                            $('#'+div_id).selectpicker('val', selected_i_purpose_type_id);
                        }
                        $('#'+div_id).selectpicker("refresh");
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
                                window.scrollTo({ top: 0, behavior: 'smooth' });
                                showMsg(form, 'danger', xhr.responseJSON.error, true);
                            }, 500);
                            showNotification(xhr.responseJSON.error, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
                        } else {
                            setTimeout(function() {
                                window.scrollTo({ top: 0, behavior: 'smooth' });
                                showMsg(form, 'danger', statusText, true);
                            }, 500);
                            showNotification(statusText, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
                        }
                    } else if (xhr.status == 422) {
                        // HTTP_UNPROCESSABLE_ENTITY
                        if (xhr.responseJSON.errors) {
                            window.scrollTo({ top: 0, behavior: 'smooth' });
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
                                window.scrollTo({ top: 0, behavior: 'smooth' });
                                showMsg(form, 'danger', statusText, true);
                            }, 500);
                            showNotification(statusText, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
                        }
                    } else if (xhr.status == 500) {
                        // Internal Server Error
                        var error = xhr.responseJSON.message;
                        if (xhr.responseJSON.error) {                       
                            setTimeout(function() {
                                window.scrollTo({ top: 0, behavior: 'smooth' });
                                showMsg(form, 'danger', xhr.responseJSON.error, true);
                            }, 500);
                            showNotification(xhr.responseJSON.error, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
                        } else {
                            setTimeout(function() {
                                window.scrollTo({ top: 0, behavior: 'smooth' });
                                showMsg(form, 'danger', statusText, true);
                            }, 500);
                            showNotification(statusText, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
                        }
                    }
                }
            });
        }
    }
</script>
<script>
    // Pre-loading purpose types
    @if ($i_sell_request->i_purpose_id)
        getPurposePurposeTypes([{{$i_sell_request->i_purpose_id}}], {{$i_sell_request->i_purpose_type_id}});
    @endif
</script>
<script>
    // Re-initialize select pickers
    $(".m_selectpicker").selectpicker("refresh");
</script>
