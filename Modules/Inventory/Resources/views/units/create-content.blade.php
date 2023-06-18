@include('dashboard.components.fast_modal')
@include('dashboard.styles.custom')
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title" data-8xloadtitle>{{__('inventory::inventory.create_unit')}}</h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="{{route('home')}}" class="kt-subheader__breadcrumhome"><i class="fa fa-home"></i></a>
                <span class="kt-subheader__breadcrumseparator">/</span>

                <a href="{{route('inventory.units.index')}}" data-8xload class="kt-subheader__breadcrumlink">{{__('inventory::inventory.units')}}</a>
                <span class="kt-subheader__breadcrumseparator"></span>

                <!-- <span class="kt-subheader__breadcrumlink kt-subheader__breadcrumlink--active">{{__('inventory::inventory.create_unit')}}</span> -->
            </div>
        </div>
    </div>
    <!-- end:: Subheader -->

    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Portlet-->
                <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">{{__('inventory::inventory.create_unit')}}</h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <a href="{{url()->previous()}}" class="btn btn-clean kt-margin-r-10">
                                <i class="la la-arrow-left"></i>
                                <span class="kt-hidden-mobile">{{__('main.back')}}</span>
                            </a>
                        </div>
                    </div>


                    <div class="kt-portlet__body">
                        <!-- Create Unit Form -->
                        <form action="{{route('inventory.units.store')}}" data-async data-set-autofocus method="POST" id="create_unit_form" class="kt-form" data-parsley-validate enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="creation_type" id="creation_type">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="unit_information-tab" data-toggle="tab" data-target="#unit_information" type="button" role="tab" aria-controls="unit_information" aria-selected="true">{{__('inventory::inventory.unit_information')}}</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="location-info-tab" data-toggle="tab" data-target="#location-info" type="button" role="tab" aria-controls="location-info" aria-selected="false">{{__('inventory::inventory.location_information')}}</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="attachment-tab" data-toggle="tab" data-target="#attachment" type="button" role="tab" aria-controls="attachment" aria-selected="false">{{__('inventory::inventory.attachments')}}</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="financial_information-tab" data-toggle="tab" data-target="#financial_information" type="button" role="tab" aria-controls="financial_information" aria-selected="false">{{__('inventory::inventory.financial_information')}}</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="payment_plans-tab" data-toggle="tab" data-target="#payment_plans" type="button" role="tab" aria-controls="payment_plans" aria-selected="false">{{__('inventory::inventory.payment_plans')}}</button>
                                                </li>
                                            </ul>

                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="unit_information" role="tabpanel" aria-labelledby="unit_information-tab">

                                                    <div class="form-group row">
                                                        <div class="fancy-checkbox col-4">
                                                            <input name="is_featured" id="is_featured" type="checkbox">
                                                            <label for="is_featured">{{__('inventory::inventory.is_featured')}}</label>
                                                        </div>
                                                        <div class="fancy-checkbox col-4">
                                                            <input name="is_active" id="is_active" type="checkbox">
                                                            <label for="is_active">{{__('inventory::inventory.is_active')}}</label>
                                                        </div>
                                                        <div class="fancy-checkbox col-4">
                                                            <input name="ready_to_move" id="ready_to_move" type="checkbox">
                                                            <label for="ready_to_move">{{__('main.ready_to_move')}}</label>
                                                        </div>
                                                        <!-- Unit Number -->
                                                        <!-- <div class="col-4 my-3">
                                                            <label for="unit_number">{{__('inventory::inventory.unit_number')}}</label>
                                                            <input name="unit_number" id="unit_number" type="text" class="form-control" placeholder="{{__('inventory::inventory.enter_unit_number')}}" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.unit_number_is_required')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('inventory::inventory.unit_number_max_is_150_characters_long')}}">
                                                        </div> -->
                                                        <!-- Project -->
                                                        <div class="col-4 my-3">
                                                            <label class="col-12 control-label" for="i_project_id">{{__('inventory::inventory.project')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <div class="col-12">
                                                                <input type="text" id="i_project_id" name="i_project_id" data-parsley-trigger="change focusout" class="form-control" data-role="tagsinput" />
                                                            </div>
                                                        </div>
                                                        <div class="col-4 my-3">
                                                            <label for="unit_types">{{__('inventory::inventory.unit_types')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <select class="form-control selectpicker" data-live-search="true" id="unit_types" name="i_unit_type_id" data-parsley-trigger="change focusout">
                                                                <option value="" selected disabled>{{__('inventory::inventory.unit_type')}}</option>

                                                            </select>
                                                        </div>
                                                        <!-- Offering Type -->
                                                        <div class="col-4 my-3">
                                                            <label for="i_offering_type_id">{{__('inventory::inventory.offering_type')}}</label>
                                                            <select class="form-control selectpicker" data-live-search="true" id="i_offering_type_id" name="i_offering_type_id" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.offering_type')}}" data-parsley-trigger="change focusout" data-parsley-errors-container="#offering_type_container">
                                                                <option value="" selected disabled>{{__('inventory::inventory.select_offering_type')}}</option>
                                                                @foreach ($offering_types as $offering_type)
                                                                <option value="{{$offering_type->id}}">{{$offering_type->offering_type}}</option>
                                                                @endforeach
                                                            </select>
                                                            <div id="offering_type_container" class="error_container"></div>
                                                        </div>
                                                        <!-- Seller -->
                                                        <div class="col-4 my-3">
                                                            <label class="col-12 control-label" for="seller_id">{{__('inventory::inventory.seller')}}<small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <div class="col-12">
                                                                <input type="text" id="seller_id" name="seller_id" data-parsley-trigger="change focusout" class="form-control" data-role="tagsinput" />
                                                            </div>
                                                        </div>
                                                        <!-- Buyer -->
                                                        <!-- <div class="col-6">
                                                            <label class="col-12 control-label">{{__('inventory::inventory.buyer')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <div class="col-12">
                                                                <input type="text" name="buyer_id" id="buyer_id" class="form-control" data-role="tagsinput" />
                                                            </div>
                                                        </div> -->

                                                        <!-- Floor Number -->
                                                        <!-- <div class="col-4 my-3">
                                                            <label for="i_floor_number_id">{{__('inventory::inventory.floor_number')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <select class="form-control selectpicker" data-live-search="true" id="i_floor_number_id" name="i_floor_number_id" data-parsley-trigger="change focusout">
                                                                <option value="" selected disabled>{{__('inventory::inventory.select_floor_number')}}</option>
                                                                @foreach ($floor_numbers as $floor_number)
                                                                <option value="{{$floor_number->id}}">{{$floor_number->floor_number}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div> -->

                                                        <!-- Building Number -->
                                                        <!-- <div class="col-8">
                                                            <label for="building_number">{{__('inventory::inventory.building_number')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <input name="building_number" id="building_number" type="text" class="form-control" placeholder="{{__('inventory::inventory.enter_building_number')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('inventory::inventory.building_number_max_is_150_characters_long')}}">
                                                        </div> -->

                                                        <!-- Position -->
                                                        <!-- <div class="col-4 my-3">
                                                            <label for="i_position_id">{{__('inventory::inventory.position')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <select class="form-control selectpicker" data-live-search="true" id="i_position_id" name="i_position_id" data-parsley-trigger="change focusout">
                                                                <option value="" selected disabled>{{__('inventory::inventory.select_position')}}</option>
                                                                @foreach ($positions as $position)
                                                                <option value="{{$position->id}}">{{$position->position}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div> -->

                                                        <!-- View -->
                                                        <!-- <div class="col-4 my-3">
                                                            <label for="i_view_id">{{__('inventory::inventory.view')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <select class="form-control selectpicker" data-live-search="true" id="i_view_id" name="i_view_id" data-parsley-trigger="change focusout">
                                                                <option value="" selected disabled>{{__('inventory::inventory.select_view')}}</option>
                                                                @foreach ($views as $view)
                                                                <option value="{{$view->id}}">{{$view->view}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div> -->

                                                        <!-- Area Unit -->
                                                        <div class="col-4 my-3">
                                                            <label for="i_view_id">{{__('inventory::inventory.area_unit')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <select class="form-control selectpicker" data-live-search="true" id="i_area_unit_id" name="i_area_unit_id" data-parsley-trigger="change focusout">
                                                                <option value="" selected disabled>{{__('inventory::inventory.select_area_unit')}}</option>
                                                                @foreach ($area_units as $area_unit)
                                                                <option value="{{$area_unit->id}}">{{$area_unit->area_unit}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-4 my-3">
                                                            <label for="area">{{__('inventory::inventory.area')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <input name="area" id="area" type="number" step="0.01" class="form-control" placeholder="{{__('inventory::inventory.enter_area')}}" data-parsley-trigger="change focusout">
                                                        </div>
                                                        <div class="col-4 my-3">
                                                            <label for="i_furnishing_status_id">{{__('inventory::inventory.furnishing_status')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <select class="form-control selectpicker" data-live-search="true" id="i_furnishing_status_id" name="i_furnishing_status_id" data-parsley-trigger="change focusout">
                                                                <option value="" selected disabled>{{__('inventory::inventory.select_furnishing_status')}}</option>
                                                                @foreach ($furnishing_statuses as $furnishing_status)
                                                                <option value="{{$furnishing_status->id}}">{{$furnishing_status->furnishing_status}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <!-- <div class="form-group row"> -->
                                                        <!-- Area -->
                                                        <!-- Roof area -->
                                                        <!-- <div class="col-4 my-3">
                                                            <label for="roof_area">{{__('inventory::inventory.roof_area')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <input name="roof_area" id="roof_area" type="number" step="0.01" class="form-control" placeholder="{{__('inventory::inventory.enter_roof_area')}}" data-parsley-trigger="change focusout">
                                                        </div> -->
                                                        <!-- Terrace area -->
                                                        <!-- <div class="col-4 my-3">
                                                            <label for="terrace_area">{{__('inventory::inventory.terrace_area')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <input name="terrace_area" id="terrace_area" type="number" step="0.01" class="form-control" placeholder="{{__('inventory::inventory.enter_terrace_area')}}" data-parsley-trigger="change focusout">
                                                        </div> -->

                                                        <!-- Plot Area -->
                                                        <!-- <div class="col-4 my-3">
                                                            <label for="plot_area">{{__('inventory::inventory.plot_area')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <input name="plot_area" id="plot_area" type="number" step="0.01" class="form-control" placeholder="{{__('inventory::inventory.enter_plot_area')}}" data-parsley-trigger="change focusout">
                                                        </div> -->

                                                        <!-- Build Up Area -->
                                                        <!-- <div class="col-4 my-3">
                                                            <label for="build_up_area">{{__('inventory::inventory.build_up_area')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <input name="build_up_area" id="build_up_area" step="0.01" type="number" class="form-control" placeholder="{{__('inventory::inventory.enter_build_up_area')}}" data-parsley-trigger="change focusout">
                                                        </div> -->
                                                        <!-- </div> -->

                                                        <!-- <div class="form-group row"> -->
                                                        <!-- Garden Area Unit -->
                                                        <!-- <div class="col-4 my-3">
                                                            <label for="i_view_id">{{__('inventory::inventory.garden_area_unit')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <select class="form-control selectpicker" data-live-search="true" id="i_garden_area_unit_id" name="i_garden_area_unit_id" data-parsley-trigger="change focusout">
                                                                <option value="" selected disabled>{{__('inventory::inventory.select_garden_area_unit')}}</option>
                                                                @foreach ($area_units as $area_unit)
                                                                <option value="{{$area_unit->id}}">{{$area_unit->area_unit}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div> -->

                                                        <!-- Garden Area -->
                                                        <!-- <div class="col-4 my-3">
                                                            <label for="garden_area">{{__('inventory::inventory.garden_area')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <input name="garden_area" id="garden_area" type="number" step="0.01" class="form-control" placeholder="{{__('inventory::inventory.enter_garden_area')}}" data-parsley-trigger="change focusout">
                                                        </div> -->
                                                        <!-- </div> -->

                                                        <!-- Bedroom -->
                                                        <div class="col-4 my-3">
                                                            <label for="i_bedroom_id">{{__('inventory::inventory.bedroom')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <select class="form-control selectpicker" data-live-search="true" id="i_bedroom_id" name="i_bedroom_id" data-parsley-trigger="change focusout">
                                                                <option value="" selected disabled>{{__('inventory::inventory.select_bedroom')}}</option>
                                                                @foreach ($bedrooms as $bedroom)
                                                                <option value="{{$bedroom->id}}">{{$bedroom->bedroom}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <!-- Bathroom -->
                                                        <div class="col-4 my-3">
                                                            <label for="i_bathroom_id">{{__('inventory::inventory.bathroom')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <select class="form-control selectpicker" data-live-search="true" id="i_bathroom_id" name="i_bathroom_id" data-parsley-trigger="change focusout">
                                                                <option value="" selected disabled>{{__('inventory::inventory.select_bathroom')}}</option>
                                                                @foreach ($bathrooms as $bathroom)
                                                                <option value="{{$bathroom->id}}">{{$bathroom->bathroom}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <!-- Furnishing Status -->

                                                        <!-- Finishing Type -->
                                                        <div class="col-4 my-3">
                                                            <label for="i_finishing_type_id">{{__('inventory::inventory.finishing_type')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <select class="form-control selectpicker" data-live-search="true" id="i_finishing_type_id" name="i_finishing_type_id" data-parsley-trigger="change focusout">
                                                                <option value="" selected disabled>{{__('inventory::inventory.select_finishing_type')}}</option>
                                                                @foreach ($finishing_types as $finishing_type)
                                                                <option value="{{$finishing_type->id}}">{{$finishing_type->finishing_type}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <!-- design Type -->
                                                        <!-- <div class="col-4 my-3">
                                                            <label for="i_design_type_id">{{__('inventory::inventory.design_type')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <select class="form-control selectpicker" data-live-search="true" id="i_design_type_id" name="i_design_type_id" data-parsley-trigger="change focusout">
                                                                <option value="" selected disabled>{{__('inventory::inventory.select_design_type')}}</option>
                                                                @foreach ($design_types as $design_type)
                                                                <option value="{{$design_type->id}}">{{$design_type->type}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div> -->


                                                        <!-- Purpose -->
                                                        <div class="col-4 my-3">
                                                            <label for="i_purpose_id">{{__('inventory::inventory.purpose')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <select class="form-control selectpicker" data-live-search="true" id="i_purpose_id" name="i_purpose_id" data-parsley-trigger="change focusout" onchange="getPurposePurposeTypes([$(this).find(':selected').val()])">
                                                                <option value="" selected disabled>{{__('inventory::inventory.select_purpose')}}</option>
                                                                @foreach ($purposes as $purpose)
                                                                <option value="{{$purpose->id}}">{{$purpose->purpose}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <!-- Purpose Type -->
                                                        <div class="col-4 my-3">
                                                            <label for="i_purpose_type_id">{{__('inventory::inventory.purpose_type')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <select class="form-control selectpicker" data-live-search="true" id="i_purpose_type_id" name="i_purpose_type_id" data-parsley-trigger="change focusout">
                                                                <option value="" selected disabled>{{__('inventory::inventory.select_purpose_type')}}</option>
                                                                {{-- @foreach ($purpose_types as $purpose_type)
                                                                <option value="{{$purpose_type->id}}">{{$purpose_type->purpose_type}}</option>
                                                                @endforeach --}}
                                                            </select>
                                                        </div>
                                                        <!-- Facilities -->
                                                        <div class="col-4 my-3">
                                                            <label for="facilities">{{__('inventory::inventory.facilities')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <select class="form-control selectpicker" id="facilities" name="facilities[]" data-parsley-trigger="change focusout" multiple="multiple">
                                                                @foreach ($facilities as $facility)
                                                                <option value="{{$facility->id}}">{{$facility->facility}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <!-- Facilities -->

                                                        <!-- Amenities -->
                                                        <div class="col-4 my-3">
                                                            <label for="amenities">{{__('inventory::inventory.amenities')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <select class="form-control selectpicker" id="amenities" name="amenities[]" multiple="multiple">
                                                                @foreach ($amenities as $amenity)
                                                                <option value="{{$amenity->id}}">{{$amenity->amenity}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-4 my-3">
                                                            <label for="tags">{{__('inventory::inventory.tags')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <select class="form-control selectpicker" id="tags" name="tags[]" data-parsley-trigger="change focusout" multiple="multiple">
                                                                @foreach ($tags as $tag)
                                                                <option value="{{$tag->id}}">{{$tag->tag}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-12 repeater">
                                                            <div data-repeater-list="translations">
                                                                <div data-repeater-item class="row">
                                                                    <div class="col-6 form-group">
                                                                        <label for="language_id">{{__('inventory::inventory.language')}}</label>
                                                                        <select class="form-control" id="language_id" name="language_id" data-parsley-trigger="change focusout">
                                                                            <option value="" selected disabled>{{__('inventory::inventory.language')}}</option>
                                                                            @foreach ($languages as $language)
                                                                            <option value="{{$language->id}}" @if($language->id == 1) selected @endif>{{$language->code}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <!-- Address -->
                                                                    <div class="col-6">
                                                                        <label for="address">{{__('inventory::inventory.address')}}</label>
                                                                        <input name="address" id="address" type="text" class="form-control" placeholder="{{__('inventory::inventory.enter_address')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="191" data-parsley-maxlength-message="{{__('inventory::inventory.address_max_is_16777215_characters_long')}}">
                                                                    </div>
                                                                    <!-- Title -->
                                                                    <div class="col-6">
                                                                        <label for="title">{{__('inventory::inventory.title')}}</label>
                                                                        <input name="title" id="title" type="text" class="form-control" placeholder="{{__('inventory::inventory.enter_title')}}" data-parsley-trigger="change focusout" data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_enter_the_title')}}">
                                                                    </div>
                                                                    <!-- Description -->
                                                                    <div class="col-lg-12">
                                                                        <label for="description">{{__('inventory::inventory.description')}}</label>
                                                                        <textarea name="description" id="description-0" class="description"></textarea>

                                                                        {{-- <textarea rows="6" name="description" id="description" class="form-control" placeholder="{{__('inventory::inventory.enter_description')}}" data-parsley-maxlength="4294967295" data-parsley-maxlength-message="{{__('inventory::inventory.description_max_is_4294967295_characters_long')}}"></textarea> --}}
                                                                    </div>
                                                                    <div class="col-6 mt-2">
                                                                        <label for="meta_title">{{__('inventory::inventory.meta_title')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                                        <input name="meta_title" id="meta_title" type="text" class="form-control" placeholder="{{__('inventory::inventory.meta_title')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('inventory::inventory.title_max_is_150_characters_long')}}">
                                                                    </div>
                                                                    <div class="col-lg-6 mt-2">
                                                                        <label for="meta_description">{{__('inventory::inventory.meta_description')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                                        <textarea rows="6" name="meta_description" id="meta_description" class="form-control" placeholder="{{__('inventory::inventory.meta_description')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295" data-parsley-maxlength-message="{{__('inventory::inventory.description_max_is_4294967295_characters_long')}}"></textarea>
                                                                    </div>
                                                                    <div class="col-md-2 col-sm-2 my-3">
                                                                        {{-- <label class="control-label">&nbsp;</label> --}}
                                                                        <a href="javascript:;" data-repeater-delete class="btn btn-brand data-repeater-delete my-3">
                                                                            <i class="fa fa-times"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <a href="javascript:;" data-repeater-create id="repeater_btn" class="btn btn-brand">
                                                                <i class="fa fa-plus"></i> {{trans('inventory::inventory.unit_trans')}}
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="location-info" role="tabpanel" aria-labelledby="location-info-tab">
                                                    <div class="form-group row">

                                                        <!-- Country -->
                                                        <div class="col-4 my-3">
                                                            <label for="country_id">{{__('inventory::inventory.country')}}</label>
                                                            <select class="form-control selectpicker" data-live-search="true" id="country_id" name="country_id" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_select_the_country')}}" data-parsley-errors-container="#country_errors"  data-parsley-trigger="change focusout" onchange="if($(this).val().length > 0){getCountryRegions($(this).find(':selected').val())}">
                                                                <option value="" selected disabled>{{__('inventory::inventory.select_country')}}</option>
                                                                @foreach ($countries as $country)
                                                                <option value="{{$country->id}}">{{$country->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            <div id="country_errors"></div>

                                                        </div>

                                                        <!-- Region -->
                                                        <div class="col-4 my-3">
                                                            <label for="region_id">{{__('inventory::inventory.region')}}</label>
                                                            <select class="form-control selectpicker" data-live-search="true" id="region_id" name="region_id" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_select_the_region')}}" data-parsley-errors-container="#region_errors" data-parsley-trigger="change focusout" onchange="if($(this).val().length > 0){getRegionCities($(this).find(':selected').val())}">
                                                                <option value="" selected disabled>{{__('inventory::inventory.select_region')}}</option>
                                                                {{-- @foreach ($regions as $region)
                                                                <option value="{{$region->id}}">{{$region->name}}</option>
                                                                @endforeach --}}
                                                            </select>
                                                            <div id="region_errors"></div>

                                                        </div>

                                                        <!-- City -->
                                                        <div class="col-4 my-3">
                                                            <label for="city_id">{{__('inventory::inventory.city')}}</label>
                                                            <select class="form-control selectpicker" data-live-search="true" id="city_id" name="city_id" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_select_the_city')}}" data-parsley-errors-container="#city_errors" data-parsley-trigger="change focusout" onchange="if($(this).val().length > 0){getCityAreas($(this).find(':selected').val())}">
                                                                <option value="" selected disabled>{{__('inventory::inventory.select_city')}}</option>
                                                                {{-- @foreach ($cities as $city)
                                                                <option value="{{$city->id}}">{{$city->name}}</option>
                                                                @endforeach --}}
                                                            </select>
                                                             <div id="city_errors"></div>

                                                        </div>
                                                        <div class="col-4 my-3">
                                                            <label for="area_id">{{__('inventory::inventory.area')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <select class="form-control selectpicker" data-live-search="true" id="area_id" name="area_id" data-parsley-trigger="change focusout">
                                                                <option value="" selected disabled>{{__('inventory::inventory.select_area')}}</option>

                                                            </select>
                                                        </div>
                                                        <!-- Map -->
                                                        <div class="col-lg-12">
                                                            <label>{{__('inventory::inventory.location')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <input id="map_search" name="map_search" class="form-control" type="text" placeholder="{{__('inventory::inventory.enter_a_location')}}">
                                                            <div id="map" style="height:300px; width:100%;"></div>
                                                            <input id="lat" name="latitude" type="hidden" value="" />
                                                            <input id="lng" name="longitude" type="hidden" value="" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="attachment" role="tabpanel" aria-labelledby="attachment-tab">
                                                    <div class="form-group row">
                                                        <div class="col-4 my-3 mb-3">
                                                            <label for="video">{{__('inventory::inventory.video')}}</label> - <small>{{__('settings::settings.embed')}}</small>
                                                            <textarea name="video" class="form-control" id="video" data-parsley-trigger="change focusout"></textarea>
                                                        </div>
                                                        <div class="col-8 my-3 mb3">
                                                            <div class="form-group">
                                                                <label for="attachments">{{__('inventory::inventory.attachments')}}</label>
                                                                {{-- <input type="file" name="attachments[][file]" multiple class="form-control" id="attachments" data-parsley-trigger="change focusout" /> --}}
                                                                <div class="input-attachments" style="padding-top: .5rem;"></div>
                                                            </div>

                                                            <label for="image"><strong>{{__('settings::settings.image_dimensions')}}:800 × 600 px</strong></label>

                                                        </div>

                                                        <!-- Floor Plans -->
                                                        <div class="col-6 repeater-floor_plans">
                                                            <div class="form-group">
                                                                <h4 class="kt-section__title kt-section__title-lg kt-margin-b-0">{{__('inventory::inventory.floor_plans')}}:</h4>
                                                            </div>
                                                            <div data-repeater-list="floorplans">
                                                                <div data-repeater-item class="row">
                                                                    <div class="col-6">
                                                                        <label for="order">{{__('inventory::inventory.order')}}</label>
                                                                        <input name="order" id="order" type="number" class="form-control" placeholder="{{__('inventory::inventory.order')}}" data-parsley-trigger="change focusout">
                                                                    </div>
                                                                    <div class="col-4 my-3">

                                                                        <div class="row">
                                                                            <div class="box">
                                                                                <label for="floor_plans">{{__('inventory::inventory.floor_plans')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                                                <input type="file" name="file" class="" id="floor_plans" data-parsley-trigger="change focusout" />
                                                                                <label for="image"><strong>{{__('settings::settings.image_dimensions')}}:310 × 300 px</strong></label>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2 col-sm-2 my-3">
                                                                        <a href="javascript:;" data-repeater-delete class="btn btn-brand data-repeater-delete my-3">
                                                                            <i class="fa fa-times"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <a href="javascript:;" data-repeater-create id="repeater_btn_floor_plans" class="btn">
                                                                <i class="fa fa-plus"></i> {{trans('inventory::inventory.floor_plans')}}
                                                            </a>
                                                        </div>
                                                        <!-- Master Plans -->
                                                        <div class="col-6 repeater-master_plans">
                                                            <div class="form-group">
                                                                <h4 class="kt-section__title kt-section__title-lg kt-margin-b-0">{{__('inventory::inventory.master_plans')}}:</h4>
                                                            </div>
                                                            <div data-repeater-list="masterplans">
                                                                <div data-repeater-item class="row">
                                                                    <div class="col-6">
                                                                        <label for="order">{{__('inventory::inventory.order')}}</label>
                                                                        <input name="order" id="order" type="number" class="form-control" placeholder="{{__('inventory::inventory.order')}}" data-parsley-trigger="change focusout">
                                                                    </div>
                                                                    <div class="col-4 my-3">
                                                                        <div class="row">
                                                                            <div class="box">
                                                                                <label for="master_plans">{{__('inventory::inventory.master_plans')}} </label>
                                                                                <input type="file" name="file" class="" id="master_plans" data-parsley-trigger="change focusout" />
                                                                                <label for="image"><strong>{{__('settings::settings.image_dimensions')}}:800 × 600 px</strong></label>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2 col-sm-2 my-3">
                                                                        <a href="javascript:;" data-repeater-delete class="btn btn-brand data-repeater-delete my-3">
                                                                            <i class="fa fa-times"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <a href="javascript:;" data-repeater-create id="repeater_btn_master_plans" class="btn">
                                                                <i class="fa fa-plus"></i> {{trans('inventory::inventory.master_plans')}}
                                                            </a>
                                                        </div>
                                                        <div class="col-6">
                                                            @include('inventory::units.image360-repeater-partial')
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="tab-pane fade" id="financial_information" role="tabpanel" aria-labelledby="financial_information-tab">
                                                    <div class="form-group row">
                                                        <!-- Currency Code -->
                                                        <!-- Payment Method -->
                                                        <div class="col-4 my-3">
                                                            <label for="i_payment_method_id">{{__('inventory::inventory.payment_method')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <select class="form-control selectpicker" data-live-search="true" id="i_payment_method_id" name="i_payment_method_id" data-parsley-trigger="change focusout">
                                                                <option value="" selected disabled>{{__('inventory::inventory.select_payment_method')}}</option>
                                                                @foreach ($payment_methods as $payment_method)
                                                                <option value="{{$payment_method->id}}">{{$payment_method->payment_method}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-4 my-3">
                                                            <label for="currency_code">{{__('inventory::inventory.currency_code')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <select class="form-control kt-selectpicker" data-live-search="true" id="currency_code" name="currency_code" data-parsley-trigger="change focusout">
                                                                <option value="" selected disabled>{{trans('inventory::inventory.select_currency_code')}}</option>
                                                                @for ($i = 0; $i < count($currency_codes); $i++) <option value="{{$currency_codes[$i]}}">{{$currency_codes[$i]}}</option>
                                                                    @endfor
                                                            </select>
                                                        </div>
                                                        <div class="col-4 my-3">
                                                            <label for="price">{{__('inventory::inventory.price')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <input name="price" id="price" type="number" class="form-control" placeholder="{{__('inventory::inventory.enter_price')}}" data-parsley-trigger="change focusout">
                                                        </div>
                                                        <!-- Down Payment -->
                                                        <div class="col-4 my-3">
                                                            <label for="down_payment">{{__('inventory::inventory.down_payment')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <input name="down_payment" id="down_payment" type="number" step="0.01" class="form-control" placeholder="{{__('inventory::inventory.enter_down_payment')}}" data-parsley-trigger="change focusout">
                                                        </div>

                                                        <!-- Price -->
                                                        <!-- Number of Installments -->
                                                        <div class="col-4 my-3">
                                                            <label for="installments">{{__('inventory::inventory.installments')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <input name="installments" id="installments" type="number" step="0.01" class="form-control" placeholder="{{__('inventory::inventory.installments')}}" data-parsley-trigger="change focusout">
                                                        </div>
                                                        <div class="col-4 my-3">
                                                            <label for="rent_price">{{__('inventory::inventory.rent_price')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <input name="rent_price" id="rent_price" type="number" class="form-control" placeholder="{{__('inventory::inventory.enter_price')}}" data-parsley-trigger="change focusout">
                                                        </div>
                                                        <div class="col-4 my-3">
                                                            <label for="resale_price">{{__('inventory::inventory.resale_price')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <input name="resale_price" id="resale_price" type="number" class="form-control" placeholder="{{__('inventory::inventory.enter_price')}}" data-parsley-trigger="change focusout">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="payment_plans" role="tabpanel" aria-labelledby="payment_plans-tab">
                                                    @include('inventory::units.payment-plan-partial')
                                                </div>
                                            </div>

                                        </div>

                                        <div class="kt-portlet__foot">
                                            <div class="kt-form__actions">
                                                <div class="kt-section kt-section--last">
                                                    <div class="kt-section__body">
                                                        <div class="form-group row">
                                                            <div class="col-12">
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-brand mx-3 save-continue">
                                                                        <i class="la la-check"></i>
                                                                        <span class="kt-hidden-mobile">Save</span>
                                                                    </button>
                                                                    <button type="button" class="btn btn-success save-only">
                                                                        <i class="la la-check"></i>
                                                                        <span class="kt-hidden-mobile">Save & Close</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end:: Content -->

</div>
