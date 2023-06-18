@extends('dashboard.layouts.basic')

@section('content')
    <style>
        .select.bs-select-hidden,
        .bootstrap-select>select.bs-select-hidden,
        select.selectpicker {
            display: block !important;

        }
    </style>
    <!--begin::Form-->
    <form action="{{route('inventory.projects.store')}}" data-async data-set-autofocus method="POST" id="create_project_form" class="kt-form" data-callback="createProjectCallback" data-parsley-validate>
        @csrf
        <div class="row">
            <div class="col-xl-10 ml-5 mr-5">
                <div class="kt-section kt-section--first">
                    <div class="kt-section__body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h3 class="kt-section__title kt-section__title-lg kt-margin-b-0">{{__('inventory::inventory.project')}}:</h3>
                            </div>
                            <div class="col-12 repeater-project">
                                <div data-repeater-list="translations">
                                    <div data-repeater-item class="row">
                                        <div class="col-6 form-group">
                                            {{-- <label for="language_id">{{__('inventory::inventory.language')}}</label> --}}
                                            <select class="form-control" id="language_id" name="language_id" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_select_the_language')}}" data-parsley-trigger="change focusout">
                                                <option value="" selected disabled>{{__('inventory::inventory.language')}}</option>
                                                @foreach ($languages as $language)
                                                <option value="{{$language->id}}" @if($language->id == 1) selected @endif>{{$language->code}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-6">
                                            {{-- <label for="project">{{__('inventory::inventory.project')}}</label>--}}
                                            <input name="project" id="project" type="text" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_project')}}" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.project_is_required')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('inventory::inventory.project_max_is_150_characters_long')}}">
                                        </div>
                                        <div class="col-lg-12">
                                            <label for="description">{{__('inventory::inventory.description')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                            <textarea rows="6" name="description" id="description" class="form-control" placeholder="{{__('inventory::inventory.enter_description')}}" data-parsley-maxlength="4294967295" data-parsley-maxlength-message="{{__('inventory::inventory.description_max_is_4294967295_characters_long')}}"></textarea>
                                        </div>
                                        <div class="col-6 mt-2">
                                            <label for="meta_title">{{__('inventory::inventory.meta_title')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                            <input name="meta_title" id="meta_title" type="text" class="form-control" placeholder="{{__('inventory::inventory.meta_title')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('inventory::inventory.title_max_is_150_characters_long')}}">
                                        </div>
                                        <div class="col-lg-6 mt-2">
                                            <label for="meta_description">{{__('inventory::inventory.meta_description')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                            <textarea rows="6" name="meta_description" id="meta_description" class="form-control" placeholder="{{__('inventory::inventory.meta_description')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295" data-parsley-maxlength-message="{{__('inventory::inventory.description_max_is_4294967295_characters_long')}}"></textarea>
                                        </div>
                                        <div class="col-md-2 col-sm-2">
                                            {{-- <label class="control-label">&nbsp;</label> --}}
                                            <a href="javascript:;" data-repeater-delete class="btn btn-brand data-repeater-delete">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <a href="javascript:;" data-repeater-create id="repeater_btn_project" class="btn">
                                    <i class="fa fa-plus"></i> {{trans('inventory::inventory.project_trans')}}
                                </a>
                            </div>

                            <hr>
                            <div class="form-group row">
                                <h4 class="kt-section__title kt-section__title-lg kt-margin-b-0">{{__('inventory::inventory.is_featured')}}:</h4>
                            </div>
                            <div class="form-group row">
                                <div class="fancy-checkbox">
                                    <input name="is_featured" id="is_featured" type="checkbox">
                                    <label for="is_featured">{{__('inventory::inventory.is_featured')}}</label>
                                </div>
                            </div>

                            <hr>
                            <div class="form-group row">
                                <h4 class="kt-section__title kt-section__title-lg kt-margin-b-0">{{__('inventory::inventory.project_information')}}:</h4>
                            </div>
                            <div class="form-group row">
                                <div class="form-group row">
                                    <!-- Developer -->
                                    <div class="form-group">
                                        <label class="col-12 control-label" for="developer_id">{{__('inventory::inventory.developer')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                        <div class="col-12">
                                            <input type="text" id="developer_id" name="developer_id" data-parsley-trigger="change focusout" class="form-control" data-role="tagsinput" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label>{{trans('inventory::inventory.delivery_date')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                    <input name="delivery_date" autocomplete="off" class="form-control datetimepicker-init" placeholder="{{trans('inventory::inventory.select_delivery_date')}}" data-parsley-trigger="change focusout" />
                                </div>
                                <div class="col-4">
                                    <label for="finished_status">{{__('inventory::inventory.finished_status')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                    <select class="form-control selectpicker" data-live-search="true" id="finished_status" name="finished_status" data-parsley-trigger="change focusout">
                                        <option value="" selected disabled>{{__('inventory::inventory.select_finished_status')}}</option>
                                        <option value="1">{{trans('inventory::inventory.finished')}}</option>
                                        <option value="0">{{trans('inventory::inventory.not_finished')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <!-- Area Unit -->
                                <div class="col-4">
                                    <label for="i_view_id">{{__('inventory::inventory.area_unit')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                    <select class="form-control selectpicker" data-live-search="true" id="i_area_unit_id" name="i_area_unit_id" data-parsley-trigger="change focusout">
                                        <option value="" selected disabled>{{__('inventory::inventory.select_area_unit')}}</option>
                                        @foreach ($area_units as $area_unit)
                                        <option value="{{$area_unit->id}}">{{$area_unit->area_unit}}</option>
                                        @endforeach
                                    </select>
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
                            </div>
                        </div>

                        <hr>
                        <div class="col-md-12">
                            <div class="form-group">
                                <h4 class="kt-section__title kt-section__title-lg kt-margin-b-0">{{__('inventory::inventory.location_information')}}:</h4>
                            </div>

                            <div class="form-group row">
                                <!-- Country -->
                                <div class="col-4">
                                    <label for="country_id">{{__('inventory::inventory.country')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                    <select class="form-control selectpicker" data-live-search="true" id="country_id" name="country_id" data-parsley-trigger="change focusout" onchange="getCountryRegions($(this).find(':selected').val())">
                                        <option value="" selected disabled>{{__('inventory::inventory.select_country')}}</option>
                                        @foreach ($countries as $country)
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Region -->
                                <div class="col-4">
                                    <label for="region_id">{{__('inventory::inventory.region')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                    <select class="form-control selectpicker" data-live-search="true" id="region_id" name="region_id" data-parsley-trigger="change focusout" onchange="getRegionCities($(this).find(':selected').val())">
                                        <option value="" selected disabled>{{__('inventory::inventory.select_region')}}</option>
                                        {{-- @foreach ($regions as $region)
                                            <option value="{{$region->id}}">{{$region->name}}</option>
                                        @endforeach --}}
                                    </select>
                                </div>

                                <!-- City -->
                                <div class="col-4">
                                    <label for="city_id">{{__('inventory::inventory.city')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                    <select class="form-control selectpicker" data-live-search="true" id="city_id" name="city_id" data-parsley-trigger="change focusout" onchange="getCityAreas($(this).find(':selected').val())">
                                        <option value="" selected disabled>{{__('inventory::inventory.select_city')}}</option>
                                        {{-- @foreach ($cities as $city)
                                            <option value="{{$city->id}}">{{$city->name}}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                                <!-- Area -->
                                <div class="col-4">
                                    <label for="area_id">{{__('inventory::inventory.area')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                    <select class="form-control selectpicker" data-live-search="true" id="area_id" name="area_id" data-parsley-trigger="change focusout">
                                        <option value="" selected disabled>{{__('inventory::inventory.select_area')}}</option>

                                    </select>
                                </div>
                                <!-- Address -->
                                <div class="col-lg-8">
                                    <label>{{__('inventory::inventory.address')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                    <input name="address" id="address" class="form-control" placeholder="{{__('inventory::inventory.enter_address')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="191" data-parsley-maxlength-message="{{__('inventory::inventory.address_max_is_16777215_characters_long')}}" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <!-- Map -->
                                <div class="col-lg-12">
                                    <label>{{__('inventory::inventory.location')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                    <input id="map_search" name="map_search" class="form-control" type="text" placeholder="{{__('inventory::inventory.enter_a_location')}}">
                                    <div id="map" style="height:300px; width:100%;"></div>
                                    <input id="lat" name="latitude" type="hidden" value="" />
                                    <input id="lng" name="longitude" type="hidden" value="" />
                                </div>
                            </div>

                            <hr>
                            <div class="form-group">
                                <h4 class="kt-section__title kt-section__title-lg kt-margin-b-0">{{__('inventory::inventory.financial_information')}}:</h4>
                            </div>
                            <div class="form-group row">
                                <!-- Down Payment -->
                                <div class="col-6">
                                    <label for="down_payment_from">{{__('inventory::inventory.down_payment_from')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                    <input name="down_payment_from" id="down_payment_from" type="number" class="form-control" placeholder="{{__('inventory::inventory.enter_down_payment')}}" data-parsley-trigger="change focusout">
                                </div>
                                <div class="col-6">
                                    <label for="down_payment_to">{{__('inventory::inventory.down_payment_to')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                    <input name="down_payment_to" id="down_payment_to" type="number" class="form-control" placeholder="{{__('inventory::inventory.enter_down_payment')}}" data-parsley-trigger="change focusout">
                                </div>

                                <!-- Price -->
                                <div class="col-6">
                                    <label for="price_from">{{__('inventory::inventory.price_from')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                    <input name="price_from" id="price_from" type="number" class="form-control" placeholder="{{__('inventory::inventory.enter_price')}}" data-parsley-trigger="change focusout">
                                </div>
                                <div class="col-6">
                                    <label for="price_to">{{__('inventory::inventory.price_to')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                    <input name="price_to" id="price_to" type="number" class="form-control" placeholder="{{__('inventory::inventory.enter_price')}}" data-parsley-trigger="change focusout">
                                </div>

                                <!-- Number of Installments -->
                                <div class="col-6">
                                    <label for="number_of_installments_from">{{__('inventory::inventory.number_of_installments_from')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                    <input name="number_of_installments_from" id="number_of_installments_from" type="number" class="form-control" placeholder="{{__('inventory::inventory.enter_number_of_installments')}}" data-parsley-trigger="change focusout">
                                </div>
                                <div class="col-6">
                                    <label for="number_of_installments_to">{{__('inventory::inventory.number_of_installments_to')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                    <input name="number_of_installments_to" id="number_of_installments_to" type="number" class="form-control" placeholder="{{__('inventory::inventory.enter_number_of_installments')}}" data-parsley-trigger="change focusout">
                                </div>

                            </div>
                            <div class="form-group row">
                                <!-- Currency Code -->
                                <div class="col-lg-6">
                                    <label for="currency_code">{{__('inventory::inventory.currency_code')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                    <select class="form-control kt-selectpicker" data-live-search="true" id="currency_code" name="currency_code" data-parsley-trigger="change focusout">
                                        <option value="" selected disabled>{{trans('inventory::inventory.select_currency_code')}}</option>
                                        @for ($i = 0; $i < count($currency_codes); $i++) <option value="{{$currency_codes[$i]}}">{{$currency_codes[$i]}}</option>
                                            @endfor
                                    </select>
                                </div>
                            </div>

                            <hr>
                            <div class="form-group">
                                <h4 class="kt-section__title kt-section__title-lg kt-margin-b-0">{{__('inventory::inventory.facilities_and_amenities')}}:</h4>
                            </div>
                            <!-- Facilities -->
                            <div class="form-group row">
                                <div class="col-6">
                                    <label for="facilities">{{__('inventory::inventory.facilities')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                    <select class="form-control m-select2" id="facilities" name="facilities[]" data-parsley-trigger="change focusout" multiple="multiple">
                                        @foreach ($facilities as $facility)
                                        <option value="{{$facility->id}}">{{$facility->facility}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="amenities">{{__('inventory::inventory.amenities')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                    <select class="form-control m-select2" id="amenities" name="amenities[]" multiple="multiple">
                                        @foreach ($amenities as $amenity)
                                        <option value="{{$amenity->id}}">{{$amenity->amenity}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <hr>
                            <div class="form-group">
                                <h4 class="kt-section__title kt-section__title-lg kt-margin-b-0">{{__('inventory::inventory.tags')}}:</h4>
                            </div>
                            <!-- Tags -->
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="tags">{{__('inventory::inventory.tags')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                    <select class="form-control m-select2" id="tags" name="tags[]" data-parsley-trigger="change focusout" multiple="multiple">
                                        @foreach ($tags as $tag)
                                        <option value="{{$tag->id}}">{{$tag->tag}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- Tags -->

                            <hr>
                            <div class="form-group row">

                                <hr>
                                <!-- Attachments -->
                                <div class="col-12 repeater-attachments">
                                    <div data-repeater-list="attachments">
                                        <div data-repeater-item class="row">
                                            <div class="col-6">
                                                <label for="order">{{__('inventory::inventory.order')}}</label>
                                                <input name="order" id="order" type="number" class="form-control" placeholder="{{__('inventory::inventory.order')}}" data-parsley-trigger="change focusout">
                                            </div>
                                            <div class="col-lg-4">
                                                {{-- <div class="form-group">
                                                <h4 class="kt-section__title kt-section__title-lg kt-margin-b-0">{{__('inventory::inventory.attachments')}}:</h4>
                                            </div> --}}
                                            <div class="row">
                                                <div class="box">
                                                    <label for="attachments">{{__('inventory::inventory.attachments')}}</label>
                                                    <input type="file" name="file" class="" id="attachments" data-parsley-trigger="change focusout" />

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

                            <!-- Floor Plans -->
                            <div class="col-12 repeater-floorplans">
                                <div data-repeater-list="floorplans">
                                    <div data-repeater-item class="row">
                                        <div class="col-6">
                                            <label for="order">{{__('inventory::inventory.order')}}</label>
                                            <input name="order" id="order" type="number" class="form-control" placeholder="{{__('inventory::inventory.order')}}" data-parsley-trigger="change focusout">
                                        </div>
                                        <div class="col-lg-4">

                                            <div class="row">
                                                <div class="box">
                                                    <label for="floor_plans">{{__('inventory::inventory.floor_plans')}}</label>
                                                    <input type="file" name="file" class="" id="floor_plans" data-parsley-trigger="change focusout" />

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
                                <a href="javascript:;" data-repeater-create id="repeater_btn_floorplans" class="btn">
                                    <i class="fa fa-plus"></i> {{trans('inventory::inventory.floor_plans')}}
                                </a>
                            </div>
                            <!-- Master Plans -->
                            <div class="col-12 repeater-masterplans">
                                <div data-repeater-list="masterplans">
                                    <div data-repeater-item class="row">
                                        <div class="col-6">
                                            <label for="order">{{__('inventory::inventory.order')}}</label>
                                            <input name="order" id="order" type="number" class="form-control" placeholder="{{__('inventory::inventory.order')}}" data-parsley-trigger="change focusout">
                                        </div>
                                        <div class="col-lg-4">

                                            <div class="row">
                                                <div class="box">
                                                    <label for="master_plans">{{__('inventory::inventory.master_plans')}}</label>
                                                    <input type="file" name="file" class="" id="master_plans" data-parsley-trigger="change focusout" />

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
                                <a href="javascript:;" data-repeater-create id="repeater_btn_masterplans" class="btn">
                                    <i class="fa fa-plus"></i> {{trans('inventory::inventory.master_plans')}}
                                </a>
                            </div>

                        </div>

                        <hr>
                        <div class="form-group">
                            <h4 class="kt-section__title kt-section__title-lg kt-margin-b-0">{{__('inventory::inventory.phases')}}:</h4>
                        </div>
                        @include('inventory::projects.phases-repeater-partial')
                    </div>

                    <!-- Right Side -->
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="kt-section kt-section--last">
                            <div class="kt-section__body">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <div class="btn-group">
                                            <button type="submit" class="btn btn-brand">
                                                <i class="la la-check"></i>
                                                <span class="kt-hidden-mobile">Save</span>
                                            </button>
                                            <button type="submit" class="btn btn-brand dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            </button>
                                            <div class="dropdown-menu dropdown-me
                                        nu-right">
                                                <ul class="kt-nav">
                                                    <li class="kt-nav__item">
                                                        <a href="#" class="kt-nav__link">
                                                            <i class="kt-nav__link-icon flaticon2-reload"></i>
                                                            <span class="kt-nav__link-text">Save & continue</span>
                                                        </a>
                                                    </li>
                                                    <li class="kt-nav__item">
                                                        <a href="#" class="kt-nav__link">
                                                            <i class="kt-nav__link-icon flaticon2-power"></i>
                                                            <span class="kt-nav__link-text">Save & exit</span>
                                                        </a>
                                                    </li>
                                                    <li class="kt-nav__item">
                                                        <a href="#" class="kt-nav__link">
                                                            <i class="kt-nav__link-icon flaticon2-edit-interface-symbol-of-pencil-tool"></i>
                                                            <span class="kt-nav__link-text">Save & edit</span>
                                                        </a>
                                                    </li>
                                                    <li class="kt-nav__item">
                                                        <a href="#" class="kt-nav__link">
                                                            <i class="kt-nav__link-icon flaticon2-add-1"></i>
                                                            <span class="kt-nav__link-text">Save & add new</span>
                                                        </a>
                                                    </li>
                                                </ul>
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
        <div class="col-xl-2"></div>
    </div>
    </form>
@endsection

<!--end::Form-->
@push('scripts')
    <!-- Callback function -->
    <script>
        function createProjectCallback() {
            $('#fast_modal').modal('toggle');
            // Reload datatable
            projects_table.ajax.reload(null, false);
        }
    </script>
    @include('inventory::projects.create-scripts')
@endpush