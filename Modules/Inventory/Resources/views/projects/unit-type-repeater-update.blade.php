<hr>
<h4>{{__('inventory::inventory.unit_types')}}</h4>
<div class="units_type_to_delete">

</div>
<div class="repeater-unit_types form-group col-12">
    <div data-repeater-list="unit_types">
        @if(count($i_project->unitTypes) > 0)
        @foreach($i_project->unitTypes as $unit_type)
        <div data-repeater-item>
            <!-- innner repeater -->
            <input type="hidden" name="i_unit_type_id" value="{{$unit_type->id}}">
            <div class="inner-repeater">
                <div data-repeater-list="translations">
                    @foreach($unit_type->translations as $translation)
                    <div data-repeater-item>
                        <div class="form-group col-10 d-flex flex-wrap mr-auto ml-auto">
                            <div class="col-lg-6">
                                <label for="language_id">{{__('inventory::inventory.language')}}</label>
                                <select class="form-control" id="language_id" name="language_id" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_select_the_language')}}" data-parsley-trigger="change focusout">
                                    <option value="" selected disabled>{{__('inventory::inventory.language')}}</option>
                                    @foreach ($languages as $language)
                                    <option value="{{$language->id}}" @if($translation->language_id == $language->id) selected @endif>{{$language->code}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                    <label for="unit_type">{{__('inventory::inventory.unit_type')}}</label>
                                    <input name="unit_type" id="unit_type" type="text" value="{{$translation->unit_type}}" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_unit_type')}}" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.unit_type_is_required')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('inventory::inventory.unit_type_max_is_150_characters_long')}}">
                            </div>
                            <div class="col-lg-12">
                                <label for="description">{{__('inventory::inventory.description')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                <textarea name="description" id="description" class="form-control">{{$translation->description}}</textarea>

                            </div>
                            <button data-repeater-delete type="button" class="btn btn-brand mt-3 data-repeater-delete" value="Delete"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button data-repeater-create type="button" class="btn" value="Add" style="margin-right: 8rem;margin-left: 8rem;"> <i class="fa fa-plus"></i> {{trans('inventory::inventory.unit_type_trans')}}</button>
            </div>
            <div class="col-12 d-flex flex-wrap">
                <div class="col-4">
                    <label for="image" class="row">{{__('inventory::inventory.image')}}</label>
                    <input type="file" name="image" class="form-control" id="image" data-parsley-trigger="change focusout" />
                    @if($unit_type->image)
                        <div class="col-8 mt-2 unit-image">
                            <img class="w-100 unit_type_img{{$unit_type->id}}" src="{{URL::asset('storage/'.$unit_type->image)}}" alt="{{$i_project->value}}">
                            <input type="hidden" name="delete_unit_type_image" class="delete-unit-type-input{{$unit_type->id}}" value="0">
                            <button type="button"  class="btn btn-danger mt-2 delete-unit-type" unit-id="{{$unit_type->id}}"> {{trans('inventory::inventory.delete')}}</button>
                        </div>

                    @endif
                                                 <label for="image"><strong>{{__('settings::settings.image_dimensions')}}:835 × 467 px</strong></label>

                </div>
                    <!-- Area From -->
                <div class="col-4">
                    <label for="area_from">{{__('inventory::inventory.area_from')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <input name="area_from" value="{{$unit_type->area_from}}" id="area_from" type="number" step="0.01" class="form-control" placeholder="{{__('inventory::inventory.enter_area')}}" data-parsley-trigger="change focusout">
                </div>

                <!-- Area To -->
                <div class="col-4">
                    <label for="area_to">{{__('inventory::inventory.area_to')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <input name="area_to" value="{{$unit_type->area_to}}" id="area_to" type="number" step="0.01" class="form-control" placeholder="{{__('inventory::inventory.enter_plot_area')}}" data-parsley-trigger="change focusout">
                </div>
                <!-- Price -->
                <div class="col-4">
                    <label for="price_from">{{__('inventory::inventory.price_from')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <input name="price_from" value="{{$unit_type->price_from}}" id="price_from" type="number" class="form-control" placeholder="{{__('inventory::inventory.enter_price')}}" data-parsley-trigger="change focusout">
                </div>
                <div class="col-4">
                    <label for="price_to">{{__('inventory::inventory.price_to')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <input name="price_to" value="{{$unit_type->price_to}}" id="price_to" type="number" class="form-control" placeholder="{{__('inventory::inventory.enter_price')}}" data-parsley-trigger="change focusout">
                </div>
            </div>
            <div class="col-md-2 col-sm-2">
                <button data-repeater-delete type="button" class="btn btn-brand mt-3 data-repeater-delete" value="Delete" onclick="deleteUnitType({{$unit_type->id}})"><i class="fa fa-times"></i></button>
            </div>
        </div>
        @endforeach
        @else
        <div data-repeater-item>
            <!-- innner repeater -->
            <div class="inner-repeater">
                <div data-repeater-list="translations">
                    <div data-repeater-item>
                        <div class="form-group col-12 d-flex flex-wrap mr-auto ml-auto">
                            <div class="d-flex flex-wrap col-12">
                                <div class="form-group col-lg-6">
                                    <label for="language_id">{{__('inventory::inventory.language')}}</label>
                                    <select class="form-control" id="language_id" name="language_id"  data-parsley-trigger="change focusout">
                                        <option value="" selected disabled>{{__('inventory::inventory.language')}}</option>
                                        @foreach ($languages as $language)
                                        <option value="{{$language->id}}" @if($language->id == 1) selected @endif>{{$language->code}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label for="unit_type">{{__('inventory::inventory.unit_type')}}</label>
                                    <input name="unit_type" id="unit_type" type="text" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_unit_type')}}" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.unit_type_is_required')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('inventory::inventory.unit_type_max_is_150_characters_long')}}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label for="description">{{__('inventory::inventory.description')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                <textarea name="description" id="description" class="form-control"></textarea>

                                {{-- <textarea rows="6" name="description" id="description" class="form-control" placeholder="{{__('inventory::inventory.enter_description')}}" data-parsley-maxlength="4294967295" data-parsley-maxlength-message="{{__('inventory::inventory.description_max_is_4294967295_characters_long')}}"></textarea> --}}
                            </div>
                            <button data-repeater-delete type="button" class="btn btn-brand mt-3 data-repeater-delete" value="Delete"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                </div>
                <button data-repeater-create type="button" class="btn" value="Add" style="margin-left: 8rem; margin-right: 8rem;"> <i class="fa fa-plus"></i> {{trans('inventory::inventory.unit_type_trans')}}</button>
            </div>
            <div class="col-12 d-flex flex-wrap">
                <div class="col-4">
                    <label for="image" class="row">{{__('inventory::inventory.image')}}</label>
                    <input type="file" name="image" class="form-control" id="image" data-parsley-trigger="change focusout" />
                </div>
                    <!-- Area From -->
                <div class="col-4">
                    <label for="area_from">{{__('inventory::inventory.area_from')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <input name="area_from" id="area_from" type="number" step="0.01" class="form-control" placeholder="{{__('inventory::inventory.enter_area')}}" data-parsley-trigger="change focusout">
                </div>

                <!-- Area To -->
                <div class="col-4">
                    <label for="area_to">{{__('inventory::inventory.area_to')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <input name="area_to" id="area_to" type="number" step="0.01" class="form-control" placeholder="{{__('inventory::inventory.enter_plot_area')}}" data-parsley-trigger="change focusout">
                </div>
                <!-- Price -->
                <div class="col-4">
                    <label for="price_from">{{__('inventory::inventory.price_from')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <input name="price_from" id="price_from" type="number" class="form-control" placeholder="{{__('inventory::inventory.enter_price')}}" data-parsley-trigger="change focusout">
                </div>
                <div class="col-4">
                    <label for="price_to">{{__('inventory::inventory.price_to')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <input name="price_to" id="price_to" type="number" class="form-control" placeholder="{{__('inventory::inventory.enter_price')}}" data-parsley-trigger="change focusout">
                </div>
            </div>
            <div class="col-md-2 col-sm-2">
                <button data-repeater-delete type="button" class="btn btn-brand mt-3 data-repeater-delete" value="Delete"><i class="fa fa-times"></i></button>
            </div>
        </div>
        @endif
    </div>
    <button data-repeater-create type="button" class="btn" value="Add"> <i class="fa fa-plus"></i> {{trans('inventory::inventory.unit_types')}}</button>
</div>
