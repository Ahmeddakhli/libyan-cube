@extends('dashboard.layouts.basic')

@section('content')
    <!--begin::Form-->
    <form action="{{route('inventory.design_types.update')}}" method="POST" id="update_design_type_form" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="updateDesignTypeCallback" data-parsley-validate>
        @csrf
        <input type="hidden" name="id" id="id" value="{{$i_design_type->id}}" />
        <div class="m-portlet__body">
            <div class="form-group row">
                <div class="col-6">
                    {{-- <label for="order">{{__('inventory::inventory.order')}}</label> --}}
                    <input name="order" id="order" type="text" class="form-control" placeholder="{{__('inventory::inventory.order')}}"  data-parsley-trigger="change focusout" data-parsley-type="integer" data-parsley-min="0" value="{{$i_design_type->order}}">
                </div>
            </div>
           
            <div class="form-group row">
                <div class="col-12 repeater">
                    <div data-repeater-list="translations">
                        @foreach ($i_design_type->translations as $translation)
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
                                    {{-- <label for="type">{{__('inventory::inventory.design_type')}}</label> --}}
                                    <input name="type" id="type" type="text" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_design_type')}}" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_enter_the_design_type')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('inventory::inventory.design_type_max_is_150_characters_long')}}" value="{{$translation->type}}">
                                </div>
                                <div class="col-12">
                                    <label for="description">{{__('inventory::inventory.description')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                    <textarea rows="6" name="description" id="description" class="form-control" placeholder="{{__('inventory::inventory.enter_description')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295" data-parsley-maxlength-message="{{__('inventory::inventory.description_max_is_4294967295_characters_long')}}">{{$translation->description}}</textarea>
                                </div>
                                <div class="col-md-2 col-sm-2">
                                    {{-- <label class="control-label">&nbsp;</label> --}}
                                    <a href="javascript:;" data-repeater-delete class="btn btn-brand data-repeater-delete">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        @if (!$i_design_type->translations->count())
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
                                    {{-- <label for="type">{{__('inventory::inventory.design_type')}}</label> --}}
                                    <input name="type" id="type" type="text" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_design_type')}}" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_enter_the_design_type')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('inventory::inventory.design_type_max_is_150_characters_long')}}">
                                </div>
                                <div class="col-12">
                                    <label for="description">{{__('inventory::inventory.description')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                    <textarea rows="6" name="description" id="description" class="form-control" placeholder="{{__('inventory::inventory.enter_description')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295" data-parsley-maxlength-message="{{__('inventory::inventory.description_max_is_4294967295_characters_long')}}"></textarea>
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
                        <i class="fa fa-plus"></i> {{trans('inventory::inventory.add_design_type_translation')}}
                    </a>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-4">
                    <div class="row">
                        <div class="box">
                            <label for="attachments">{{__('inventory::inventory.attachments')}}</label>
                            <input type="file" name="attachments" class="inputfile inputfile-5" id="file-6" data-multiple-caption="{count} {{trans('inventory::inventory.files_selected')}}" />
                            <label for="file-6">
                                <figure><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                                        <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z" /></svg></figure> <span></span>
                            </label>
                        </div>

                    </div>
                    @foreach ($attachments as $attachment)
                        @if(!$attachment->is_deleted)
                            @if (in_array($attachment->mime_type, ['tiff', 'image/tiff', 'jpeg', 'image/jpeg', 'gif', 'image/gif', 'png', 'image/png']))
                                <div class="card" id="card-{{$attachment->id}}">
                                    <a class="html5lightbox" title="" data-group="image_group" href="{{asset('storage/'.$attachment->id.'/'.$attachment->file_name)}}" data-width="800" data-height="800" title="{{trans('inventory::inventory.view_image')}}">
                                        <img class="card-img-top" src="{{asset('storage/'.$attachment->id.'/'.$attachment->file_name)}}" alt="{{trans('inventory::inventory.image')}}">
                                    </a>
                                    @if (auth()->user()->hasPermission('delete-inventory-unit-attachment'))
                                        <div class="card-body" style="text-align: center !important;">
                                            <button type="button" class="btn btn-danger" onclick="deleteAttachment({{$attachment->id}});"><i class="fas fa-trash-alt"></i> {{trans('inventory::inventory.delete')}}</button>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-success btn-brand">{{trans('inventory::inventory.update_design_type')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

<!--end::Form-->

<!-- Callback function -->
<script>
    function updateDesignTypeCallback() {
        // Close modal
        $('#fast_modal').modal('toggle');
        // Reload datatable
        design_types_table.ajax.reload(null, false);
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