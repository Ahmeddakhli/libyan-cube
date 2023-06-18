<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title" data-8xloadtitle>{{__('inventory::inventory.create_project')}}</h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="{{route('home')}}" class="kt-subheader__breadcrumbs-main-info"><i class="fa fa-main-info"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>

                @if (auth()->user()->hasPermission('index-inventory-projects'))
                <a href="{{route('inventory.projects.index')}}" data-8xload class="kt-subheader__breadcrumbs-link">{{__('inventory::inventory.projects')}}</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                @else
                <a href="#" class="kt-subheader__breadcrumbs-link">{{__('inventory::inventory.projects')}}</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                @endif

                <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">{{__('inventory::inventory.create_project')}}</span>
            </div>
        </div>
    </div>
    <!-- end:: Subheader -->

    {{-- @livewire('contact-form') --}}

    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Portlet-->
                <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">{{__('inventory::inventory.create_project')}}</h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <a href="{{url()->previous()}}" class="btn btn-clean kt-margin-r-10">
                                <i class="la la-arrow-left"></i>
                                <span class="kt-hidden-mobile">{{__('main.back')}}</span>
                            </a>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <!-- Create Project Form -->
                        <form action="{{route('inventory.projects.store')}}" data-async data-set-autofocus method="POST" id="create_project_form" class="kt-form" data-parsley-validate>
                            @csrf
                            <input type="hidden" name="creation_type" id="creation_type">
                            <div class="row">
                                <div class="col-xl-10 ml-5 mr-5">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="main-info-tab" data-toggle="tab" data-target="#main-info" type="button" role="tab" aria-controls="main-info" aria-selected="true">{{__('inventory::inventory.project_information')}}</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="location-tab" data-toggle="tab" data-target="#location" type="button" role="tab" aria-controls="location" aria-selected="false">{{__('inventory::inventory.location_information')}}</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="financial_information-tab" data-toggle="tab" data-target="#financial_information" type="button" role="tab" aria-controls="financial_information" aria-selected="false">{{__('inventory::inventory.financial_information')}}</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="attachments-tab" data-toggle="tab" data-target="#attachments" type="button" role="tab" aria-controls="attachments" aria-selected="false">{{__('inventory::inventory.attachments')}}</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="unit_types-tab" data-toggle="tab" data-target="#unit_types" type="button" role="tab" aria-controls="unit_types" aria-selected="false">{{__('inventory::inventory.unit_types')}}</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="payment_plans-tab" data-toggle="tab" data-target="#payment_plans" type="button" role="tab" aria-controls="payment_plans" aria-selected="false">{{__('inventory::inventory.payment_plans')}}</button>
                                                </li>
                                            </ul>
                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="main-info" role="tabpanel" aria-labelledby="main-info-tab">
                                                    <div class="form-group row">
                                                        <div class="fancy-checkbox col-4">
                                                            <input name="is_featured" id="is_featured" type="checkbox">
                                                            <label for="is_featured">{{__('inventory::inventory.is_featured')}}</label>
                                                        </div>
                                                        <div class="fancy-checkbox col-4">
                                                            <input name="in_discover_by" id="in_discover_by" type="checkbox">
                                                            <label for="in_discover_by">{{__('main.what_do_we_offer')}}</label>
                                                        </div>
                                                        <div class="fancy-checkbox col-4">
                                                            <input name="ready_to_move" id="ready_to_move" type="checkbox">
                                                            <label for="ready_to_move">{{__('main.ready_to_move')}}</label>
                                                        </div>
                                                        <!-- Developer -->
                                                        <div class="form-group col-4">
                                                            <label class="col-12 control-label" for="developer_id">{{__('inventory::inventory.developer')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <div class="col-12">
                                                                <input type="text" id="developer_id" name="developer_id" data-parsley-trigger="change focusout" class="form-control" data-role="tagsinput" />
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <label>{{trans('inventory::inventory.delivery_date')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <input name="delivery_date" autocomplete="off" class="form-control datepicker-init" placeholder="{{trans('inventory::inventory.select_delivery_date')}}" data-parsley-trigger="change focusout" />
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="finished_status">{{__('inventory::inventory.finished_status')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <select class="form-control selectpicker" data-live-search="true" id="finished_status" name="finished_status" data-parsley-trigger="change focusout">
                                                                <option value="" selected disabled>{{__('inventory::inventory.select_finished_status')}}</option>
                                                                <option value="1">{{trans('inventory::inventory.finished')}}</option>
                                                                <option value="0">{{trans('inventory::inventory.not_finished')}}</option>
                                                            </select>
                                                        </div>
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
                                                        <div class="col-4">
                                                            <label for="facilities">{{__('inventory::inventory.facilities')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <select class="form-control selectpicker" id="facilities" name="facilities[]" data-parsley-trigger="change focusout" multiple="multiple">
                                                                @foreach ($facilities as $facility)
                                                                <option value="{{$facility->id}}">{{$facility->facility}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="amenities">{{__('inventory::inventory.amenities')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <select class="form-control selectpicker" id="amenities" name="amenities[]" multiple="multiple">
                                                                @foreach ($amenities as $amenity)
                                                                <option value="{{$amenity->id}}">{{$amenity->amenity}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="tags">{{__('inventory::inventory.tags')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <select class="form-control selectpicker" id="tags" name="tags[]" data-parsley-trigger="change focusout" multiple="multiple">
                                                                @foreach ($tags as $tag)
                                                                <option value="{{$tag->id}}">{{$tag->tag}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 repeater-project">
                                                        <div data-repeater-list="translations">
                                                            <div data-repeater-item class="row">
                                                                <div class="col-6 form-group">
                                                                    <label for="language_id">{{__('inventory::inventory.language')}}</label>
                                                                    <select class="form-control" id="language_id" name="language_id" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_select_the_language')}}" data-parsley-trigger="change focusout">
                                                                        <option value="" selected disabled>{{__('inventory::inventory.language')}}</option>
                                                                        @foreach ($languages as $language)
                                                                        <option value="{{$language->id}}" @if($language->id == 1) selected @endif>{{$language->code}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="col-6">
                                                                    <label for="project">{{__('inventory::inventory.project')}}</label>
                                                                    <input name="project" id="project" type="text" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_project')}}" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.project_is_required')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('inventory::inventory.project_max_is_150_characters_long')}}">
                                                                </div>
                                                                {{-- <div class="col-6">
                                                                    <label for="second_title">{{__('inventory::inventory.second_title')}}</label>
                                                                    <input name="second_title" id="second_title" type="text" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_second_title')}}" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.second_title_is_required')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('inventory::inventory.second_title_max_is_150_characters_long')}}">
                                                                </div> --}}
                                                                <div class="col-lg-12">
                                                                    <label for="description">{{__('inventory::inventory.description')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                                    <textarea name="description" id="description-0" class="description"></textarea>

                                                                    {{-- <textarea rows="6" name="description" id="description" class="form-control" placeholder="{{__('inventory::inventory.enter_description')}}" data-parsley-maxlength="4294967295" data-parsley-maxlength-message="{{__('inventory::inventory.description_max_is_4294967295_characters_long')}}"></textarea> --}}
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <label for="landing_description">{{__('inventory::inventory.landing_description')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                                    <textarea name="landing_description" id="landing_description-0" class="landing_description"></textarea>

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

                                                </div>
                                                <div class="tab-pane fade" id="location" role="tabpanel" aria-labelledby="location-tab">
                                                    <div class="form-group row">
                                                        <!-- Country -->
                                                        <div class="col-4">
                                                            <label for="country_id">{{__('inventory::inventory.country')}}</label>
                                                            <select class="form-control selectpicker" data-live-search="true" id="country_id" name="country_id" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_select_the_country')}}" data-parsley-errors-container="#country_errors" data-parsley-trigger="change focusout" onchange="getCountryRegions($(this).find(':selected').val())">
                                                                <option value="" selected disabled>{{__('inventory::inventory.select_country')}}</option>
                                                                @foreach ($countries as $country)
                                                                <option value="{{$country->id}}">{{$country->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            <div id="country_errors"></div>

                                                        </div>
                                                        <!-- Region -->
                                                        <div class="col-4">
                                                            <label for="region_id">{{__('inventory::inventory.region')}}</label>
                                                            <select class="form-control selectpicker" data-live-search="true" id="region_id" name="region_id" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_select_the_region')}}" data-parsley-errors-container="#region_errors" data-parsley-trigger="change focusout" onchange="getRegionCities($(this).find(':selected').val())">
                                                                <option value="" selected disabled>{{__('inventory::inventory.select_region')}}</option>
                                                                {{-- @foreach ($regions as $region)
                                                                <option value="{{$region->id}}">{{$region->name}}</option>
                                                                @endforeach --}}
                                                            </select>
                                                            <div id="region_errors"></div>

                                                        </div>

                                                        <!-- City -->
                                                        <div class="col-4">
                                                            <label for="city_id">{{__('inventory::inventory.city')}}</label>
                                                            <select class="form-control selectpicker" data-live-search="true" id="city_id" name="city_id" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_select_the_city')}}" data-parsley-errors-container="#city_errors" data-parsley-trigger="change focusout">
                                                                <option value="" selected disabled>{{__('inventory::inventory.select_city')}}</option>
                                                                {{-- @foreach ($cities as $city)
                                                                <option value="{{$city->id}}">{{$city->name}}</option>
                                                                @endforeach --}}
                                                            </select>
                                                             <div id="city_errors"></div>
                                                        </div>
                                                        <!-- Area -->
                                                        <!-- <div class="col-4">
                                                        <label for="area_id">{{__('inventory::inventory.area')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                        <select class="form-control selectpicker" data-live-search="true" id="area_id" name="area_id" data-parsley-trigger="change focusout">
                                                            <option value="" selected disabled>{{__('inventory::inventory.select_area')}}</option>

                                                        </select>
                                                    </div> -->
                                                        <!-- Address -->
                                                        <div class="col-lg-4">
                                                            <label>{{__('inventory::inventory.address')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <input name="address" id="address" class="form-control" placeholder="{{__('inventory::inventory.enter_address')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="191" data-parsley-maxlength-message="{{__('inventory::inventory.address_max_is_16777215_characters_long')}}" />
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
                                                <div class="tab-pane fade" id="financial_information" role="tabpanel" aria-labelledby="financial_information-tab">
                                                    <div class="form-group row">
                                                        <!-- Down Payment -->
                                                        <div class="col-6">
                                                            <label for="down_payment_from">{{__('inventory::inventory.down_payment')}} % <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <input name="down_payment_from" id="down_payment_from" type="number" class="form-control" placeholder="{{__('inventory::inventory.enter_down_payment')}}" data-parsley-trigger="change focusout">
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
                                                            <label for="number_of_installments_from">{{__('inventory::inventory.installments_years')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                            <input name="number_of_installments_from" step="0.01" id="number_of_installments_from" type="number" class="form-control" placeholder="{{__('inventory::inventory.installments_years')}}" data-parsley-trigger="change focusout">
                                                        </div>
                                                        <!-- <div class="col-6">
                                                        <label for="number_of_installments_to">{{__('inventory::inventory.number_of_installments_to')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                        <input name="number_of_installments_to" id="number_of_installments_to" type="number" class="form-control" placeholder="{{__('inventory::inventory.enter_number_of_installments')}}" data-parsley-trigger="change focusout">
                                                    </div> -->

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

                                                </div>
                                                <div class="tab-pane fade" id="attachments" role="tabpanel" aria-labelledby="attachments-tab">
                                                    <div class="form-group row">
                                                        <div class="col-4">
                                                            <label for="video">{{__('inventory::inventory.video')}}</label> - <small>{{__('settings::settings.embed')}}</small>
                                                            <textarea name="video" class="form-control" id="video" data-parsley-trigger="change focusout"></textarea>
                                                        </div>
                                                        {{-- <div class="col-4">
                                                            <label for="landing_page_image" class="row">{{__('inventory::inventory.landing_page_image')}}</label>
                                                            <input type="file" name="landing_page_image" class="form-control" id="landing_page_image"  data-parsley-required-message="صورة الوحدة مطلوبة" data-parsley-trigger="change focusout" />
                                                            <label for="image"><strong>{{__('settings::settings.image_dimensions')}}:749 × 300 px</strong></label>

                                                        </div> --}}
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="col-12 box">
                                                                    <label for="attachments">{{__('inventory::inventory.attachments')}} </label>
                                                                    <input type="file" name="attachments[][file]" multiple class="" id="attachments" data-parsley-trigger="change focusout" />
                                                                    <div class="input-attachments" style="padding-top: .5rem;"></div>
                                                                </div>
                                                                <label for="image"><strong>{{__('settings::settings.image_dimensions')}}:835 × 467 px</strong></label>

                                                                {{-- <div class="tab-pane fade" id="attachments" role="tabpanel" aria-labelledby="attachments-tab"> --}}


                                                                {{-- </div> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="unit_types" role="tabpanel" aria-labelledby="unit_types-tab">
                                                    <div class="form-group col-12">
                                                        @include('inventory::projects.unit-type-repeater-partial')
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="payment_plans" role="tabpanel" aria-labelledby="payment_plans-tab">
                                                    <div class="form-group col-12">
                                                        @include('inventory::projects.payment-plan-partial')
                                                    </div>
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
                                <div class="col-xl-2"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end:: Content -->

</div>
