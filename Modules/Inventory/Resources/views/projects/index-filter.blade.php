<form class="kt-form kt-form--label-right" id="search_projects_form" action="{{ route('inventory.projects.export') }}" method="POST">
    {{csrf_field()}}

        <div class="form-group row">

                <!-- Country -->
                <div class="col-lg-3">
                    {{-- <label>{{trans('inventory::inventory.select_deselect_countries')}}</label> --}}
                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple="multiple" name="country_ids[]" id="country_id" onchange="getCountryRegions($(this).val())">
                        <option value="" selected disabled>{{trans('inventory::inventory.select_deselect_countries')}}</option>
                        @foreach ($countries as $country)
                            <option value="{{$country->id}}">{{$country->name}}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Region -->
                <div class="col-lg-3">
                    {{-- <label>{{trans('inventory::inventory.select_deselect_regions')}}</label> --}}
                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple="multiple" name="region_ids[]" id="region_id" onchange="if($(this).val().length){getRegionCities($(this).val())}">
                        <option value="" selected disabled>{{trans('inventory::inventory.select_deselect_regions')}}</option>
                    </select>
                </div>

                <!-- City -->
                <div class="col-lg-3">
                    {{-- <label>{{trans('inventory::inventory.select_deselect_cities')}}</label> --}}
                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple="multiple" name="city_ids[]" id="city_id" onchange="if($(this).val().length){getCityAreas($(this).val())}">
                        <option value="" selected disabled>{{trans('inventory::inventory.select_deselect_cities')}}</option>
                    </select>
                </div>

                <!-- Area -->
                <div class="col-lg-3">
                    {{-- <label>{{trans('inventory::inventory.select_deselect_areas')}}</label> --}}
                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple="multiple" name="area_ids[]" id="area_id">
                        <option value="" selected disabled>{{trans('inventory::inventory.select_deselect_areas')}}</option>
                    </select>
                </div>

        </div>

        <div class="form-group row">         
            <div class="col-lg-3">
                    {{-- <label>{{trans('inventory::inventory.select_deselect_area_units')}}</label> --}}
                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple="multiple" name="i_area_unit_ids[]" id="i_area_unit_ids">
                        <option value="" selected disabled>{{trans('inventory::inventory.select_deselect_area_units')}}</option>
                        @foreach ($area_units as $area_unit)
                            <option value="{{$area_unit->id}}">{{$area_unit->area_unit}}</option>
                        @endforeach
                    </select>
                </div>
            <!-- Area From -->
            <div class="col-lg-3">
                {{-- <label for="area_from">{{__('inventory::inventory.area_from')}}</label> --}}
                <input name="area_from" id="area_from" type="number" step="0.01" class="form-control" placeholder="{{__('inventory::inventory.area_from')}}" data-parsley-trigger="change focusout">
            </div>

            <!-- Area To -->
            <!-- <div class="col-lg-3">
                {{-- <label for="area_to">{{__('inventory::inventory.area_to')}}</label> --}}
                <input name="area_to" id="area_to" type="number" step="0.01" class="form-control" placeholder="{{__('inventory::inventory.area_to')}}" data-parsley-trigger="change focusout">
            </div> -->
            <div class="col-lg-3">
                    {{-- <label>{{trans('inventory::inventory.select_deselect_currency_codes')}}</label> --}}
                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" multiple="multiple" name="currency_codes[]" id="currency_codes">
                        <option value="" selected disabled>{{trans('inventory::inventory.select_deselect_currency_codes')}}</option>
                        @for ($i = 0; $i < count($currency_codes); $i++)
                            <option value="{{$currency_codes[$i]}}">{{$currency_codes[$i]}}</option>
                        @endfor
                    </select>
                </div>
            <!-- Price From -->
            <div class="col-lg-3">
                {{-- <label for="price_from">{{__('inventory::inventory.price_from')}}</label> --}}
                <input name="price_from" id="price_from" type="number" class="form-control" placeholder="{{__('inventory::inventory.price_from')}}" data-parsley-trigger="change focusout">
            </div>

            <!-- Price To -->
            <!-- <div class="col-lg-3">
                {{-- <label for="price_to">{{__('inventory::inventory.price_to')}}</label> --}}
                <input name="price_to" id="price_to" type="number" class="form-control" placeholder="{{__('inventory::inventory.price_to')}}" data-parsley-trigger="change focusout">
            </div>        -->

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

             
            </div>

            <div class="form-group row">

                <!-- Developer -->
                <div class="col-lg-6">
                    <!-- <label>{{__('inventory::inventory.developers')}}</label> -->
                    <input type="text" id="developer_ids" name="developer_ids" class="form-control" placeholder="{{__('inventory::inventory.developers')}}" data-role="tagsinput" />
                </div>

                <!-- Number of Installments From -->
                <div class="col-lg-3">
                    {{-- <label for="number_of_installments_from">{{__('inventory::inventory.number_of_installments_from')}}</label> --}}
                    <input name="number_of_installments_from" id="number_of_installments_from" type="number" class="form-control" placeholder="{{__('inventory::inventory.number_of_installments_from')}}" data-parsley-trigger="change focusout">
                </div>

                <!-- Number of Installments To -->
                <!-- <div class="col-lg-2">
                    {{-- <label for="number_of_installments_to">{{__('inventory::inventory.number_of_installments_to')}}</label> --}}
                    <input name="number_of_installments_to" id="number_of_installments_to" type="number" class="form-control" placeholder="{{__('inventory::inventory.number_of_installments_to')}}" data-parsley-trigger="change focusout">
                </div> -->

                <!-- Donw Payment From -->
                <!-- <div class="col-lg-2">
                    {{-- <label for="down_payment_from">{{__('inventory::inventory.down_payment_from')}}</label> --}}
                    <input name="down_payment_from" id="down_payment_from" type="number" class="form-control" placeholder="{{__('inventory::inventory.down_payment_from')}}" data-parsley-trigger="change focusout">
                </div> -->

                <!-- Down Payment To -->
                <!-- <div class="col-lg-2">
                    {{-- <label for="down_payment_to">{{__('inventory::inventory.down_payment_to')}}</label> --}}
                    <input name="down_payment_to" id="down_payment_to" type="number" class="form-control" placeholder="{{__('inventory::inventory.down_payment_to')}}" data-parsley-trigger="change focusout">
                </div> -->

                <!-- Area Unit -->
            
                <!-- Delivery Date Range -->
                <div class="col-lg-3">
                    {{-- <label>{{trans('inventory::inventory.delivery_date_range')}}</label> --}}
                    <div class="kt-form__control">
                        <div class="input-group">
                            <input type='text' class="daterangepicker-init form-control" readonly placeholder="{{trans('inventory::inventory.delivery_date_range')}}" name="delivery_date_range" id="delivery_date_range" />
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Is Featured -->
                <div class="col-lg-3">
                    <label>{{trans('inventory::inventory.is_featured')}}</label>
                    <input data-switch="true" type="checkbox" data-on-text="YES" data-handle-width="50" data-off-text="NO" data-on-color="success" name="is_featured" id="is_featured">
                </div>

                <div class="col-lg-3">
                    <label>{{trans('inventory::inventory.published')}}</label>
                    <input data-switch="true" type="checkbox" data-on-text="YES" data-handle-width="50" data-off-text="NO" data-on-color="success" name="is_published" id="is_published">
                </div>
                <!-- Is Finishied -->
                <div class="col-lg-3">
                    <label>{{trans('inventory::inventory.is_finished')}}</label>
                    <input data-switch="true" type="checkbox" data-on-text="YES" data-handle-width="50" data-off-text="NO" data-on-color="success" name="is_finished" id="is_finished">
                </div>
            </div>
        </div>

        <div class="kt-form__actions">
            <hr>
            <div class="row">
                <div class="col-lg-6 text-left">
                @if (auth()->user()->hasPermission('export-inventory-projects'))
                        <button type="reset" class="btn btn-sm btn-brand btn-icon-sm font-weight-bold" id="m_export"><i class="fas fa-file-excel"></i> {{trans('inventory::inventory.export')}}</button>
                @endif
                </div>
                <div class="col-lg-6 text-right">
                    <a href="javascript:;" data-toggleit="#advanced_filter" class="btn btn-sm btn-link btn-icon-sm" data-hideme>{{trans('inventory::inventory.advanced_filter')}}</a>
                    <a href="javascript:;" data-toggleit="#projectfilter" class="btn btn-sm btn-secondary btn-icon-sm"><i class="fas fa-times"></i> {{trans('inventory::inventory.close')}}</a>
                    <button type="reset" class="btn btn-secondary btn-sm btn-icon-sm" id="m_reset"><i class="fas fa-eraser"></i> {{trans('inventory::inventory.reset')}}</button>
                    <button type="submit" class="btn btn-primary btn-sm btn-icon-sm" id="m_search"><i class="fas fa-check"></i> {{trans('inventory::inventory.apply')}}</button>
                </div>
            </div>
        </div>
        <hr>
</form>