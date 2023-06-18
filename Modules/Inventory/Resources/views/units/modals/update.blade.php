{{-- @extends('dashboard.layouts.basic') --}}
<link rel="stylesheet" href="{{URL::asset('8x/assets/css/upload_button.css')}}" />
<link href="{{asset('8x/assets/vendors/general/select2/dist/css/select2.css')}}" rel="stylesheet" type="text/css" />
{{-- @section('content') --}}
    <!--begin::Form-->
    <form action="{{route('inventory.units.update')}}" method="POST" id="update_unit_form" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="updateUnitCallback" data-parsley-validate>
        @csrf
        <input type="hidden" name="id" value="{{$i_unit->id}}"/>
        <div class="m-portlet__body">
            <!-- Project -->
            <div class="form-group row">
                <div class="col-6">
                    <label for="i_project_id">{{__('inventory::inventory.project')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="i_project_id" name="i_project_id" data-parsley-trigger="change focusout">
                        <option value="" selected disabled>{{__('inventory::inventory.select_project')}}</option>
                        @foreach ($projects as $project)
                            <option value="{{$project->id}}" @if ($i_unit->i_project_id == $project->id) selected @endif>{{$project->project}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Unit Number -->
            <div class="form-group row">
                <div class="col-6">
                    <label for="unit_number">{{__('inventory::inventory.unit_number')}}</label>
                    <input name="unit_number" id="unit_number" type="text" class="form-control" placeholder="{{__('inventory::inventory.enter_unit_number')}}" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.unit_number_is_required')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('inventory::inventory.unit_number_max_is_150_characters_long')}}" value="{{$i_unit->unit_number}}">
                </div>
            </div>
            <!-- Building Number -->
            <div class="form-group row">
                <div class="col-6">
                    <label for="building_number">{{__('inventory::inventory.building_number')}}</label>
                    <input name="building_number" id="building_number" type="text" class="form-control" placeholder="{{__('inventory::inventory.enter_building_number')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('inventory::inventory.building_number_max_is_150_characters_long')}}" value="{{$i_unit->building_number}}">
                </div>
            </div>
            <!-- Floor Number -->
            <div class="form-group row">
                <div class="col-6">
                    <label for="i_floor_number_id">{{__('inventory::inventory.floor_number')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="i_floor_number_id" name="i_floor_number_id" data-parsley-trigger="change focusout">
                        <option value="" selected disabled>{{__('inventory::inventory.select_floor_number')}}</option>
                        @foreach ($floor_numbers as $floor_number)
                            <option value="{{$floor_number->id}}" @if ($i_unit->i_floor_number_id == $floor_number->id) selected @endif>{{$floor_number->floor_number}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Seller -->
            <div class="form-group row">
                <div class="col-12">
                    <label class="col-12 control-label" for="seller_id">{{__('inventory::inventory.seller')}}</label>
                    <div class="col-12">
                        <input type="text" id="seller_id" name="seller_id" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.seller_is_required')}}" data-parsley-trigger="change focusout" class="form-control" data-role="tagsinput"/>
                    </div>
                </div>
            </div>
            <!-- Buyer -->
            <div class="form-group row">
                <div class="col-12">
                    <label class="col-12 control-label">{{__('inventory::inventory.buyer')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <div class="col-12">
                        <input type="text" name="buyer_id" id="buyer_id" class="form-control" data-role="tagsinput" />
                    </div>
                </div>
            </div>
            <!-- Position -->
            <div class="form-group row">
                <div class="col-6">
                    <label for="i_position_id">{{__('inventory::inventory.position')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="i_position_id" name="i_position_id" data-parsley-trigger="change focusout">
                        <option value="" selected disabled>{{__('inventory::inventory.select_position')}}</option>
                        @foreach ($positions as $position)
                            <option value="{{$position->id}}" @if ($i_unit->i_position_id == $position->id) selected @endif>{{$position->position}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- View -->
            <div class="form-group row">
                <div class="col-6">
                    <label for="i_view_id">{{__('inventory::inventory.view')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="i_view_id" name="i_view_id" data-parsley-trigger="change focusout">
                        <option value="" selected disabled>{{__('inventory::inventory.select_view')}}</option>
                        @foreach ($views as $view)
                            <option value="{{$view->id}}" @if ($i_unit->i_view_id == $view->id) selected @endif>{{$view->view}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Area Unit -->
            <div class="form-group row">
                <div class="col-6">
                    <label for="i_view_id">{{__('inventory::inventory.area_unit')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="i_area_unit_id" name="i_area_unit_id" data-parsley-trigger="change focusout">
                        <option value="" selected disabled>{{__('inventory::inventory.select_area_unit')}}</option>
                        @foreach ($area_units as $area_unit)
                            <option value="{{$area_unit->id}}" @if ($i_unit->i_area_unit_id == $area_unit->id) selected @endif>{{$area_unit->area_unit}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Area -->
            <div class="form-group row">
                <div class="col-6">
                    <label for="area">{{__('inventory::inventory.area')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <input name="area" id="area" type="number" step="0.01" class="form-control" placeholder="{{__('inventory::inventory.enter_area')}}" data-parsley-trigger="change focusout" value="{{$i_unit->area}}">
                </div>
            </div>
            <!-- Plot Area -->
            <div class="form-group row">
                <div class="col-6">
                    <label for="plot_area">{{__('inventory::inventory.plot_area')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <input name="plot_area" id="plot_area" type="number" step="0.01" class="form-control" placeholder="{{__('inventory::inventory.enter_plot_area')}}" data-parsley-trigger="change focusout" value="{{$i_unit->plot_area}}">
                </div>
            </div>
            <!-- Build Up Area -->
            <div class="form-group row">
                <div class="col-6">
                    <label for="build_up_area">{{__('inventory::inventory.build_up_area')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <input name="build_up_area" id="build_up_area" type="number" step="0.01" class="form-control" placeholder="{{__('inventory::inventory.enter_build_up_area')}}" data-parsley-trigger="change focusout" value="{{$i_unit->build_up_area}}">
                </div>
            </div>
            <!-- Garden Area Unit -->
            <div class="form-group row">
                <div class="col-6">
                    <label for="i_view_id">{{__('inventory::inventory.garden_area_unit')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="i_garden_area_unit_id" name="i_garden_area_unit_id" data-parsley-trigger="change focusout">
                        <option value="" selected disabled>{{__('inventory::inventory.select_garden_area_unit')}}</option>
                        @foreach ($area_units as $area_unit)
                            <option value="{{$area_unit->id}}" @if ($i_unit->i_garden_area_unit_id == $area_unit->id) selected @endif>{{$area_unit->area_unit}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Garden Area -->
            <div class="form-group row">
                <div class="col-6">
                    <label for="garden_area">{{__('inventory::inventory.garden_area')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <input name="garden_area" id="garden_area" type="number" step="0.01" class="form-control" placeholder="{{__('inventory::inventory.enter_garden_area')}}" data-parsley-trigger="change focusout" value="{{$i_unit->garden_area}}">
                </div>
            </div>
            <!-- Bedroom -->
            <div class="form-group row">
                <div class="col-6">
                    <label for="i_bedroom_id">{{__('inventory::inventory.bedroom')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="i_bedroom_id" name="i_bedroom_id" data-parsley-trigger="change focusout">
                        <option value="" selected disabled>{{__('inventory::inventory.select_bedroom')}}</option>
                        @foreach ($bedrooms as $bedroom)
                            <option value="{{$bedroom->id}}" @if ($i_unit->i_bedroom_id == $bedroom->id) selected @endif>{{$bedroom->bedroom}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Bathroom -->
            <div class="form-group row">
                <div class="col-6">
                    <label for="i_bathroom_id">{{__('inventory::inventory.bathroom')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="i_bathroom_id" name="i_bathroom_id" data-parsley-trigger="change focusout">
                        <option value="" selected disabled>{{__('inventory::inventory.select_bathroom')}}</option>
                        @foreach ($bathrooms as $bathroom)
                            <option value="{{$bathroom->id}}" @if ($i_unit->i_bathroom_id == $bathroom->id) selected @endif>{{$bathroom->bathroom}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Furnishing Status -->
            <div class="form-group row">
                <div class="col-6">
                    <label for="i_furnishing_status_id">{{__('inventory::inventory.furnishing_status')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="i_furnishing_status_id" name="i_furnishing_status_id" data-parsley-trigger="change focusout">
                        <option value="" selected disabled>{{__('inventory::inventory.select_furnishing_status')}}</option>
                        @foreach ($furnishing_statuses as $furnishing_status)
                            <option value="{{$furnishing_status->id}}" @if ($i_unit->i_furnishing_status_id == $furnishing_status->id) selected @endif>{{$furnishing_status->furnishing_status}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Finishing Type -->
            <div class="form-group row">
                <div class="col-6">
                    <label for="i_finishing_type_id">{{__('inventory::inventory.finishing_type')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="i_finishing_type_id" name="i_finishing_type_id" data-parsley-trigger="change focusout">
                        <option value="" selected disabled>{{__('inventory::inventory.select_finishing_type')}}</option>
                        @foreach ($finishing_types as $finishing_type)
                            <option value="{{$finishing_type->id}}" @if ($i_unit->i_finishing_type_id == $finishing_type->id) selected @endif>{{$finishing_type->finishing_type}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Purpose -->
            <div class="form-group row">
                <div class="col-6">
                    <label for="i_purpose_id">{{__('inventory::inventory.purpose')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="i_purpose_id" name="i_purpose_id" data-parsley-trigger="change focusout" onchange="getPurposePurposeTypes([$(this).find(':selected').val()])">
                        <option value="" selected disabled>{{__('inventory::inventory.select_purpose')}}</option>
                        @foreach ($purposes as $purpose)
                            <option value="{{$purpose->id}}" @if ($i_unit->i_purpose_id == $purpose->id) selected @endif>{{$purpose->purpose}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Purpose Type -->
            <div class="form-group row">
                <div class="col-6">
                    <label for="i_purpose_type_id">{{__('inventory::inventory.purpose_type')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="i_purpose_type_id" name="i_purpose_type_id" data-parsley-trigger="change focusout">
                        <option value="" selected disabled>{{__('inventory::inventory.select_purpose_type')}}</option>
{{--                                                             @foreach ($purpose_types as $purpose_type)
                            <option value="{{$purpose_type->id}}">{{$purpose_type->purpose_type}}</option>
                        @endforeach --}}
                    </select>
                </div>
            </div>
            <!-- Description -->
            <div class="form-group row">
                <div class="col-lg-12">
                    <label for="description">{{__('inventory::inventory.description')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <textarea rows="6" name="description" id="description" class="form-control" placeholder="{{__('inventory::inventory.enter_description')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295" data-parsley-maxlength-message="{{__('inventory::inventory.description_max_is_4294967295_characters_long')}}">{{$i_unit->description}}</textarea>
                </div>
            </div>
            <!-- Attachments -->
            <div class="form-group row">
                <hr>
                <!-- Attachments -->
                <div class="col-12 repeater-attachments">
                    <div data-repeater-list="attachments">
                        <div data-repeater-item class="row">
                            <div class="col-6">
                                <label for="order">{{__('inventory::inventory.order')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                <input name="order" id="order" type="number" class="form-control" placeholder="{{__('inventory::inventory.order')}}" data-parsley-trigger="change focusout">
                            </div>
                            <div class="col-lg-4">
                                {{-- <div class="form-group">
                                    <h4 class="kt-section__title kt-section__title-lg kt-margin-b-0">{{__('inventory::inventory.attachments')}}:</h4>
                                </div> --}}
                            <div class="row">
                                <div class="box">
                                    <label for="description">{{__('inventory::inventory.attachments')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                    <input type="file" name="file" class="" id="file-6" />

                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            {{-- <label class="control-label">&nbsp;</label> --}}
                            <a href="javascript:;" data-repeater-delete class="btn btn-brand data-repeater-delete">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    </div>
                    <a href="javascript:;" data-repeater-create id="repeater_btn_attachments" class="btn">
                        <i class="fa fa-plus"></i> {{trans('inventory::inventory.attachments')}}
                    </a>
                </div>
            <br>
            <!-- Floor Plans -->
            <div class="col-12 repeater-floor_plans">
                <div data-repeater-list="floorplans">
                    <div data-repeater-item class="row">
                        <div class="col-6">
                            <label for="order">{{__('inventory::inventory.order')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                            <input name="order" id="order" type="number" class="form-control" placeholder="{{__('inventory::inventory.order')}}" data-parsley-trigger="change focusout">
                        </div>
                        <div class="col-lg-4">
                            {{-- <div class="form-group">
                    <h4 class="kt-section__title kt-section__title-lg kt-margin-b-0">{{__('inventory::inventory.floor_plans')}}:</h4>
                        </div> --}}
                        <div class="row">
                            <div class="box">
                                <label for="description">{{__('inventory::inventory.floor_plans')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                <input type="file" name="file" class="" id="file-6" />

                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2">
                        {{-- <label class="control-label">&nbsp;</label> --}}
                        <a href="javascript:;" data-repeater-delete class="btn btn-brand data-repeater-delete">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                </div>
                <a href="javascript:;" data-repeater-create id="repeater_btn_floor_plans" class="btn">
                    <i class="fa fa-plus"></i> {{trans('inventory::inventory.floor_plans')}}
                </a>
            </div>
        <br>
        <!-- Master Plans -->
        <div class="col-12 repeater-master_plans">
            <div data-repeater-list="masterplans">
                <div data-repeater-item class="row">
                    <div class="col-6">
                        <label for="order">{{__('inventory::inventory.order')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                        <input name="order" id="order" type="number" class="form-control" placeholder="{{__('inventory::inventory.order')}}" data-parsley-trigger="change focusout">
                    </div>
                    <div class="col-lg-4">
                        {{-- <div class="form-group">
                    <h4 class="kt-section__title kt-section__title-lg kt-margin-b-0">{{__('inventory::inventory.master_plans')}}:</h4>
                    </div> --}}
                    <div class="row">
                        <div class="box">
                            <label for="description">{{__('inventory::inventory.master_plans')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                            <input type="file" name="file" class="" id="file-6" />

                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-2">
                    {{-- <label class="control-label">&nbsp;</label> --}}
                    <a href="javascript:;" data-repeater-delete class="btn btn-brand data-repeater-delete">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            </div>
            <a href="javascript:;" data-repeater-create id="repeater_btn_master_plans" class="btn">
                <i class="fa fa-plus"></i> {{trans('inventory::inventory.master_plans')}}
            </a>
        </div>
                                        <!-- Images -->
        <div class="form-group d-flex flex-wrap">
            <div class="m-form__group col-12 ">
                <label for="attachment" class="h3">{{trans('inventory::inventory.attachments')}}</label>
                <div class="card-columns" id="attachment">
                    @foreach ($i_unit->attachmentables as $attachment)
                    @if($attachment->type == 'attachment')
                    <div class="card" id="card-{{$attachment->id}}">
                        <a class="html5lightbox" title="" data-group="image_group" href="#" data-width="1200" data-height="1200" title="{{trans('inventory::inventory.view_image')}}">
                            <img class="card-img-top" src="{{asset('storage/'.$attachment->path)}}" alt="{{trans('inventory::inventory.image')}}">
                        </a>
                        <div class="card-body" style="text-align: center !important;">
                            <button type="button" class="btn btn-danger" onclick="deleteAttachmentables({{$attachment->id}});"><i class="fas fa-trash-alt"></i> {{trans('inventory::inventory.delete')}}</button>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            <div class="m-form__group col-12 row">
                <label for="floorplans" class="h3">{{trans('inventory::inventory.floor_plans')}}</label>
                <div class="card-columns" id="floorplans">
                    @foreach ($i_unit->attachmentables as $attachment)
                    @if($attachment->type == 'floorplan')
                    <div class="card" id="card-{{$attachment->id}}">
                        <a class="html5lightbox" title="" data-group="image_group" href="#" data-width="1200" data-height="1200" title="{{trans('inventory::inventory.view_image')}}">
                            <img class="card-img-top" src="{{asset('storage/'.$attachment->path)}}" alt="{{trans('inventory::inventory.image')}}">
                        </a>
                        <div class="card-body" style="text-align: center !important;">
                            <button type="button" class="btn btn-danger" onclick="deleteAttachmentables({{$attachment->id}});"><i class="fas fa-trash-alt"></i> {{trans('inventory::inventory.delete')}}</button>
                        </div>

                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            <div class="m-form__group col-12 ">
                <label for="masterplans" class="h3">{{trans('inventory::inventory.master_plans')}}</label>
                <div class="card-columns" id="masterplans">
                    @foreach ($i_unit->attachmentables as $attachment)
                    @if($attachment->type == 'masterplan')
                    <div class="card" id="card-{{$attachment->id}}">
                        <a class="html5lightbox" title="" data-group="image_group" href="#" data-width="1200" data-height="1200" title="{{trans('inventory::inventory.view_image')}}">
                            <img class="card-img-top" src="{{asset('storage/'.$attachment->path)}}" alt="{{trans('inventory::inventory.image')}}">
                        </a>
                        <div class="card-body" style="text-align: center !important;">
                            <button type="button" class="btn btn-danger" onclick="deleteAttachmentables({{$attachment->id}});"><i class="fas fa-trash-alt"></i> {{trans('inventory::inventory.delete')}}</button>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
            <!-- Country -->
            <div class="form-group row">
                <div class="col-4">
                    <label for="country_id">{{__('inventory::inventory.country')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="country_id" name="country_id" data-parsley-trigger="change focusout" onchange="getCountryRegions($(this).find(':selected').val())">
                        <option value="" selected disabled>{{__('inventory::inventory.select_country')}}</option>
                        @foreach ($countries as $country)
                            <option value="{{$country->id}}" @if ($i_unit->country_id == $country->id) selected @endif>{{$country->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Region -->
            <div class="form-group row">
                <div class="col-4">
                    <label for="region_id">{{__('inventory::inventory.region')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="region_id" name="region_id" data-parsley-trigger="change focusout" onchange="getRegionCities($(this).find(':selected').val())">
                        <option value="" selected disabled>{{__('inventory::inventory.select_region')}}</option>
{{--                                                             @foreach ($regions as $region)
                            <option value="{{$region->id}}">{{$region->name}}</option>
                        @endforeach --}}
                    </select>
                </div>
            </div>
            <!-- City -->
            <div class="form-group row">
                <div class="col-4">
                    <label for="city_id">{{__('inventory::inventory.city')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="city_id" name="city_id" data-parsley-trigger="change focusout">
                        <option value="" selected disabled>{{__('inventory::inventory.select_city')}}</option>
{{--                                                             @foreach ($cities as $city)
                            <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach --}}
                    </select>
                </div>
            </div>
            <!-- Address -->
            <div class="form-group row">
                    <div class="col-lg-12">
                        <label>{{__('inventory::inventory.address')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                        <input name="address" id="address" class="form-control" placeholder="{{__('inventory::inventory.enter_address')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="191" data-parsley-maxlength-message="{{__('inventory::inventory.address_max_is_16777215_characters_long')}}" value="{{$i_unit->address}}" />
                    </div>
                </div>
            </div>
            <!-- Map -->
            <div class="form-group row">
                <div class="col-lg-12">
                    <label>{{__('inventory::inventory.location')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <input id="map_search" name="map_search"  class="form-control" type="text" placeholder="{{__('inventory::inventory.enter_a_location')}}">
                    <div id="map" style="height:300px; width:100%;"></div>
                    <input id="lat" name="latitude" type="hidden" value="" />
                    <input id="lng" name="longitude" type="hidden" value="" />
                </div>
            </div>
            <!-- Offering Type -->
            <div class="form-group row">
                <div class="col-6">
                    <label for="i_offering_type_id">{{__('inventory::inventory.offering_type')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="i_offering_type_id" name="i_offering_type_id" data-parsley-trigger="change focusout">
                        <option value="" selected disabled>{{__('inventory::inventory.select_offering_type')}}</option>
                        @foreach ($offering_types as $offering_type)
                            <option value="{{$offering_type->id}}" @if ($i_unit->i_offering_type_id == $offering_type->id) selected @endif>{{$offering_type->offering_type}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Payment Method -->
            <div class="form-group row">
                <div class="col-6">
                    <label for="i_payment_method_id">{{__('inventory::inventory.payment_method')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="i_payment_method_id" name="i_payment_method_id" data-parsley-trigger="change focusout">
                        <option value="" selected disabled>{{__('inventory::inventory.select_payment_method')}}</option>
                        @foreach ($payment_methods as $payment_method)
                            <option value="{{$payment_method->id}}" @if ($i_unit->i_payment_method_id == $payment_method->id) selected @endif>{{$payment_method->payment_method}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Currency Code -->
            <div class="form-group row">
                <div class="col-lg-6">
                    <label for="currency_code">{{__('inventory::inventory.currency_code')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="currency_code" name="currency_code" data-parsley-trigger="change focusout">
                        <option value="" selected disabled>{{trans('inventory::inventory.select_currency_code')}}</option>
                        @for ($i = 0; $i < count($currency_codes); $i++)
                            <option value="{{$currency_codes[$i]}}" @if ($i_unit->currency_code == $currency_codes[$i]) selected @endif>{{$currency_codes[$i]}}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <!-- Down Payment -->
            <div class="form-group row">
                <div class="col-6">
                    <label for="down_payment">{{__('inventory::inventory.down_payment')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <input name="down_payment" id="down_payment" type="number" class="form-control" placeholder="{{__('inventory::inventory.enter_down_payment')}}" data-parsley-trigger="change focusout" value="{{$i_unit->down_payment}}">
                </div>
            </div>
            <!-- Price -->
            <div class="form-group row">
                <div class="col-6">
                    <label for="price">{{__('inventory::inventory.price')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <input name="price" id="price" type="number" class="form-control" placeholder="{{__('inventory::inventory.enter_price')}}" data-parsley-trigger="change focusout" value="{{$i_unit->price}}">
                </div>
            </div>
            <!-- Number of Installments -->
            <div class="form-group row">
                <div class="col-6">
                    <label for="number_of_installments">{{__('inventory::inventory.number_of_installments')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <input name="number_of_installments" id="number_of_installments" type="number" class="form-control" placeholder="{{__('inventory::inventory.enter_number_of_installments')}}" data-parsley-trigger="change focusout" value="{{$i_unit->number_of_installments}}">
                </div>
            </div>
            <!-- Facilities -->
            <div class="form-group row">
                <div class="col-12">
                    <label for="facilities">{{__('inventory::inventory.facilities')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <select class="form-control m-select2" id="facilities" name="facilities[]"  data-parsley-trigger="change focusout" multiple="multiple">
                        @foreach ($facilities as $facility)
                            <option value="{{$facility->id}}" @if (in_array($facility->id, $i_unit->facilities->pluck('id')->toArray())) selected @endif>{{$facility->facility}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Amenities -->
            <div class="form-group row">
                <div class="col-12">
                    <label for="amenities">{{__('inventory::inventory.amenities')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <select class="form-control m-select2" id="amenities" name="amenities[]" multiple="multiple">
                        @foreach ($amenities as $amenity)
                            <option value="{{$amenity->id}}" @if (in_array($amenity->id, $i_unit->amenities->pluck('id')->toArray())) selected @endif>{{$amenity->amenity}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
             <div class="col-2">
                                     <label for="is_featured">{{__('inventory::inventory.is_featured')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                     <input name="is_featured" id="is_featured" type="checkbox" class="form-control" @if($i_unit->is_featured == 1) checked="checked"@endif data-parsley-trigger="change focusout">
                                 </div>
        </div>
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-success btn-brand">{{trans('inventory::inventory.update_unit')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
{{-- @endsection --}}

<!--end::Form-->

@push('scripts')
    <!-- Callback function -->
    <script>
	    function updateUnitCallback() {
	        // Close modal
	     $('#vcxl_modal').modal('toggle');
	        var units_table = $('#units_table').DataTable();
	        units_table.ajax.reload(null, false);
	    }
    </script>
    @include('inventory::units.update-scripts')
@endpush