 <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
     <!-- begin:: Subheader -->
     <div class="kt-subheader   kt-grid__item" id="kt_subheader">
         <div class="kt-subheader__main">
             <h3 class="kt-subheader__title" data-8xloadtitle>{{__('inventory::inventory.update_project')}}</h3>
             <span class="kt-subheader__separator kt-hidden"></span>
             <div class="kt-subheader__breadcrumbs">
                 <a href="{{route('home')}}" class="kt-subheader__breadcrumbs-home"><i class="fa fa-home"></i></a>
                 <span class="kt-subheader__breadcrumbs-separator"></span>

                 @if (auth()->user()->hasPermission('index-inventory-projects'))
                 <a href="{{route('inventory.projects.index')}}" data-8xload class="kt-subheader__breadcrumbs-link">{{__('inventory::inventory.projects')}}</a>
                 <span class="kt-subheader__breadcrumbs-separator"></span>
                 @else
                 <a href="#" class="kt-subheader__breadcrumbs-link">{{__('inventory::inventory.projects')}}</a>
                 <span class="kt-subheader__breadcrumbs-separator"></span>
                 @endif

                 <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">{{__('inventory::inventory.update_project')}}</span>
             </div>
         </div>
     </div>
     <div class="kt-contenter  kt-grid__item kt-grid__item--fluid" id="kt_content">
         <div class="row">
             <div class="col-lg-12">
                 <!--begin::Portlet-->
                 <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile">
                     <div class="kt-portlet__head kt-portlet__head--lg">
                         <div class="kt-portlet__head-label">
                             <h3 class="kt-portlet__head-title">{{__('inventory::inventory.update_project')}}</h3>
                         </div>
                         <div class="kt-portlet__head-toolbar">
                             <a href="{{url()->previous()}}" data-8xload class="btn btn-clean kt-margin-r-10">
                                 <i class="la la-arrow-left"></i>
                                 <span class="kt-hidden-mobile">{{__('main.back')}}</span>
                             </a>
                         </div>
                     </div>
                     <div class="kt-portlet__body">
                         <!--begin::Form-->
                         <form action="{{route('inventory.projects.update')}}" method="POST" id="update_project_form" class="kt-form m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="updateProjectCallback" data-parsley-validate>
                             @csrf
                             <input type="hidden" name="creation_type" id="creation_type">
                             <input type="hidden" name="id" id="id" value="{{$i_project->id}}" />
                             <div class="row">
                                 <div class="col-xl-10 ml-5 mr-5">
                                     <div class="kt-section kt-section--first">
                                         <div class="kt-section__body">
                                             <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                 <li class="nav-item" role="presentation">
                                                     <button class="nav-link active" id="main-info-tab" data-toggle="tab" data-target="#main-info" type="button" role="tab" aria-controls="main-info" aria-selected="true">{{__('inventory::inventory.project_information')}}</button>
                                                 </li>
                                                 <li class="nav-item" role="presentation">
                                                     <button class="nav-link" id="location_information-tab" data-toggle="tab" data-target="#location_information" type="button" role="tab" aria-controls="location_information" aria-selected="false">{{__('inventory::inventory.location_information')}}</button>
                                                 </li>
                                                 <li class="nav-item" role="presentation">
                                                     <button class="nav-link" id="attachments-tab" data-toggle="tab" data-target="#attachments" type="button" role="tab" aria-controls="attachments" aria-selected="false">{{__('inventory::inventory.attachments')}}</button>
                                                 </li>
                                                 <li class="nav-item" role="presentation">
                                                     <button class="nav-link" id="financial_information-tab" data-toggle="tab" data-target="#financial_information" type="button" role="tab" aria-controls="financial_information" aria-selected="false">{{__('inventory::inventory.financial_information')}}</button>
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
                                                             <input name="is_featured" id="is_featured" type="checkbox" @if($i_project->is_featured == 1) checked="checked"@endif>
                                                             <label for="is_featured">{{__('inventory::inventory.is_featured')}}</label>
                                                         </div>
                                                         <div class="fancy-checkbox col-4">
                                                             <input name="in_discover_by" id="in_discover_by" type="checkbox" @if($i_project->in_discover_by == 1) checked="checked"@endif>
                                                             <label for="in_discover_by">{{__('main.what_do_we_offer')}}</label>
                                                         </div>
                                                         <div class="fancy-checkbox col-4">
                                                             <input name="ready_to_move" id="ready_to_move" type="checkbox" @if($i_project->ready_to_move == 1) checked="checked"@endif>
                                                             <label for="ready_to_move">{{__('main.ready_to_move')}}</label>
                                                         </div>
                                                         <!-- Developer -->
                                                         <div class="form-group col-4">
                                                             <label class="col-12 control-label" for="developer_id">{{__('inventory::inventory.developer')}}</label>
                                                             <div class="col-12">
                                                                 <input type="text" id="developer_id" name="developer_id" data-parsley-trigger="change focusout" class="form-control" data-role="tagsinput" />
                                                             </div>
                                                         </div>
                                                         <div class="col-4">
                                                             <label>{{trans('inventory::inventory.delivery_date')}}</label>
                                                             <input name="delivery_date" autocomplete="off" class="form-control datepicker-init" placeholder="{{trans('inventory::inventory.select_delivery_date')}}" data-parsley-trigger="change focusout" value="{{$i_project->delivery_date}}" />
                                                         </div>

                                                         <div class="col-4">
                                                             <label for="finished_status">{{trans('inventory::inventory.select_finished_status')}}</label>

                                                             <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="finished_status" name="finished_status" data-parsley-trigger="change focusout">
                                                                 <option value="" selected disabled>{{trans('inventory::inventory.select_finished_status')}}</option>
                                                                 <option value="1" @if ($i_project->finished_status) selected @endif >{{trans('inventory::inventory.finished')}}</option>
                                                                 <option value="0" @if (!$i_project->finished_status) selected @endif >{{trans('inventory::inventory.not_finished')}}</option>
                                                             </select>
                                                         </div>
                                                         <div class="col-4">
                                                             <label for="bi_view_id">{{__('inventory::inventory.area_unit')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                             <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="i_area_unit_id" name="i_area_unit_id" data-parsley-trigger="change focusout">
                                                                 <option value="" selected disabled>{{__('inventory::inventory.select_area_unit')}}</option>
                                                                 @foreach ($area_units as $area_unit)
                                                                 <option value="{{$area_unit->id}}" @if ($i_project->i_area_unit_id == $area_unit->id) selected @endif>{{$area_unit->area_unit}}</option>
                                                                 @endforeach
                                                             </select>
                                                         </div>
                                                         <div class="col-4">
                                                             <label for="area_from">{{__('inventory::inventory.area_from')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                             <input name="area_from" id="area_from" step="0.01" type="number" class="form-control" placeholder="{{__('inventory::inventory.enter_area')}}" data-parsley-trigger="change focusout" value="{{$i_project->area_from}}">
                                                         </div>
                                                         <div class="col-4">
                                                             <label for="area_to">{{__('inventory::inventory.area_to')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                             <input name="area_to" id="area_to" step="0.01" type="number" class="form-control" placeholder="{{__('inventory::inventory.enter_area')}}" data-parsley-trigger="change focusout" value="{{$i_project->area_to}}">
                                                         </div>
                                                         <div class="col-4">
                                                             <label for="facilities">{{__('inventory::inventory.facilities')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                             <select class="form-control selectpicker" id="facilities" name="facilities[]" data-parsley-trigger="change focusout" multiple="multiple">
                                                                 @foreach ($facilities as $facility)
                                                                 <option value="{{$facility->id}}" @if (in_array($facility->id, $i_project->facilities->pluck('id')->toArray())) selected @endif>{{$facility->facility}}</option>
                                                                 @endforeach
                                                             </select>
                                                         </div>
                                                         <!-- Amenities -->

                                                         <div class="col-4">
                                                             <label for="amenities">{{__('inventory::inventory.amenities')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                             <select class="form-control selectpicker" id="amenities" name="amenities[]" multiple="multiple">
                                                                 @foreach ($amenities as $amenity)
                                                                 <option value="{{$amenity->id}}" @if (in_array($amenity->id, $i_project->amenities->pluck('id')->toArray())) selected @endif>{{$amenity->amenity}}</option>
                                                                 @endforeach
                                                             </select>
                                                         </div>

                                                         <div class="col-4">
                                                             <label for="tags">{{__('inventory::inventory.tags')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                             <select class="form-control selectpicker" id="tags" name="tags[]" data-parsley-trigger="change focusout" multiple="multiple">
                                                                 @foreach ($tags as $tag)
                                                                 <option value="{{$tag->id}}" @if (in_array($tag->id, $i_project->tags->pluck('id')->toArray())) selected @endif>{{$tag->tag}}</option>
                                                                 @endforeach
                                                             </select>
                                                         </div>

                                                         <div class="col-lg-12 repeater-project">
                                                             <div data-repeater-list="translations">
                                                                 @foreach($i_project->translations as $index => $trans)
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
                                                                     {{-- <div class="col-6">
                                                                         <label for="second_title">{{__('inventory::inventory.second_title')}}</label>
                                                                         <input name="second_title" value="{{$trans->second_title}}" id="second_title" type="text" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_second_title')}}" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.second_title_is_required')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('inventory::inventory.second_title_max_is_150_characters_long')}}">
                                                                     </div> --}}
                                                                     <div class="col-lg-12">
                                                                         <label for="description">{{__('inventory::inventory.description')}}</label>
                                                                         <textarea name="description" id="description-{{$index}}" class="description">{{$trans->description}}</textarea>
                                                                         {{-- <textarea rows="6" name="description" id="description" class="form-control" placeholder="{{__('inventory::inventory.enter_description')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295" data-parsley-maxlength-message="{{__('inventory::inventory.description_max_is_4294967295_characters_long')}}">{{$trans->description}}</textarea> --}}
                                                                     </div>
                                                                     <div class="col-lg-12">
                                                                         <label for="landing_description">{{__('inventory::inventory.landing_description')}}</label>
                                                                         <textarea name="landing_description" id="landing_description-{{$index}}" class="landing_description">{{$trans->landing_description}}</textarea>
                                                                         {{-- <textarea rows="6" name="landing_description" id="landing_description" class="form-control" placeholder="{{__('inventory::inventory.enter_description')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295" data-parsley-maxlength-message="{{__('inventory::inventory.description_max_is_4294967295_characters_long')}}">{{$trans->description}}</textarea> --}}
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
                                                                     <div class="col-6">
                                                                         <label for="second_title">{{__('inventory::inventory.second_title')}}</label>
                                                                         <input name="second_title" id="second_title" type="text" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_second_title')}}" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.second_title_is_required')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('inventory::inventory.second_title_max_is_150_characters_long')}}">
                                                                     </div>
                                                                     <div class="col-lg-12">
                                                                         <label for="description">{{__('inventory::inventory.description')}}</label>
                                                                         <textarea name="description" id="description-0" class="description"></textarea>
                                                                         {{-- <textarea rows="6" name="description" id="description" class="form-control" placeholder="{{__('inventory::inventory.enter_description')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295" data-parsley-maxlength-message="{{__('inventory::inventory.description_max_is_4294967295_characters_long')}}"></textarea> --}}
                                                                     </div>
                                                                     <div class="col-lg-12">
                                                                         <label for="landing_description">{{__('inventory::inventory.landing_description')}}</label>
                                                                         <textarea name="landing_description" id="landing_description-0" class="landing_description"></textarea>
                                                                         {{-- <textarea rows="6" name="landing_description" id="landing_description" class="form-control" placeholder="{{__('inventory::inventory.enter_description')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295" data-parsley-maxlength-message="{{__('inventory::inventory.description_max_is_4294967295_characters_long')}}"></textarea> --}}
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
                                                     </div>
                                                 </div>
                                                 <div class="tab-pane fade" id="location_information" role="tabpanel" aria-labelledby="location_information-tab">
                                                     <div class="form-group row">

                                                         <div class="col-4">
                                                             <label for="country_id">{{__('inventory::inventory.country')}}</label>
                                                             <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="country_id" name="country_id" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_select_the_country')}}" data-parsley-errors-container="#country_errors" data-parsley-trigger="change focusout" onchange="if($(this).find(':selected').val()){getCountryRegions($(this).find(':selected').val())}">
                                                                 <option value="" selected disabled>{{__('inventory::inventory.select_country')}}</option>
                                                                 @foreach ($countries as $country)
                                                                 <option value="{{$country->id}}" @if ($i_project->country_id == $country->id) selected @endif>{{$country->name}}</option>
                                                                 @endforeach
                                                             </select>
                                                            <div id="country_errors"></div>
                                                         </div>
                                                         <div class="col-4">
                                                             <label for="region_id">{{__('inventory::inventory.region')}}</label>
                                                             <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="region_id" name="region_id" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_select_the_region')}}" data-parsley-errors-container="#region_errors" data-parsley-trigger="change focusout" onchange="if($(this).find(':selected').val()){getRegionCities($(this).find(':selected').val())}">
                                                                 <option value="" selected disabled>{{__('inventory::inventory.select_region')}}</option>
                                                                @if($regions)
                                                                @foreach ($regions as $region)
                                                                <option value="{{$region->id}}" @if(isset($i_project->region_id) && $i_project->region_id == $region->id) selected @endif>{{$region->name}}</option>
                                                                @endforeach
                                                                @endif
                                                             </select>
                                                            <div id="region_errors"></div>
                                                         </div>
                                                         <!-- City -->

                                                         <div class="col-4">
                                                             <label for="city_id">{{__('inventory::inventory.city')}}</label>
                                                             <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="city_id" name="city_id" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_select_the_city')}}" data-parsley-errors-container="#city_errors" data-parsley-trigger="change focusout">
                                                                 <option value="" selected disabled>{{__('inventory::inventory.select_city')}}</option>
                                                                @if($cities)
                                                                @foreach ($cities as $city)
                                                                <option value="{{$city->id}}" @if(isset($i_project->city_id) && $i_project->city_id == $city->id) selected @endif>{{$city->name}}</option>
                                                                @endforeach
                                                                @endif
                                                             </select>
                                                                 <div id="city_errors"></div>
                                                         </div>
                                                         <!-- Area -->
                                                         <!-- <div class="col-4">
                                                                            <label for="area_id">{{__('inventory::inventory.area')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                                            <select class="form-control selectpicker" data-live-search="true" id="area_id" name="area_id" data-parsley-trigger="change focusout">
                                                                                <option value="" selected disabled>{{__('inventory::inventory.select_area')}}</option>
                                                                                                                                                @if($area_places)
                                                                @foreach ($area_places as $area_place)
                                                                    <option value="{{$area_place->id}}" @if(isset($i_project->area_place_id) && $i_project->area_place_id == $area_place->id) selected @endif>{{$area_place->name}}</option>
                                                                @endforeach
                                                                @endif
                                                                            </select>
                                                                        </div> -->
                                                         <div class="col-4">
                                                             <label>{{__('inventory::inventory.address')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                             <input name="address" id="address" class="form-control" placeholder="{{__('inventory::inventory.enter_address')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="191" data-parsley-maxlength-message="{{__('inventory::inventory.address_max_is_16777215_characters_long')}}" value="{{$i_project->address}}" />
                                                         </div>

                                                         <!-- Map -->
                                                         <div class="col-lg-12">
                                                             <label>{{__('inventory::inventory.location')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                             <input id="map_search" name="map_search" class="form-control" type="text" placeholder="{{__('inventory::inventory.enter_a_location')}}">
                                                             <div id="map" style="height:300px; width:100%;"></div>
                                                             <input id="lat" name="latitude" type="hidden" value="{{$i_project->latitude}}" />
                                                             <input id="lng" name="longitude" type="hidden" value="{{$i_project->longitude}}" />
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="tab-pane fade" id="financial_information" role="tabpanel" aria-labelledby="financial_information-tab">
                                                     <!-- Price -->
                                                     <div class="form-group row">
                                                         <div class="col-4">
                                                             <label for="price_from">{{__('inventory::inventory.price_from')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                             <input name="price_from" id="price_from" type="number" class="form-control" placeholder="{{__('inventory::inventory.enter_price')}}" data-parsley-trigger="change focusout" value="{{$i_project->price_from}}">
                                                         </div>
                                                         <div class="col-4">
                                                             <label for="price_to">{{__('inventory::inventory.price_to')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                             <input name="price_to" id="price_to" type="number" class="form-control" placeholder="{{__('inventory::inventory.enter_price')}}" data-parsley-trigger="change focusout" value="{{$i_project->price_to}}">
                                                         </div>
                                                         <div class="col-4">
                                                             <label for="currency_code">{{__('inventory::inventory.currency_code')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                             <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="currency_code" name="currency_code" data-parsley-trigger="change focusout">
                                                                 <option value="" selected disabled>{{trans('inventory::inventory.select_currency_code')}}</option>
                                                                 @for ($i = 0; $i < count($currency_codes); $i++) <option value="{{$currency_codes[$i]}}" @if ($i_project->currency_code == $currency_codes[$i]) selected @endif>{{$currency_codes[$i]}}</option>
                                                                     @endfor
                                                             </select>
                                                         </div>
                                                         <!-- Number of Installments -->

                                                         <div class="col-4">
                                                             <label for="number_of_installments_from">{{__('inventory::inventory.installments_years')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                             <input name="number_of_installments_from" step="0.01" id="number_of_installments_from" type="number" class="form-control" placeholder="{{__('inventory::inventory.installments_years')}}" data-parsley-trigger="change focusout" value="{{$i_project->number_of_installments_from}}">
                                                         </div>
                                                         <!-- <div class="col-6">
                                                     <label for="number_of_installments_to">{{__('inventory::inventory.number_of_installments_to')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                     <input name="number_of_installments_to" id="number_of_installments_to" type="number" class="form-control" placeholder="{{__('inventory::inventory.enter_number_of_installments')}}" data-parsley-trigger="change focusout" value="{{$i_project->number_of_installments_to}}">
                                                    </div> -->
                                                         <div class="col-4">
                                                             <label for="down_payment">{{__('inventory::inventory.down_payment')}} % <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                             <input name="down_payment_from" id="down_payment_from" type="number" class="form-control" placeholder="{{__('inventory::inventory.enter_down_payment')}}" data-parsley-trigger="change focusout" value="{{$i_project->down_payment_from}}">
                                                         </div>
                                                         <!-- <div class="col-6">
                                                     <label for="down_payment_to">{{__('inventory::inventory.down_payment_to')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                     <input name="down_payment_to" id="down_payment_to" type="number" class="form-control" placeholder="{{__('inventory::inventory.enter_down_payment')}}" data-parsley-trigger="change focusout" value="{{$i_project->down_payment_to}}">
                                                    </div> -->
                                                     </div>

                                                 </div>
                                                 <div class="tab-pane fade" id="attachments" role="tabpanel" aria-labelledby="attachments-tab">
                                                     <div class="form-group row">
                                                         <div class="col-4">
                                                             <label for="video">{{__('inventory::inventory.video')}}</label> - <small>{{__('settings::settings.embed')}}</small>
                                                             <textarea name="video" class="form-control" id="video" data-parsley-trigger="change focusout">{{$i_project->video}}</textarea>
                                                         </div>
                                                         {{-- <div class="col-4">
                                                            <label for="landing_page_image" class="row">{{__('inventory::inventory.landing_page_image')}}</label>
                                                            <input type="file" name="landing_page_image" class="form-control" id="landing_page_image" data-parsley-required-message="صورة الوحدة مطلوبة" data-parsley-trigger="change focusout" />
                                                            <img width="150"  src="{{asset('storage/'.$i_project->landing_page_image)}}" alt="">
                                                        </div> --}}
                                                         <!-- Attachments -->
                                                         <div class="col-12 repeater-attachments">
                                                             <div data-repeater-list="attachments">
                                                                 @foreach ($i_project->attachmentables as $attachment)
                                                                 @if($attachment->type == 'attachment')
                                                                 <div data-repeater-item class="row">
                                                                     <input type="hidden" name="attachment_id" value="{{$attachment->id}}">
                                                                     <div class="col-6">
                                                                         <label for="name">{{__('inventory::inventory.name')}} (ALT)</label>
                                                                         <input name="name" id="name" type="text" class="form-control" placeholder="{{__('inventory::inventory.name')}}" data-parsley-trigger="change focusout" value="{{$attachment->alt}}">
                                                                         <label for="order">{{__('inventory::inventory.order')}}</label>
                                                                         <input name="order" id="order" type="number" class="form-control" placeholder="{{__('inventory::inventory.order')}}" data-parsley-trigger="change focusout" value="{{$attachment->order}}">

                                                                        </div>
                                                                     <div class="col-lg-6">
                                                                         <div class="row">
                                                                             <div class="box col-6">
                                                                                 <label for="attachments" class="row">{{__('inventory::inventory.attachments')}}</label>
                                                                                 <input type="file" name="file" class="" id="attachments" data-parsley-trigger="change focusout" />
                                                                             </div>
                                                                             <div class="card col-6" id="card-{{$attachment->id}}">
                                                                                 <div class="html5lightbox" title="" data-group="image_group" href="#" data-width="1200" data-height="1200" title="{{trans('inventory::inventory.view_image')}}">
                                                                                     <img class="card-img-top w-100" src="{{URL::asset('storage/'.$attachment->path)}}" alt="{{trans('inventory::inventory.image')}}">
                                                                                 </div>
                                                                                 <div class="card-body" style="text-align: center !important;">
                                                                                     {{-- <h5 class="card-title">Card title that wraps to a new line</h5> --}}
                                                                                     {{-- <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> --}}
                                                                                 </div>
                                                                             </div>
                                                                             <label for="image"><strong>{{__('settings::settings.image_dimensions')}}:835 × 467 px</strong></label>

                                                                         </div>
                                                                     </div>
                                                                     <div class="col-md-2 col-sm-2">
                                                                         <a href="javascript:;" data-repeater-delete class="btn btn-brand data-repeater-delete" onclick="$('.delete-attachments').append(`<input type='hidden' value ='{{$attachment->id}}' name ='delete_attachments[]'>`)">
                                                                             <i class="fa fa-times"></i>
                                                                         </a>
                                                                     </div>
                                                                 </div>

                                                                 @endif
                                                                 @endforeach
                                                                 @if(!$i_project->attachments->count())
                                                                 <div data-repeater-item class="row">
                                                                     <div class="col-6">
                                                                         <label for="name">{{__('inventory::inventory.name')}} (ALT)</label>
                                                                         <input name="name" id="name" type="text" class="form-control" placeholder="{{__('inventory::inventory.name')}}" data-parsley-trigger="change focusout">

                                                                        </div>
                                                                     <div class="col-lg-4">
                                                                         <div class="row">
                                                                             <div class="box">
                                                                                 <label for="attachments" class="row">{{__('inventory::inventory.attachments')}}</label>
                                                                                 <input type="file" name="file" class="" id="attachments" data-parsley-trigger="change focusout" />
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                     <div class="col-md-2 col-sm-2">
                                                                         <a href="javascript:;" data-repeater-delete class="btn btn-brand data-repeater-delete">
                                                                             <i class="fa fa-times"></i>
                                                                         </a>
                                                                     </div>
                                                                 </div>
                                                                 @endif
                                                             </div>
                                                             <a href="javascript:;" data-repeater-create id="repeater_btn_attachments" class="btn">
                                                                 <i class="fa fa-plus"></i> {{trans('inventory::inventory.attachments')}}
                                                             </a>
                                                         </div>

                                                         <div class="delete-attachments">

                                                         </div>
                                                         <!-- Floor Plans -->

                                                     </div>

                                                 </div>
                                                 <div class="tab-pane fade" id="unit_types" role="tabpanel" aria-labelledby="unit_types-tab">
                                                     <div class="form-group col-12">
                                                         @include('inventory::projects.unit-type-repeater-update')
                                                     </div>
                                                 </div>
                                                 <div class="tab-pane fade" id="payment_plans" role="tabpanel" aria-labelledby="payment_plans-tab">
                                                    <div class="form-group col-12">
                                                        @include('inventory::projects.payment-plan-update')
                                                    </div>
                                                </div>
                                             </div>

                                             <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                                 <div class="m-form__actions m-form__actions--solid">
                                                     <div class="row">
                                                         <button type="button" class="btn btn-brand mx-3 save-continue">
                                                             <i class="la la-check"></i>
                                                             <span class="kt-hidden-mobile">Save</span>
                                                         </button>
                                                         <button type="button" class="btn btn-success save-only">
                                                             <i class="la la-check"></i>
                                                             <span class="kt-hidden-mobile">Save & Close</span>
                                                         </button>
                                                         <a href="{{route('front.singleProject',['id' => $i_project->id,'slug'=>  str_slug($i_project->default_value)])}}" class="btn btn-primary mx-3" target="_blank">Preview</a>
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
 </div>
