<hr>
<div class="repeater-phases form-group col-12">
    <div data-repeater-list="phases">
        <div data-repeater-item>
            <!-- innner repeater -->
            <div class="inner-repeater">
                <div data-repeater-list="translations" class="translations">
                    <div data-repeater-item class="items">
                        <div class="form-group col-12">
                            <div class="col-lg-12 d-flex flex-wrap">
                                <div class="col-lg-6 form-group">
                                    <label for="language_id">{{__('inventory::inventory.language')}}</label>
                                    <select class="form-control" id="language_id" name="language_id" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_select_the_language')}}" data-parsley-trigger="change focusout">
                                        <option value="" selected disabled>{{__('inventory::inventory.language')}}</option>
                                        @foreach ($languages as $language)
                                        <option value="{{$language->id}}" @if($language->id == 1) selected @endif>{{$language->code}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label for="phase">{{__('inventory::inventory.phase_title')}}</label>
                                    <input name="name" value="" id="phase" type="text" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_phase')}}" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_enter_the_phase')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('inventory::inventory.phase_max_is_150_characters_long')}}">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label for="phase">{{__('inventory::inventory.description')}}</label>
                                    <textarea name="description" id="phase-description-0-0" class="phase-description"></textarea>
                                    {{-- <input name="description" value="" id="phase" type="text" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_phase')}}" data-parsley-required-message="{{__('inventory::inventory.please_enter_the_phase')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="16777215" data-parsley-maxlength-message="{{__('inventory::inventory.phase_description_max_is_16777215_characters_long')}}"> --}}
                                </div>
                                <div class="col-1 mt-4">
                                    <button data-repeater-delete type="button" class="btn btn-brand h-10" value="Delete"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button data-repeater-create type="button" class="btn" value="Add"> <i class="fa fa-plus"></i> {{trans('inventory::inventory.add_image_360_trans')}}</button>
                </div>
                {{--
                <div class="col-md-2 col-sm-2">
                    <button data-repeater-delete type="button" class="btn btn-brand" value="Delete"><i class="fa fa-times"></i></button>
                </div>
                --}}
            </div>
            <div class="col-12 d-flex flex-wrap">
                <div class="col-6  form-group">
                    <label>{{trans('inventory::inventory.delivery_date')}}</label>
                    <input name="delivery_date" autocomplete="off" class="form-control datetimepicker-init" value="" placeholder="{{trans('inventory::inventory.delivery_date')}}" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.from_date_is_required')}}" data-parsley-trigger="change focusout" />
                </div>
                <div class="col-2">
                    <div class="box">
                        <label for="attachments" class="mb-4">{{__('inventory::inventory.attachments')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                        <input type="file" name="attachments" multiple class="" id="file-9" data-multiple-caption="{count} {{trans('inventory::inventory.files_selected')}}" />
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-2">
                <button data-repeater-delete type="button" class="btn btn-brand" value="Delete"><i class="fa fa-times"></i></button>
            </div>
        </div>
    </div>
    <button data-repeater-create type="button" class="btn repeater_btn_phase" value="Add"> <i class="fa fa-plus"></i> {{trans('inventory::inventory.phase')}}</button>
</div>