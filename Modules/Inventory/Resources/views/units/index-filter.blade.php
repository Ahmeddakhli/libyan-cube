<form class="kt-form kt-form--label-right" id="search_units_form" action="{{ route('inventory.units.export') }}" method="POST">
    {{csrf_field()}}

    <div class="form-group row">
        <!-- Purpose -->
        <div class="col-lg-2">
            {{-- <label>{{trans('inventory::inventory.select_deselect_purposes')}}</label> --}}
            <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple="multiple" name="purpose_ids[]" id="purpose_ids" onchange="getPurposePurposeTypes($(this).val())">
                <option value="" selected disabled>{{trans('inventory::inventory.select_deselect_purposes')}}</option>
                @foreach ($purposes as $purpose)
                <option value="{{$purpose->id}}">{{$purpose->purpose}}</option>
                @endforeach
            </select>
        </div>

        <!-- Purpose Type -->
        <div class="col-lg-2">
            {{-- <label>{{trans('inventory::inventory.select_deselect_purpose_types')}}</label> --}}
            <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple="multiple" name="i_purpose_type_ids[]" id="i_purpose_type_id">
                <option value="" selected disabled>{{trans('inventory::inventory.select_deselect_purpose_types')}}</option>
            </select>
        </div>

        <!-- Offering Type -->
        <div class="col-lg-2">
            {{-- <label>{{trans('inventory::inventory.select_deselect_offering_types')}}</label> --}}
            <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple="multiple" name="i_offering_type_ids[]" id="i_offering_type_ids">
                <option value="" selected disabled>{{trans('inventory::inventory.select_deselect_offering_types')}}</option>
                @foreach ($offering_types as $offering_type)
                <option value="{{$offering_type->id}}">{{$offering_type->offering_type}}</option>
                @endforeach
            </select>
        </div>

        <!-- Design Type -->
        <!-- <div class="col-lg-2">
            {{-- <label>{{trans('inventory::inventory.select_deselect_design_types')}}</label> --}}
            <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple="multiple" name="i_design_type_ids[]" id="i_offering_type_ids">
                <option value="" selected disabled>{{trans('inventory::inventory.select_deselect_design_types')}}</option>
                @foreach ($design_types as $design_type)
                <option value="{{$design_type->id}}">{{$design_type->type}}</option>
                @endforeach
            </select>
        </div> -->

        <!-- Payment Method -->
        <!-- <div class="col-lg-2">
            {{-- <label>{{trans('inventory::inventory.select_deselect_payment_methods')}}</label> --}}
            <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple="multiple" name="i_payment_method_ids[]" id="i_payment_method_ids">
                <option value="" selected disabled>{{trans('inventory::inventory.select_deselect_payment_methods')}}</option>
                @foreach ($payment_methods as $payment_method)
                <option value="{{$payment_method->id}}">{{$payment_method->payment_method}}</option>
                @endforeach
            </select>
        </div> -->

        <!-- Position -->
        <!-- <div class="col-lg-2">
            {{-- <label>{{trans('inventory::inventory.select_deselect_positions')}}</label> --}}
            <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple="multiple" name="i_position_ids[]" id="i_position_ids">
                <option value="" selected disabled>{{trans('inventory::inventory.select_deselect_positions')}}</option>
                @foreach ($positions as $position)
                <option value="{{$position->id}}">{{$position->position}}</option>
                @endforeach
            </select>
        </div> -->
        <!-- Project -->
        <div class="col-lg-3">
            <!-- <label>{{__('inventory::inventory.projects')}}</label> -->
            <input type="text" id="i_project_ids" name="i_project_ids" class="form-control" placeholder="{{__('inventory::inventory.projects')}}" data-role="tagsinput" />
        </div>

        <!-- Seller -->
        <div class="col-lg-3">
            <!-- <label>{{__('inventory::inventory.sellers')}}</label> -->
            <input type="text" id="seller_ids" name="seller_ids" class="form-control" placeholder="{{__('inventory::inventory.sellers')}}" data-role="tagsinput" />
        </div>

    </div>

    <div class="form-group row">

        <!-- Buyer -->
        <!-- <div class="col-lg-4">
            <label>{{__('inventory::inventory.buyers')}}</label>
            <input type="text" name="buyer_ids" id="buyer_ids" placeholder="{{__('inventory::inventory.buyers')}}" class="form-control" data-role="tagsinput" />
        </div> -->
    </div>

    <div class="form-group row">

        <!-- Country -->
        <div class="col-lg-2">
            {{-- <label>{{trans('inventory::inventory.select_deselect_countries')}}</label> --}}
            <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple="multiple" name="country_ids[]" id="country_id" onchange="getCountryRegions($(this).val())">
                <option value="" selected disabled>{{trans('inventory::inventory.select_deselect_countries')}}</option>
                @foreach ($countries as $country)
                <option value="{{$country->id}}">{{$country->name}}</option>
                @endforeach
            </select>
        </div>

        <!-- Region -->
        <div class="col-lg-2">
            {{-- <label>{{trans('inventory::inventory.select_deselect_regions')}}</label> --}}
            <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple="multiple" name="region_ids[]" id="region_id" onchange="if($(this).val().length){getRegionCities($(this).val())}">
                <option value="" selected disabled>{{trans('inventory::inventory.select_deselect_regions')}}</option>
            </select>
        </div>

        <!-- City -->
        <div class="col-lg-2">
            {{-- <label>{{trans('inventory::inventory.select_deselect_cities')}}</label> --}}
            <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple="multiple" name="city_ids[]" id="city_id" onchange="if($(this).val().length){getCityAreas($(this).val())}">
                <option value="" selected disabled>{{trans('inventory::inventory.select_deselect_cities')}}</option>
            </select>
        </div>

        <!-- Area -->
        <div class="col-lg-2">
            {{-- <label>{{trans('inventory::inventory.select_deselect_areas')}}</label> --}}
            <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple="multiple" name="area_ids[]" id="area_id">
                <option value="" selected disabled>{{trans('inventory::inventory.select_deselect_areas')}}</option>
            </select>
        </div>

        <!-- Bedroom -->
        <div class="col-lg-2">
            {{-- <label>{{trans('inventory::inventory.select_deselect_bedrooms')}}</label> --}}
            <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple="multiple" name="i_bedroom_ids[]" id="i_bedroom_ids">
                <option value="" selected disabled>{{trans('inventory::inventory.select_deselect_bedrooms')}}</option>
                @foreach ($bedrooms as $bedroom)
                <option value="{{$bedroom->id}}">{{$bedroom->bedroom}}</option>
                @endforeach
            </select>
        </div>

        <!-- Bathroom -->
        <div class="col-lg-2">
            {{-- <label>{{trans('inventory::inventory.select_deselect_bathrooms')}}</label> --}}
            <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple="multiple" name="i_bathroom_ids[]" id="i_bathroom_ids">
                <option value="" selected disabled>{{trans('inventory::inventory.select_deselect_bathrooms')}}</option>
                @foreach ($bathrooms as $bathroom)
                <option value="{{$bathroom->id}}">{{$bathroom->bathroom}}</option>
                @endforeach
            </select>
        </div>

    </div>

    <div class="form-group row">

        <!-- Furnishing Status -->
        <div class="col-lg-2">
            {{-- <label>{{trans('inventory::inventory.select_deselect_furnishing_statuses')}}</label> --}}
            <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple="multiple" name="i_furnishing_status_ids[]" id="i_furnishing_status_ids">
                <option value="" selected disabled>{{trans('inventory::inventory.select_deselect_furnishing_statuses')}}</option>
                @foreach ($furnishing_statuses as $furnishing_status)
                <option value="{{$furnishing_status->id}}">{{$furnishing_status->furnishing_status}}</option>
                @endforeach
            </select>
        </div>

        <!-- Availability -->
        <div class="col-lg-2">
            {{-- <label>{{trans('inventory::inventory.availability')}}</label> --}}
            <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" name="availability" id="availability">
                {{-- <option value="" selected>{{trans('inventory::inventory.nothing_selected')}}</option> --}}
                <option value="" selected disabled>{{trans('inventory::inventory.availability')}}</option>
                <option value="1">{{trans('inventory::inventory.available')}}</option>
                <option value="2">{{trans('inventory::inventory.rented')}}</option>
                <option value="3">{{trans('inventory::inventory.sold')}}</option>
            </select>
        </div>

        <!-- Area From -->
        <div class="col-lg-2">
            {{-- <label for="area_from">{{__('inventory::inventory.area_from')}}</label> --}}
            <input name="area_from" id="area_from" type="number" step="0.01" class="form-control" placeholder="{{__('inventory::inventory.area_from')}}" data-parsley-trigger="change focusout">
        </div>

        <!-- Area To -->
        <!-- <div class="col-lg-2">
            {{-- <label for="area_to">{{__('inventory::inventory.area_to')}}</label> --}}
            <input name="area_to" id="area_to" type="number" step="0.01" class="form-control" placeholder="{{__('inventory::inventory.area_to')}}" data-parsley-trigger="change focusout">
        </div> -->

        <!-- Price From -->
        <div class="col-lg-2">
            {{-- <label for="price_from">{{__('inventory::inventory.price_from')}}</label> --}}
            <input name="price_from" id="price_from" type="number" class="form-control" placeholder="{{__('inventory::inventory.price_from')}}" data-parsley-trigger="change focusout">
        </div>

        <!-- Price To -->
        <!-- <div class="col-lg-2">
            {{-- <label for="price_to">{{__('inventory::inventory.price_to')}}</label> --}}
            <input name="price_to" id="price_to" type="number" class="form-control" placeholder="{{__('inventory::inventory.price_to')}}" data-parsley-trigger="change focusout">
        </div> -->

    </div>

    <div id="advanced_filter" class="toggleit">
        <hr>
        <div class="form-group row">

            <!-- Last Updated At Range -->
            <div class="col-lg-2 kt-hidden">
                <label>{{trans('inventory::inventory.last_update_date_range')}}</label>
                <div class="kt-form__control">
                    <div class="input-group">
                        <input type='text' class="daterangepicker-init form-control" readonly placeholder="{{trans('inventory::inventory.select_last_updated_at_range')}}" name="last_updated_at_range" id="last_updated_at_range" />
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="la la-calendar-check-o"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- View -->
            <!-- <div class="col-lg-2 kt-hidden">
                {{-- <label>{{trans('inventory::inventory.select_deselect_views')}}</label> --}}
                <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple="multiple" name="i_view_ids[]" id="i_view_ids">
                    <option value="" selected disabled>{{trans('inventory::inventory.select_deselect_views')}}</option>
                    @foreach ($views as $view)
                    <option value="{{$view->id}}">{{$view->view}}</option>
                    @endforeach
                </select>
            </div> -->
        </div>

        <div class="form-group row">
            <!-- Donw Payment From -->
            <div class="col-lg-2">
                {{-- <label for="down_payment_from">{{__('inventory::inventory.down_payment_from')}}</label> --}}
                <input name="down_payment_from" id="down_payment_from" type="number" class="form-control" placeholder="{{__('inventory::inventory.down_payment_from')}}" data-parsley-trigger="change focusout">
            </div>

            <!-- Down Payment To -->
            <!-- <div class="col-lg-2">
                {{-- <label for="down_payment_to">{{__('inventory::inventory.down_payment_to')}}</label> --}}
                <input name="down_payment_to" id="down_payment_to" type="number" class="form-control" placeholder="{{__('inventory::inventory.down_payment_to')}}" data-parsley-trigger="change focusout">
            </div> -->

            <!-- Plot Area From -->
            <!-- <div class="col-lg-2">
                {{-- <label for="plot_area_from">{{__('inventory::inventory.plot_area_from')}}</label> --}}
                <input name="plot_area_from" id="plot_area_from" type="number" step="0.01" class="form-control" placeholder="{{__('inventory::inventory.plot_area_from')}}" data-parsley-trigger="change focusout">
            </div> -->

            <!-- Plot Area To -->
            <!-- <div class="col-lg-2">
                {{-- <label for="plot_area_to">{{__('inventory::inventory.plot_area_to')}}</label> --}}
                <input name="plot_area_to" id="plot_area_to" type="number" step="0.01" class="form-control" placeholder="{{__('inventory::inventory.plot_area_to')}}" data-parsley-trigger="change focusout">
            </div> -->

            <!-- Build Up Area From -->
            <!-- <div class="col-lg-2">
                {{-- <label for="build_up_area_from">{{__('inventory::inventory.build_up_area_from')}}</label> --}}
                <input name="build_up_area_from" id="build_up_area_from" type="number" step="0.01" class="form-control" placeholder="{{__('inventory::inventory.build_up_area_from')}}" data-parsley-trigger="change focusout">
            </div> -->

            <!-- Build Up Area To -->
            <!-- <div class="col-lg-2">
                {{-- <label for="build_up_area_to">{{__('inventory::inventory.build_up_area_to')}}</label> --}}
                <input name="build_up_area_to" id="build_up_area_to" type="number" step="0.01" class="form-control" placeholder="{{__('inventory::inventory.build_up_area_to')}}" data-parsley-trigger="change focusout">
            </div> -->

            <!-- Currency Code -->
            <div class="col-lg-2">
                {{-- <label>{{trans('inventory::inventory.select_deselect_currency_codes')}}</label> --}}
                <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple="multiple" name="currency_codes[]" id="currency_codes">
                    <option value="" selected disabled>{{trans('inventory::inventory.select_deselect_currency_codes')}}</option>
                    @for ($i = 0; $i < count($currency_codes); $i++) <option value="{{$currency_codes[$i]}}">{{$currency_codes[$i]}}</option>
                        @endfor
                </select>
            </div>

            <!-- Area Unit -->
            <div class="col-lg-2">
                {{-- <label>{{trans('inventory::inventory.select_deselect_area_units')}}</label> --}}
                <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple="multiple" name="i_area_unit_ids[]" id="i_area_unit_ids">
                    <option value="" selected disabled>{{trans('inventory::inventory.select_deselect_area_units')}}</option>
                    @foreach ($area_units as $area_unit)
                    <option value="{{$area_unit->id}}">{{$area_unit->area_unit}}</option>
                    @endforeach
                </select>
            </div>

            <!-- Number of Installments From -->
            <!-- <div class="col-lg-2">
                {{-- <label for="number_of_installments_from">{{__('inventory::inventory.number_of_installments_from')}}</label> --}}
                <input name="number_of_installments_from" id="number_of_installments_from" type="number" class="form-control" placeholder="{{__('inventory::inventory.number_of_installments_from')}}" data-parsley-trigger="change focusout">
            </div> -->

            <!-- Number of Installments To -->
            <!-- <div class="col-lg-2">
                {{-- <label for="number_of_installments_to">{{__('inventory::inventory.number_of_installments_to')}}</label> --}}
                <input name="number_of_installments_to" id="number_of_installments_to" type="number" class="form-control" placeholder="{{__('inventory::inventory.number_of_installments_to')}}" data-parsley-trigger="change focusout">
            </div> -->


            <!-- Finishing Type -->
            <div class="col-lg-2">
                {{-- <label>{{trans('inventory::inventory.select_deselect_finishing_types')}}</label> --}}
                <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple="multiple" name="i_finishing_type_ids[]" id="i_finishing_type_ids">
                    <option value="" selected disabled>{{trans('inventory::inventory.select_deselect_finishing_types')}}</option>
                    @foreach ($finishing_types as $finishing_type)
                    <option value="{{$finishing_type->id}}">{{$finishing_type->finishing_type}}</option>
                    @endforeach
                </select>
            </div>

            <!-- Floor Number -->
            <!-- <div class="col-lg-2">
                {{-- <label>{{trans('inventory::inventory.select_deselect_floor_numbers')}}</label> --}}
                <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple="multiple" name="i_floor_number_ids[]" id="i_floor_number_ids">
                    <option value="" selected disabled>{{trans('inventory::inventory.select_deselect_floor_numbers')}}</option>
                    @foreach ($floor_numbers as $floor_number)
                    <option value="{{$floor_number->id}}">{{$floor_number->floor_number}}</option>
                    @endforeach
                </select>
            </div> -->

            <!-- Garden Area Unit -->
            <div class="col-lg-2">
                {{-- <label>{{trans('inventory::inventory.select_deselect_garden_area_units')}}</label> --}}
                <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple="multiple" name="i_garden_area_unit_ids[]" id="i_garden_area_unit_ids">
                    <option value="" selected disabled>{{trans('inventory::inventory.select_deselect_garden_area_units')}}</option>
                    @foreach ($area_units as $area_unit)
                    <option value="{{$area_unit->id}}">{{$area_unit->area_unit}}</option>
                    @endforeach
                </select>
            </div>

            <!-- Garden Area From -->
            <!-- <div class="col-lg-2">
                {{-- <label for="garden_area_from">{{__('inventory::inventory.garden_area_from')}}</label> --}}
                <input name="garden_area_from" id="garden_area_from" type="number" step="0.01" class="form-control" placeholder="{{__('inventory::inventory.garden_area_from')}}" data-parsley-trigger="change focusout">
            </div> -->

            <!-- Garden Area To -->
            <!-- <div class="col-lg-2">
                {{-- <label for="garden_area_to">{{__('inventory::inventory.garden_area_to')}}</label> --}}
                <input name="garden_area_to" id="garden_area_to" type="number" step="0.01" class="form-control" placeholder="{{__('inventory::inventory.garden_area_to')}}" data-parsley-trigger="change focusout">
            </div> -->

            <!-- Created At Range -->
            <div class="col-lg-2">
                {{-- <label>{{trans('inventory::inventory.creation_date_range')}}</label> --}}
                <div class="kt-form__control">
                    <div class="input-group">
                        <input type='text' class="daterangepicker-init form-control" readonly placeholder="{{trans('inventory::inventory.creation_date_range')}}" name="created_at_range" id="created_at_range" />
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Is Featured -->
            <div class="col-lg-2">
                <label>{{trans('inventory::inventory.is_featured')}}</label>
                <input data-switch="true" type="checkbox" data-on-text="YES" data-handle-width="50" data-off-text="NO" data-on-color="success" name="is_featured" id="is_featured">
            </div>

            <!-- Is Active -->
            <div class="col-lg-2">
                <label>{{trans('inventory::inventory.is_active')}}</label>
                <input data-switch="true" type="checkbox" data-on-text="YES" data-handle-width="50" data-off-text="NO" data-on-color="success" name="is_active" id="is_active">
            </div>

        </div>
    </div>

    <div class="kt-form__actions">
        <hr>
        <div class="row">
            <div class="col-lg-6 text-left">
                @if (auth()->user()->hasPermission('export-inventory-unit'))
                <button type="reset" class="btn btn-sm btn-brand btn-icon-sm font-weight-bold" id="m_export"><i class="fas fa-file-excel"></i> {{trans('inventory::inventory.export')}}</button>
                @endif
            </div>
            <div class="col-lg-6 text-right">
                <a href="javascript:;" data-toggleit="#advanced_filter" class="btn btn-sm btn-link btn-icon-sm" data-hideme>{{trans('inventory::inventory.advanced_filter')}}</a>
                <a href="javascript:;" data-toggleit="#lccfilter" class="btn btn-sm btn-secondary btn-icon-sm"><i class="fas fa-times"></i> {{trans('inventory::inventory.close')}}</a>
                <button type="reset" class="btn btn-secondary btn-sm btn-icon-sm" id="m_reset"><i class="fas fa-eraser"></i> {{trans('inventory::inventory.reset')}}</button>
                <button type="submit" class="btn btn-primary btn-sm btn-icon-sm" id="m_search"><i class="fas fa-check"></i> {{trans('inventory::inventory.apply')}}</button>
            </div>
        </div>
    </div>
    <hr>
</form>