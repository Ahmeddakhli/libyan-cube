@extends('dashboard.layouts.basic')

@section('content')
    <!--begin::Form-->
 <form action="{{route('inventory.projects.update')}}" method="POST" id="update_project_form" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="updateProjectCallback" data-parsley-validate>
     @csrf
     <input type="hidden" name="id" id="id" value="{{$i_project->id}}" />
     <div class="row">
         <div class="col-xl-10 ml-5 mr-5">
             <div class="kt-section kt-section--first">
                 <div class="kt-section__body">
                     <div class="col-lg-12 repeater-project">
                         <div data-repeater-list="translations">
                             @foreach($i_project->translations as $trans)
                             <div data-repeater-item class="row">
                                 <div class="col-6 form-group">
                                     <label for="language_id">{{__('inventory::inventory.language')}}</label>
                                     <select class="form-control" id="language_id" name="language_id" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_select_the_language')}}" data-parsley-trigger="change focusout">
                                         <option value="" selected disabled>{{__('inventory::inventory.language')}}</option>
                                         @foreach ($languages as $language)
                                         <option value="{{$language->id}}" @if($trans->language_id == $language->id) selected @endif>{{$language->code}}</option>
                                         @endforeach
                                     </select>
                                 </div>

                                 <div class="col-6">
                                     <label for="project">{{__('inventory::inventory.project')}}</label>
                                     <input name="project" value="{{$trans->project}}" id="project" type="text" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_project')}}" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.project_is_required')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('inventory::inventory.project_max_is_150_characters_long')}}">
                                 </div>
                                 <div class="col-lg-12">
                                     <label for="description">{{__('inventory::inventory.description')}}</label>
                                     <textarea rows="6" name="description" id="description" class="form-control" placeholder="{{__('inventory::inventory.enter_description')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295" data-parsley-maxlength-message="{{__('inventory::inventory.description_max_is_4294967295_characters_long')}}">{{$trans->description}}</textarea>
                                 </div>
                                 <div class="col-6 mt-2">
                                     <label for="meta_title">{{__('inventory::inventory.meta_title')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                     <input name="meta_title" id="meta_title" type="text" class="form-control" placeholder="{{__('inventory::inventory.meta_title')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" value="{{$trans->meta_title}}" data-parsley-maxlength-message="{{__('inventory::inventory.title_max_is_150_characters_long')}}">
                                 </div>
                                 <div class="col-lg-6 mt-2">
                                     <label for="meta_description">{{__('inventory::inventory.meta_description')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                     <textarea rows="6" name="meta_description" id="meta_description" class="form-control" placeholder="{{__('inventory::inventory.meta_description')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295" data-parsley-maxlength-message="{{__('inventory::inventory.description_max_is_4294967295_characters_long')}}">{{$trans->meta_description}}</textarea>
                                 </div>
                                 <div class="col-md-2 col-sm-2">
                                     {{-- <label class="control-label">&nbsp;</label> --}}
                                     <a href="javascript:;" data-repeater-delete class="btn btn-brand data-repeater-delete">
                                         <i class="fa fa-times"></i>
                                     </a>
                                 </div>
                             </div>
                             @endforeach
                             @if(!$i_project->translations->count())
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
                                     <input name="project" value="" id="project" type="text" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_project')}}" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.project_is_required')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('inventory::inventory.project_max_is_150_characters_long')}}">
                                 </div>
                                 <div class="col-lg-12">
                                     <label for="description">{{__('inventory::inventory.description')}}</label>
                                     <textarea rows="6" name="description" id="description" class="form-control" placeholder="{{__('inventory::inventory.enter_description')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295" data-parsley-maxlength-message="{{__('inventory::inventory.description_max_is_4294967295_characters_long')}}"></textarea>
                                 </div>
                                 <div class="col-6 mt-2">
                                     <label for="meta_title">{{__('inventory::inventory.meta_title')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                     <input name="meta_title" id="meta_title" type="text" class="form-control" placeholder="{{__('inventory::inventory.meta_title')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" value="" data-parsley-maxlength-message="{{__('inventory::inventory.title_max_is_150_characters_long')}}">
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
                             @endif
                         </div>
                         <a href="javascript:;" data-repeater-create id="repeater_btn_project" class="btn">
                             <i class="fa fa-plus"></i> {{trans('inventory::inventory.project_trans')}}
                         </a>
                     </div>
                     <div class="form-group m-form__group row">
                        <div class="form-group row">
                            <!-- Developer -->
                            <div class="form-group">
                                <label class="col-12 control-label" for="developer_id">{{__('inventory::inventory.developer')}}</label>
                                <div class="col-12">
                                    <input type="text" id="developer_id" name="developer_id" data-parsley-trigger="change focusout" class="form-control" data-role="tagsinput" />
                                </div>
                            </div>
                        </div>
                         <div class="col-lg-6">
                             <label>{{trans('inventory::inventory.delivery_date')}}</label>
                             <input name="delivery_date" autocomplete="off" class="form-control datetimepicker-init" placeholder="{{trans('inventory::inventory.select_delivery_date')}}" data-parsley-trigger="change focusout" value="{{$i_project->delivery_date}}" />
                         </div>

                     </div>

                     <div class="form-group row">
                         <div class="col-lg-6">
                             <label for="finished_status">{{trans('inventory::inventory.select_finished_status')}}</label>

                             <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="finished_status" name="finished_status" data-parsley-trigger="change focusout">
                                 <option value="" selected disabled>{{trans('inventory::inventory.select_finished_status')}}</option>
                                 <option value="1" @if ($i_project->finished_status) selected @endif >{{trans('inventory::inventory.finished')}}</option>
                                 <option value="0" @if (!$i_project->finished_status) selected @endif >{{trans('inventory::inventory.not_finished')}}</option>
                             </select>
                         </div>
                         <div class="col-lg-6">
                             <label for="country_id">{{__('inventory::inventory.country')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                             <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="country_id" name="country_id" data-parsley-trigger="change focusout" onchange="getCountryRegions($(this).find(':selected').val())">
                                 <option value="" selected disabled>{{__('inventory::inventory.select_country')}}</option>
                                 @foreach ($countries as $country)
                                 <option value="{{$country->id}}" @if ($i_project->country_id == $country->id) selected @endif>{{$country->name}}</option>
                                 @endforeach
                             </select>
                         </div>
                         <div class="col-6">
                             <label for="region_id">{{__('inventory::inventory.region')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                             <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="region_id" name="region_id" data-parsley-trigger="change focusout" onchange="getRegionCities($(this).find(':selected').val())">
                                 <option value="" selected disabled>{{__('inventory::inventory.select_region')}}</option>
                                 {{-- @foreach ($regions as $region)
                        <option value="{{$region->id}}">{{$region->name}}</option>
                                 @endforeach --}}
                             </select>
                         </div>
                         <!-- City -->

                         <div class="col-6">
                             <label for="city_id">{{__('inventory::inventory.city')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                             <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="city_id" name="city_id" data-parsley-trigger="change focusout" onchange="getCityAreas($(this).find(':selected').val())">
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
                         <div class="col-lg-8">
                             <label>{{__('inventory::inventory.address')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                             <input name="address" id="address" class="form-control" placeholder="{{__('inventory::inventory.enter_address')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="191" data-parsley-maxlength-message="{{__('inventory::inventory.address_max_is_16777215_characters_long')}}" value="{{$i_project->address}}" />
                         </div>
                     </div>

                     <!-- Address -->
                     <div class="form-group row">
                         <!-- Map -->
                         <div class="col-lg-12">
                             <label>{{__('inventory::inventory.location')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                             <input id="map_search" name="map_search" class="form-control" type="text" placeholder="{{__('inventory::inventory.enter_a_location')}}">
                             <div id="map" style="height:300px; width:100%;"></div>
                             <input id="lat" name="latitude" type="hidden" value="{{$i_project->latitude}}" />
                             <input id="lng" name="longitude" type="hidden" value="{{$i_project->longitude}}" />
                         </div>
                     </div>
                     <!-- Area Unit -->
                     <div class="form-group row">
                         <div class="col-6">
                             <label for="bi_view_id">{{__('inventory::inventory.area_unit')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                             <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="i_area_unit_id" name="i_area_unit_id" data-parsley-trigger="change focusout">
                                 <option value="" selected disabled>{{__('inventory::inventory.select_area_unit')}}</option>
                                 @foreach ($area_units as $area_unit)
                                 <option value="{{$area_unit->id}}" @if ($i_project->i_area_unit_id == $area_unit->id) selected @endif>{{$area_unit->area_unit}}</option>
                                 @endforeach
                             </select>
                         </div>
                         <div class="col-6">
                             <label for="area_from">{{__('inventory::inventory.area_from')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                             <input name="area_from" id="area_from" type="number" step="0.01" class="form-control" placeholder="{{__('inventory::inventory.enter_area')}}" data-parsley-trigger="change focusout" value="{{$i_project->area_from}}">
                         </div>
                         <div class="col-6">
                             <label for="area_to">{{__('inventory::inventory.area_to')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                             <input name="area_to" id="area_to" type="number" step="0.01" class="form-control" placeholder="{{__('inventory::inventory.enter_area')}}" data-parsley-trigger="change focusout" value="{{$i_project->area_to}}">
                         </div>
                     </div>
                     <!-- Area -->

                     <hr>
                     <div class="form-group row">
                         <h4 class="kt-section__title kt-section__title-lg kt-margin-b-0">{{__('inventory::inventory.is_featured')}}:</h4>
                     </div>
                     <div class="form-group row">
                         <div class="fancy-checkbox">
                             <input name="is_featured" id="is_featured" type="checkbox" @if($i_project->is_featured == 1) checked="checked"@endif>
                             <label for="is_featured">{{__('inventory::inventory.is_featured')}}</label>
                         </div>
                     </div>
                     <hr>
                     <!-- Price -->
                     <div class="form-group row">
                         <div class="col-6">
                             <label for="price_from">{{__('inventory::inventory.price_from')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                             <input name="price_from" id="price_from" type="number" class="form-control" placeholder="{{__('inventory::inventory.enter_price')}}" data-parsley-trigger="change focusout" value="{{$i_project->price_from}}">
                         </div>
                         <div class="col-6">
                             <label for="price_to">{{__('inventory::inventory.price_to')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                             <input name="price_to" id="price_to" type="number" class="form-control" placeholder="{{__('inventory::inventory.enter_price')}}" data-parsley-trigger="change focusout" value="{{$i_project->price_to}}">
                         </div>
                     </div>
                     <div class="form-group row">
                         <div class="col-lg-6">
                             <label for="currency_code">{{__('inventory::inventory.currency_code')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                             <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="currency_code" name="currency_code" data-parsley-trigger="change focusout">
                                 <option value="" selected disabled>{{trans('inventory::inventory.select_currency_code')}}</option>
                                 @for ($i = 0; $i < count($currency_codes); $i++) <option value="{{$currency_codes[$i]}}" @if ($i_project->currency_code == $currency_codes[$i]) selected @endif>{{$currency_codes[$i]}}</option>
                                     @endfor
                             </select>
                         </div>
                         <!-- Number of Installments -->

                         <div class="col-6">
                             <label for="number_of_installments_from">{{__('inventory::inventory.number_of_installments_from')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                             <input name="number_of_installments_from" id="number_of_installments_from" type="number" class="form-control" placeholder="{{__('inventory::inventory.enter_number_of_installments')}}" data-parsley-trigger="change focusout" value="{{$i_project->number_of_installments_from}}">
                         </div>
                         <div class="col-6">
                             <label for="number_of_installments_to">{{__('inventory::inventory.number_of_installments_to')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                             <input name="number_of_installments_to" id="number_of_installments_to" type="number" class="form-control" placeholder="{{__('inventory::inventory.enter_number_of_installments')}}" data-parsley-trigger="change focusout" value="{{$i_project->number_of_installments_to}}">
                         </div>
                     </div>

                     <div class="form-group row">
                         <div class="col-6">
                             <label for="down_payment">{{__('inventory::inventory.down_payment_from')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                             <input name="down_payment_from" id="down_payment_from" type="number" class="form-control" placeholder="{{__('inventory::inventory.enter_down_payment')}}" data-parsley-trigger="change focusout" value="{{$i_project->down_payment_from}}">
                         </div>
                         <div class="col-6">
                             <label for="down_payment_to">{{__('inventory::inventory.down_payment_to')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                             <input name="down_payment_to" id="down_payment_to" type="number" class="form-control" placeholder="{{__('inventory::inventory.enter_down_payment')}}" data-parsley-trigger="change focusout" value="{{$i_project->down_payment_to}}">
                         </div>
                     </div>

                     <hr>
                     <div class="form-group">
                         <h4 class="kt-section__title kt-section__title-lg kt-margin-b-0">{{__('inventory::inventory.facilities_and_amenities')}}:</h4>
                     </div>
                     <div class="form-group row">
                         <div class="col-lg-6">
                             <label for="facilities">{{__('inventory::inventory.facilities')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                             <select class="form-control m-select2" id="facilities" name="facilities[]" data-parsley-trigger="change focusout" multiple="multiple">
                                 @foreach ($facilities as $facility)
                                 <option value="{{$facility->id}}" @if (in_array($facility->id, $i_project->facilities->pluck('id')->toArray())) selected @endif>{{$facility->facility}}</option>
                                 @endforeach
                             </select>
                         </div>
                         <!-- Amenities -->

                         <div class="col-lg-6">
                             <label for="amenities">{{__('inventory::inventory.amenities')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                             <select class="form-control m-select2" id="amenities" name="amenities[]" multiple="multiple">
                                 @foreach ($amenities as $amenity)
                                 <option value="{{$amenity->id}}" @if (in_array($amenity->id, $i_project->amenities->pluck('id')->toArray())) selected @endif>{{$amenity->amenity}}</option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                     <!-- Tags -->

                     <hr>
                     <div class="form-group">
                         <h4 class="kt-section__title kt-section__title-lg kt-margin-b-0">{{__('inventory::inventory.tags')}}:</h4>
                     </div>
                     <div class="form-group row">
                         <div class="col-12">
                             <label for="tags">{{__('inventory::inventory.tags')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                             <select class="form-control m-select2" id="tags" name="tags[]" data-parsley-trigger="change focusout" multiple="multiple">
                                 @foreach ($tags as $tag)
                                 <option value="{{$tag->id}}" @if (in_array($tag->id, $i_project->tags->pluck('id')->toArray())) selected @endif>{{$tag->tag}}</option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                     <!-- Tags -->

                     <!-- Attachments -->
                     <div class="form-group">
                         <h4 class="kt-section__title kt-section__title-lg kt-margin-b-0">{{__('inventory::inventory.attachments')}}:</h4>
                     </div>
                     <hr>
                     <div class="form-group row">
                         <hr>
                         <!-- Attachments -->
                         <div class="col-12 repeater-attachments">
                             <div data-repeater-list="attachments">
                                 <div data-repeater-item class="row">
                                     <div class="col-6">
                                         <label for="order">{{__('inventory::inventory.order')}}</label>
                                         <input name="order" id="order" type="number" class="form-control" placeholder="{{__('inventory::inventory.order')}}"  data-parsley-trigger="change focusout">
                                     </div>
                                     <div class="col-lg-4">
                                         {{-- <div class="form-group">
                                    <h4 class="kt-section__title kt-section__title-lg kt-margin-b-0">{{__('inventory::inventory.attachments')}}:</h4>
                                     </div> --}}
                                     <div class="row">
                                         <div class="box">
                                             <label for="attachments">{{__('inventory::inventory.attachments')}}</label>
                                             <input type="file" name="file" class="" id="attachments" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.attachments')}}" data-parsley-trigger="change focusout" />

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
                     <div class="col-12 repeater-floorplans">
                         <div data-repeater-list="floorplans">
                             <div data-repeater-item class="row">
                                 <div class="col-6">
                                     <label for="order">{{__('inventory::inventory.order')}}</label>
                                     <input name="order" id="order" type="number" class="form-control" placeholder="{{__('inventory::inventory.order')}}"  data-parsley-trigger="change focusout">
                                 </div>
                                 <div class="col-lg-4">
                                     {{-- <div class="form-group">
                                    <h4 class="kt-section__title kt-section__title-lg kt-margin-b-0">{{__('inventory::inventory.floor_plans')}}:</h4>
                                 </div> --}}
                                 <div class="row">
                                     <div class="box">
                                         <label for="floor_plnas">{{__('inventory::inventory.floor_plans')}}</label>
                                         <input type="file" name="file" class="" id="floor_plans" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.attachments')}}" data-parsley-trigger="change focusout" />

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
                 <br>
                 <!-- Master Plans -->
                 <div class="col-12 repeater-masterplans">
                     <div data-repeater-list="masterplans">
                         <div data-repeater-item class="row">
                             <div class="col-6">
                                 <label for="order">{{__('inventory::inventory.order')}}</label>
                                 <input name="order" id="order" type="number" class="form-control" placeholder="{{__('inventory::inventory.order')}}"  data-parsley-trigger="change focusout">
                             </div>
                             <div class="col-lg-4">
                                 {{-- <div class="form-group">
                                    <h4 class="kt-section__title kt-section__title-lg kt-margin-b-0">{{__('inventory::inventory.master_plans')}}:</h4>
                             </div> --}}
                             <div class="row">
                                 <div class="box">
                                     <label for="master_plans">{{__('inventory::inventory.master_plans')}}</label>
                                     <input type="file" name="file" class="" id="master_plans" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.attachments')}}" data-parsley-trigger="change focusout" />

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

         <!-- Images -->
         <div class="form-group d-flex flex-wrap">
             <div class="m-form__group col-6 ">
                 <label for="attachment" class="h3">{{trans('inventory::inventory.attachments')}}</label>
                 <div class="card-columns" id="attachment">
                     @foreach ($i_project->attachmentables as $attachment)
                     @if($attachment->type == 'attachment')
                     <div class="card" id="card-{{$attachment->id}}">
                         <a class="html5lightbox" title="" data-group="image_group" href="#" data-width="1200" data-height="1200" title="{{trans('inventory::inventory.view_image')}}">
                             <img class="card-img-top" src="{{asset('storage/'.$attachment->path)}}" alt="{{trans('inventory::inventory.image')}}">
                         </a>
                         <div class="card-body" style="text-align: center !important;">
                             {{-- <h5 class="card-title">Card title that wraps to a new line</h5> --}}
                             {{-- <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> --}}
                             <button type="button" class="btn btn-danger" onclick="deleteAttachmentables({{$attachment->id}});"><i class="fas fa-trash-alt"></i> {{trans('inventory::inventory.delete')}}</button>
                         </div>
                     </div>
                     @endif
                     @endforeach
                 </div>
             </div>
             <div class="m-form__group col-6 row">
                 <label for="floorplans" class="h3">{{trans('inventory::inventory.floor_plans')}}</label>
                 <div class="card-columns" id="floorplans">
                     @foreach ($i_project->attachmentables as $attachment)
                     @if($attachment->type == 'floorplan')
                     <div class="card" id="card-{{$attachment->id}}">
                         <a class="html5lightbox" title="" data-group="image_group" href="#" data-width="1200" data-height="1200" title="{{trans('inventory::inventory.view_image')}}">
                             <img class="card-img-top" src="{{asset('storage/'.$attachment->path)}}" alt="{{trans('inventory::inventory.image')}}">
                         </a>
                         <div class="card-body" style="text-align: center !important;">
                             {{-- <h5 class="card-title">Card title that wraps to a new line</h5> --}}
                             {{-- <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> --}}
                             <button type="button" class="btn btn-danger" onclick="deleteAttachmentables({{$attachment->id}});"><i class="fas fa-trash-alt"></i> {{trans('inventory::inventory.delete')}}</button>
                         </div>

                     </div>
                     @endif
                     @endforeach
                 </div>
             </div>
             <div class="m-form__group col-6 ">
                 <label for="masterplans" class="h3">{{trans('inventory::inventory.master_plans')}}</label>
                 <div class="card-columns" id="masterplans">
                     @foreach ($i_project->attachmentables as $attachment)
                     @if($attachment->type == 'masterplan')
                     <div class="card" id="card-{{$attachment->id}}">
                         <a class="html5lightbox" title="" data-group="image_group" href="#" data-width="1200" data-height="1200" title="{{trans('inventory::inventory.view_image')}}">
                             <img class="card-img-top" src="{{asset('storage/'.$attachment->path)}}" alt="{{trans('inventory::inventory.image')}}">
                         </a>
                         <div class="card-body" style="text-align: center !important;">
                             {{-- <h5 class="card-title">Card title that wraps to a new line</h5> --}}
                             {{-- <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> --}}
                             <button type="button" class="btn btn-danger" onclick="deleteAttachmentables({{$attachment->id}});"><i class="fas fa-trash-alt"></i> {{trans('inventory::inventory.delete')}}</button>
                         </div>
                     </div>
                     @endif
                     @endforeach
                 </div>
             </div>
         </div>
         <div class="for-group">
             <hr>
             <div class="form-group">
                 <h4 class="kt-section__title kt-section__title-lg kt-margin-b-0">{{__('inventory::inventory.phases')}}:</h4>
             </div>
             @include('inventory::projects.phases-repeater-update')
         </div>
         <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
             <div class="m-form__actions m-form__actions--solid">
                 <div class="row">
                     <div class="col-lg-6">
                         <button type="submit" class="btn btn-success btn-brand">{{trans('inventory::inventory.update_project')}}</button>
                     </div>
                 </div>
             </div>
         </div>
     </div>
</div>
</div>
</div>
</form>
@endsection

@push('scripts')
    <!-- Callback function -->
    <script>
        function updateProjectCallback() {
            $('#fast_modal').modal('toggle');
            // Reload datatable
            projects_table.ajax.reload(null, false);
        }
    </script>
    @include('inventory::projects.update-scripts')
@endpush