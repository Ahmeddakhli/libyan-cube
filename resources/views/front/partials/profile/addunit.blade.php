@section('title', trans('inventory::inventory.create_unit'))

<nav id="breadcrumb" class='mb-3'>
  <ul>
    <li>
      <a href="{{route('front.home')}}">
        <ion-icon name="home-outline"></ion-icon>
        </a>
    </li>
    <li class="active"><a> {{__('inventory::inventory.create_unit')}}</a></li>
  </ul>
</nav> <!-- #/ breadcrumb-->

<div class="user-wrapper add-property">
  <div class="row">
    <div class="col-xl-8">
      <div class="add-prop-form">
        <form action="#" method="POST" id="add-unit" enctype="multipart/form-data" data-parsley-validate>
          @csrf
          <div class="form-section pt-3">
            <h4 class="form-section-title text-uppercase">{{__('inventory::inventory.unit_information')}} :</h4>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="">{{__('inventory::inventory.project')}} - <span>{{__('inventory::inventory.optional')}}</span></label>
                  <input type="text" class='dropdown-select show-tick project-select form-control' id="project_id" title="{{__('inventory::inventory.select_project')}}">
                  <input id="i_project_id" name="i_project_id" type="hidden"/>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="">{{__('inventory::inventory.unit_number')}} - <span>{{__('inventory::inventory.mandatory')}}</span></label>
                  <input type="text" class="form-control" name="unit_number" data-parsley-trigger="change focusout" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.enter_unit_number')}}" placeholder="{{__('inventory::inventory.enter_unit_number')}}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="">{{__('inventory::inventory.floor_numbers')}} - <span>{{__('inventory::inventory.optional')}}</span></label>
                  <select class='dropdown-select show-tick floor-select form-control' name="i_floor_number_id" title="{{__('inventory::inventory.select_floor_number')}}">
                      @foreach ($floor_numbers as $floor_number)
                          <option value="{{$floor_number->id}}">{{$floor_number->floor_number}}</option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="">{{__('inventory::inventory.building_number')}} - <span>{{__('inventory::inventory.optional')}}</span></label>
                  <input type="text" name="building_number" class="form-control" placeholder="{{__('inventory::inventory.enter_building_number')}}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="">{{__('inventory::inventory.positions')}} - <span>{{__('inventory::inventory.optional')}}</span></label>
                  <select class='dropdown-select show-tick position-select form-control' name="i_position_id" title="{{__('inventory::inventory.select_position')}}">
                      @foreach ($positions as $position)
                          <option value="{{$position->id}}">{{$position->position}}</option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="">{{__('inventory::inventory.view')}} - <span>{{__('inventory::inventory.optional')}}</span></label>
                  <select class='dropdown-select show-tick view-select form-control' name="i_view_id" title="{{__('inventory::inventory.select_view')}}">
                      @foreach ($views as $view)
                          <option value=" {{$view->id}}">{{$view->view}}</option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="">{{__('inventory::inventory.area_unit')}} - <span>{{__('inventory::inventory.optional')}}</span></label>
                  <select class='dropdown-select show-tick area-select form-control' id="i_area_unit_id" name="i_area_unit_id" title="{{__('inventory::inventory.select_area_unit')}}">
                      @foreach ($area_units as $area_unit)
                          <option value="{{$area_unit->id}}">{{$area_unit->area_unit}}</option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="">{{__('inventory::inventory.area')}} - <span>{{__('inventory::inventory.optional')}}</span></label>
                  <input name="area" type="number" step="0.01" id="area" class="form-control" placeholder="{{__('inventory::inventory.enter_area')}}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="">{{__('inventory::inventory.roof_area')}} - <span>{{__('inventory::inventory.optional')}}</span></label>
                  <input name="roof_area" type="number" step="0.01" id="roof_area" class="form-control" placeholder="{{__('inventory::inventory.enter_roof_area')}}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="">{{__('inventory::inventory.terrace_area')}} - <span>{{__('inventory::inventory.optional')}}</span></label>
                  <input name="terrace_area" type="number" step="0.01" id="terrace_area" class="form-control" placeholder="{{__('inventory::inventory.enter_terrace_area')}}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="">{{__('inventory::inventory.plot_area')}} - <span>{{__('inventory::inventory.optional')}}</span></label>
                  <input name="plot_area" type="number" step="0.01" class="form-control" placeholder="{{__('inventory::inventory.enter_plot_area')}}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="">{{__('inventory::inventory.build_up_area')}} - <span>{{__('inventory::inventory.optional')}}</span></label>
                  <input name="build_up_area" type="number" step="0.01" class="form-control" placeholder=" {{__('inventory::inventory.enter_build_up_area')}}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="">{{__('inventory::inventory.garden_area_units')}} - <span>{{__('inventory::inventory.optional')}}</span></label>
                  <select name="i_garden_area_unit_id" class='dropdown-select show-tick garden-area-select form-control' title="{{__('inventory::inventory.select_garden_area_unit')}}">
                      @foreach ($area_units as $area_unit)
                          <option value="{{$area_unit->id}}">{{$area_unit->area_unit}}</option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="">{{__('inventory::inventory.garden_area')}} - <span>{{__('inventory::inventory.optional')}}</span></label>
                  <input name="garden_area" type="number" step="0.01" class="form-control" placeholder="{{__('inventory::inventory.enter_garden_area')}}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="">{{__('inventory::inventory.bedrooms')}} - <span>{{__('inventory::inventory.optional')}}</span></label>
                  <select name="i_bedroom_id" class='dropdown-select show-tick bedroom-select form-control' title="{{__('inventory::inventory.select_bedroom')}}">
                      @foreach ($bedrooms as $bedroom)
                          <option value="{{$bedroom->id}}">{{$bedroom->bedroom}}</option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="">{{__('inventory::inventory.bathrooms')}} - <span>{{__('inventory::inventory.optional')}}</span></label>
                  <select name="i_bathroom_id" class='dropdown-select show-tick bathroom-select form-control' title="{{__('inventory::inventory.bathroom')}}">
                      @foreach ($bathrooms as $bathroom)
                          <option value="{{$bathroom->id}}">{{$bathroom->bathroom}}</option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="">{{__('inventory::inventory.furnishing_status')}} - <span>{{__('inventory::inventory.optional')}}</span></label>
                  <select name="i_furnishing_status_id" class='dropdown-select show-tick furnishing-status-select form-control' title="{{__('inventory::inventory.select_furnishing_status')}}">
                      @foreach ($furnishing_statuses as $furnishing_status)
                          <option value="{{$furnishing_status->id}}">{{$furnishing_status->furnishing_status}}</option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="">{{__('inventory::inventory.finishing_type')}} - <span>{{__('inventory::inventory.optional')}}</span></label>
                  <select name="i_finishing_type_id" class='dropdown-select show-tick finishing-type-select form-control' title="{{__('inventory::inventory.select_finishing_type')}}">
                      @foreach ($finishing_types as $finishing_type)
                          <option value="{{$finishing_type->id}}">{{$finishing_type->finishing_type}}</option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="">{{__('inventory::inventory.purpose')}} - <span>{{__('inventory::inventory.optional')}}</span></label>
                  <select name="i_purpose_id" class='dropdown-select show-tick purpose-select form-control' title="{{__('inventory::inventory.select_purpose')}}" onchange="getPurposePurposeTypes([$(this).val()], 'i_purpose_type_id')">
                      @foreach ($purposes as $purpose)
                          <option value="{{$purpose->id}}">{{$purpose->purpose}}</option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="">{{__('inventory::inventory.purpose_type')}} - <span>{{__('inventory::inventory.optional')}}</span></label>
                  <select id="i_purpose_type_id" name="i_purpose_type_id" class='dropdown-select show-tick purpose-type-select form-control' title="{{__('inventory::inventory.select_purpose_type')}}">

                  </select>
                </div>
              </div>
              <div class="col-12 mb-3">
                <div class="form-group mb-4">
                  <input type="hidden" name="translations[0][language_id]" value="1">
                  <label for="">{{__('inventory::inventory.description')}} - <span>{{__('inventory::inventory.optional')}}</span></label>
                  <textarea class="form-control" name="translations[0][description]" placeholder="{{__('inventory::inventory.enter_description')}}" rows="5"></textarea>
                </div>
              </div>
              <div class="col-12 mb-3">
                <div class="form-group mb-4">
                    <label>{{__('inventory::inventory.attachments')}}</label>
                </div>
                <div class="repeater-attachments">
                  <div data-repeater-list="attachments">
                    <div data-repeater-item class="row align-items-center py-3 mb-2 mx-0 border">
                      <div class="col-sm-6 col-4 pr-0">
                        <input name="order" type="number" class="form-control" placeholder="{{__('inventory::inventory.order')}}" data-parsley-trigger="change focusout">
                      </div>
                      <div class="col-sm-5 col-6 pr-0">
                          <input type="file" class="form-control custom-att-repeater" name="file" id="" data-parsley-trigger="change focusout">
                      </div>
                      <div class="col-1 p-0">
                        <button data-repeater-delete type="button" class="btn trash">
                          <i class="fas fa-trash-alt"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                  <button data-repeater-create type="button" class="btn add">
                    <i class="fas fa-plus"></i> &nbsp; Add attachment
                  </button>
                </div>
              </div>
              <div class="col-12 mb-3">
                <div class="form-group mb-4">
                  <label>{{__('inventory::inventory.floor_plans')}}</label>
                </div>
                <div class="repeater-floor-plans">
                  <div data-repeater-list="floorplans">
                    <div data-repeater-item class="row align-items-center py-3 mb-2 mx-0 border">
                      <div class="col-sm-6 col-4 pr-0">
                        <input name="order" type="number" class="form-control" placeholder="{{__('inventory::inventory.order')}}" data-parsley-trigger="change focusout">
                      </div>
                      <div class="col-sm-5 col-6 pr-0">
                          <input type="file" class="form-control custom-att-repeater" name="file" id="" data-parsley-trigger="change focusout">
                      </div>
                      <div class="col-1 p-0">
                        <button data-repeater-delete type="button" class="btn trash">
                          <i class="fas fa-trash-alt"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                  <button data-repeater-create type="button" class="btn add">
                    <i class="fas fa-plus"></i> &nbsp; Add Floor Plan
                  </button>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group mb-4">
                  <label>{{__('inventory::inventory.master_plans')}}</label>
                </div>
                <div class="repeater-master-plans">
                  <div data-repeater-list="masterplans">
                    <div data-repeater-item class="row align-items-center py-3 mb-2 mx-0 border">
                      <div class="col-sm-6 col-4 pr-0">
                        <input name="order" type="number" class="form-control" placeholder="{{__('inventory::inventory.order')}}" data-parsley-trigger="change focusout">
                      </div>
                      <div class="col-sm-5 col-6 pr-0">
                          <input type="file" class="form-control custom-att-repeater" name="file" id="" data-parsley-trigger="change focusout">
                      </div>
                      <div class="col-1 p-0">
                        <button data-repeater-delete type="button" class="btn trash">
                          <i class="fas fa-trash-alt"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                  <button data-repeater-create type="button" class="btn add">
                    <i class="fas fa-plus"></i> &nbsp; Add Master Plan
                  </button>
                </div>
              </div>
            </div> <!-- ./ row -->
          </div> <!-- ./ form-section -->
          <hr>
          <div class="form-section pt-3">
            <h4 class="form-section-title text-uppercase">{{__('inventory::inventory.location_information')}} :</h4>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="">{{__('inventory::inventory.country')}} - <span>{{__('inventory::inventory.optional')}}</span></label>
                  <select name="country_id" class='dropdown-select show-tick country-select form-control' id="country_id" title="{{__('inventory::inventory.select_country')}}" onchange="if($(this).val().length > 0){getCountryRegions($(this).find(':selected').val())}">
                      @foreach ($countries as $country)
                          <option value="{{$country->id}}">{{$country->name}}</option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="">{{__('inventory::inventory.region')}} - <span>{{__('inventory::inventory.optional')}}</span></label>
                  <select id="region_id" name="region_id" class='dropdown-select show-tick region-select form-control' title="{{__('inventory::inventory.select_region')}}" onchange="if($(this).val().length > 0){getRegionCities($(this).find(':selected').val())}">

                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="">{{__('inventory::inventory.city')}} - <span>{{__('inventory::inventory.optional')}}</span></label>
                  <select id="city_id" name="city_id" class='dropdown-select show-tick city-select form-control' title="{{__('inventory::inventory.select_city')}}" onchange="if($(this).val().length > 0){getCityAreas($(this).find(':selected').val())}">

                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="">{{__('inventory::inventory.area_place')}} - <span>{{__('inventory::inventory.optional')}}</span></label>
                  <select id="area_id" name="area_id" class='dropdown-select show-tick area-select form-control' title="{{__('inventory::inventory.select_area')}}">

                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-4">
                    <label for="">{{__('inventory::inventory.address')}} - <span>{{__('inventory::inventory.optional')}}</span></label>
                    <input type="text" name="translations[0][address]" class="form-control" id="address" placeholder="{{__('inventory::inventory.enter_address')}}">
                </div>
              </div>
              <div class="col-12">
                <div class="form-group form-group-map mb-4">
                  <label for="">{{__('inventory::inventory.location')}} - <span>{{__('inventory::inventory.optional')}}</span></label>
                  <div id="map"></div>
                  <input id="lat" name="latitude" type="hidden" value="" />
                  <input id="lng" name="longitude" type="hidden" value="" />
                </div>
              </div>
            </div> <!-- ./ row -->
          </div> <!-- ./ form-section -->
          <hr>
          <div class="form-section pt-3">
            <h4 class="form-section-title text-uppercase">{{__('inventory::inventory.financial_information')}} :</h4>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="">{{__('inventory::inventory.offering_type')}} - <span>{{__('inventory::inventory.mandatory')}}</span></label>
                  <select class='dropdown-select show-tick offering-type-select form-control' name="i_offering_type_id" title="{{__('inventory::inventory.select_offering_type')}}" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.select_offering_type')}}" data-parsley-errors-container="#offering_type_error_container">
                      @foreach ($offering_types as $offering_type)
                          <option value="{{$offering_type->id}}">{{$offering_type->offering_type}}</option>
                      @endforeach
                  </select>
                  <div id="offering_type_error_container" class="error_container"></div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="">{{__('inventory::inventory.payment_method')}} - <span>{{__('inventory::inventory.optional')}}</span></label>
                  <select class='dropdown-select show-tick payment-method-select form-control' name="i_payment_method_id" title="{{__('inventory::inventory.select_payment_method')}}">
                      @foreach ($payment_methods as $payment_method)
                          <option value="{{$payment_method->id}}">{{$payment_method->payment_method}}</option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="">{{__('inventory::inventory.currency_code')}} - <span>{{__('inventory::inventory.optional')}}</span></label>
                  <select class='dropdown-select show-tick currency-code-select form-control' name="currency_code" id="currency_code" title="{{__('inventory::inventory.select_currency_code')}}">
                      @for ($i = 0; $i < count($currency_codes); $i++) <option value="{{$currency_codes[$i]}}">{{$currency_codes[$i]}}</option>
                          @endfor
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="">{{__('inventory::inventory.down_payment')}} - <span>{{__('inventory::inventory.optional')}}</span></label>
                  <input type="text" class="form-control" id="down_payment" name="down_payment" placeholder="{{__('inventory::inventory.enter_down_payment')}}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="">{{__('inventory::inventory.price')}} - <span>{{__('inventory::inventory.optional')}}</span></label>
                  <input type="text" class="form-control" id="price" name="price" placeholder="{{__('inventory::inventory.enter_price')}}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="">{{__('inventory::inventory.number_of_installments')}} - <span>{{__('inventory::inventory.optional')}}</span></label>
                  <input name="number_of_installments" type="text" id="number_of_installments" class="form-control" placeholder="{{__('inventory::inventory.enter_number_of_installments')}}">
                </div>
              </div>
            </div> <!-- ./ row -->
          </div> <!-- ./ form-section -->
          <hr>
          <div class="form-section pt-3">
            <h4 class="form-section-title text-uppercase">{{__('inventory::inventory.facilities_and_amenities')}} :</h4>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="">{{__('inventory::inventory.facilities')}} - <span>{{__('inventory::inventory.optional')}}</span></label>
                  <select name="facilities[]" id="facilities" class='dropdown-select show-tick facilities-select form-control' multiple title="">
                      @foreach ($facilities as $facility)
                          <option value="{{$facility->id}}">{{$facility->facility}}</option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="">{{__('inventory::inventory.amenities')}} - <span>{{__('inventory::inventory.optional')}}</span></label>
                  <select name="amenities[]" id="amenities" class='dropdown-select show-tick amenities-select form-control' multiple title="">
                      @foreach ($amenities as $amenity)
                          <option value="{{$amenity->id}}">{{$amenity->amenity}}</option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="">{{__('tags::tags.tags')}} - <span>{{__('inventory::inventory.optional')}}</span></label>
                  <select name="tags[]" id="amenities" class='dropdown-select show-tick tags-select form-control' multiple title="">
                      @foreach ($tags as $tag)
                          <option value="{{$tag->id}}">{{$tag->tag}}</option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-4">
                  <label for="">{{__('inventory::inventory.design_type')}} - <span>{{__('inventory::inventory.optional')}}</span></label>
                  <select name="i_design_type_id" class='dropdown-select show-tick design-types-select form-control' title="{{__('inventory::inventory.select_design_type')}}">
                      @foreach ($design_types as $design_type)
                          <option value="{{$design_type->id}}">{{$design_type->type}}</option>
                      @endforeach
                  </select>
                </div>
              </div>
            </div> <!-- ./ row -->
          </div> <!-- ./ form-section -->
          <div class="save-inputs">
            <button type="button" class="submit-unit">
              <ion-icon name="save-outline"></ion-icon> {{__('main.submit')}}
            </button>
          </div>
        </form>
      </div> <!-- ./ add-prop-form -->
    </div> <!-- ./ col-xl-8 -->
    @include('front.partials.profile.side-bar')
    <!-- ./ col-xl-4 -->
  </div> <!-- ./ row -->
</div>

@push('scripts')
  <script>
      // SELECT PICKER PLUGIN INIT
      $('.dropdown-select').selectpicker({
          selectedTextFormat: 'count > 2',
      });
  </script>

  <!-- MAP -->
  <script>
      function initMap(latLng = null) {
          var options = {
              zoom: 15,
              center: latLng ? latLng : {lat: 29.976631, lng: 31.285002},
              mapTypeId: 'satellite', // hybrid , satellite , roadmap ,
              scrollwheel: true,
              draggable: true,
              styles: [{
                      elementType: 'geometry',
                      stylers: [{
                          color: '#242f3e'
                      }]
                  },
                  {
                      elementType: 'labels.text.stroke',
                      stylers: [{
                          color: '#242f3e'
                      }]
                  },
                  {
                      elementType: 'labels.text.fill',
                      stylers: [{
                          color: '#746855'
                      }]
                  },
                  {
                      featureType: 'administrative.locality',
                      elementType: 'labels.text.fill',
                      stylers: [{
                          color: '#d59563'
                      }]
                  },
                  {
                      featureType: 'poi',
                      elementType: 'labels.text.fill',
                      stylers: [{
                          color: '#d59563'
                      }]
                  },
                  {
                      featureType: 'poi.park',
                      elementType: 'geometry',
                      stylers: [{
                          color: '#263c3f'
                      }]
                  },
                  {
                      featureType: 'poi.park',
                      elementType: 'labels.text.fill',
                      stylers: [{
                          color: '#6b9a76'
                      }]
                  },
                  {
                      featureType: 'road',
                      elementType: 'geometry',
                      stylers: [{
                          color: '#38414e'
                      }]
                  },
                  {
                      featureType: 'road',
                      elementType: 'geometry.stroke',
                      stylers: [{
                          color: '#212a37'
                      }]
                  },
                  {
                      featureType: 'road',
                      elementType: 'labels.text.fill',
                      stylers: [{
                          color: '#9ca5b3'
                      }]
                  },
                  {
                      featureType: 'road.highway',
                      elementType: 'geometry',
                      stylers: [{
                          color: '#746855'
                      }]
                  },
                  {
                      featureType: 'road.highway',
                      elementType: 'geometry.stroke',
                      stylers: [{
                          color: '#1f2835'
                      }]
                  },
                  {
                      featureType: 'road.highway',
                      elementType: 'labels.text.fill',
                      stylers: [{
                          color: '#f3d19c'
                      }]
                  },
                  {
                      featureType: 'transit',
                      elementType: 'geometry',
                      stylers: [{
                          color: '#2f3948'
                      }]
                  },
                  {
                      featureType: 'transit.station',
                      elementType: 'labels.text.fill',
                      stylers: [{
                          color: '#d59563'
                      }]
                  },
                  {
                      featureType: 'water',
                      elementType: 'geometry',
                      stylers: [{
                          color: '#17263c'
                      }]
                  },
                  {
                      featureType: 'water',
                      elementType: 'labels.text.fill',
                      stylers: [{
                          color: '#515c6d'
                      }]
                  },
                  {
                      featureType: 'water',
                      elementType: 'labels.text.stroke',
                      stylers: [{
                          color: '#17263c'
                      }]
                  }
              ]
              // panControl: true,
              // zoomControl: true,
              // disableDefaultUI: true,
              // mapTypeControl: true,
              // scaleControl: true,
              // streetViewControl: true,
              // overviewMapControl: true,
              // rotateControl: true,
          };

          var map = new google.maps.Map(document.getElementById('map'), options);

          var infoWindow = new google.maps.InfoWindow({
              content: '<p>{{env('APP_NAME')}}</p>'
          })

          // Init marker if no marker
          if (marker && marker.setMap) {
              //
          } else {
              var marker = null;
          }

          if (latLng) {
              // Remove previous marker if any
              if (marker && marker.setMap) {
                  marker.setMap(null);
              }

              marker = new google.maps.Marker({
                  position: latLng,
                  icon: '{{URL::asset('/front/images/icons/pin.png')}}',
                  map: map,
                  animation: google.maps.Animation.BOUNCE,
                  title: '{{env('APP_NAME')}}'
              });

              $('#lat').val(latLng.lat)
              $('#lng').val(latLng.lng)
          }

          google.maps.event.addListener(map, 'click', function(event) {
              // Remove previous marker if any
              if (marker && marker.setMap) {
                  marker.setMap(null);
              }

              marker = new google.maps.Marker({
                  position: event.latLng,
                  icon: '{{URL::asset('/front/images/icons/pin.png')}}',
                  map: map,
                  animation: google.maps.Animation.BOUNCE,
                  title: '{{env('APP_NAME')}}'
              });

              $('#lat').val(event.latLng.lat())
              $('#lng').val(event.latLng.lng())

              marker.addListener('click', function(e) {
                  // Close the current InfoWindow.
                  infoWindow.close();

                  infoWindow.open(map, marker);

                  var pos = map.getZoom();
                  map.setZoom(12);
                  map.setCenter(marker.getPosition());
                  window.setTimeout(function() {
                      map.setZoom(pos);
                  }, 3000);
              });
          });
      }
      initMap();
  </script>
  <!-- End ./MAP -->

  <!-- Locations -->
  <script>
      function getCountryRegions(country_id, selected_region_id = null) {
          $('#city_id').empty();
          $("#city_id").selectpicker("refresh");

          $('#region_id').empty();
          $("#region_id").selectpicker("refresh");

          $.ajax({
              url: "{{route('locations.getCountryRegions')}}",
              type: "GET",
              data: {
                  country_id: country_id
              },
              success: function(response) {
                  // Show notification
                  if (response.status) {
                      // Insert empty region first
                      $('#region_id').append($('<option>', {
                          value: "",
                          text: "{{__('inventory::inventory.select_region')}}"
                      }));
                      $.each(response.data, function(i, region) {
                          $('#region_id').append($('<option>', {
                              value: region.id,
                              text: region.name
                          }));
                      });
                      if (selected_region_id) {
                          $('#region_id').selectpicker('val', selected_region_id);
                      }
                      $("#region_id").selectpicker("refresh");
                  } else {
                      // Notification message
                      if (response.message) {
                          // Empty notificaion messages
                          $('.messages').empty();

                          // Notification type
                          $('#notification').css('background-color', 'red');

                          // Display notification
                          $('#notification .messages').append(`<span>` + response.message + `</span> <br>`);
                          $('#notification').fadeIn("slow");
                          $('.dismiss').click(function() {
                              $('#notification').fadeOut('slow')
                          });

                          // Dismiss notification
                          setTimeout(function() {
                              $('#notification').fadeOut('slow')
                          }, 2000);
                      }
                  }
              },
              error: function(xhr, error_text, statusText) {
                  // Empty notification messages
                  $('.messages').empty();

                  // Notification type
                  $('#notification').css('background-color', 'red');

                  // Display notificaion
                  if (xhr.responseJSON && xhr.responseJSON.errors) {
                      $.each(xhr.responseJSON.errors, function(index, error) {
                          $('#notification .messages').append(`<span>` + error.message + `</span> <br>`);
                      });
                  } else {
                      $('#notification .messages').append(`<span>` + statusText + `</span> <br>`);
                  }
                  $('#notification').fadeIn("slow");
                  $('.dismiss').click(function() {
                      $('#notification').fadeOut('slow')
                  });
              }
          });
      }

      function getRegionCities(region_id, selected_city_id = null) {
          $('#city_id').empty();
          $("#city_id").selectpicker("refresh");

          $.ajax({
              url: "{{route('locations.getRegionCities')}}",
              type: "GET",
              data: {
                  region_id: region_id
              },
              success: function(response) {
                  // Show notification
                  if (response.status) {
                      // Insert empty city first
                      $('#city_id').append($('<option>', {
                          value: "",
                          text: "{{__('inventory::inventory.select_city')}}"
                      }));
                      $.each(response.data, function(i, city) {
                          $('#city_id').append($('<option>', {
                              value: city.id,
                              text: city.name
                          }));
                      });
                      if (selected_city_id) {
                          $('#city_id').selectpicker('val', selected_city_id);
                      }
                      $("#city_id").selectpicker("refresh");
                  } else {
                      // Notification message
                      if (response.message) {
                          // Empty notificaion messages
                          $('.messages').empty();

                          // Notification type
                          $('#notification').css('background-color', 'red');

                          // Display notification
                          $('#notification .messages').append(`<span>` + response.message + `</span> <br>`);
                          $('#notification').fadeIn("slow");
                          $('.dismiss').click(function() {
                              $('#notification').fadeOut('slow')
                          });

                          // Dismiss notification
                          setTimeout(function() {
                              $('#notification').fadeOut('slow')
                          }, 2000);
                      }
                  }
              },
              error: function(xhr, error_text, statusText) {
                  // Empty notification messages
                  $('.messages').empty();

                  // Notification type
                  $('#notification').css('background-color', 'red');

                  // Display notificaion
                  if (xhr.responseJSON && xhr.responseJSON.errors) {
                      $.each(xhr.responseJSON.errors, function(index, error) {
                          $('#notification .messages').append(`<span>` + error.message + `</span> <br>`);
                      });
                  } else {
                      $('#notification .messages').append(`<span>` + statusText + `</span> <br>`);
                  }
                  $('#notification').fadeIn("slow");
                  $('.dismiss').click(function() {
                      $('#notification').fadeOut('slow')
                  });
              }
          });
      }

      function getCityAreas(city_id, selected_area_id = null) {
          $('#area_id').empty();
          $("#area_id").selectpicker("refresh");

          $.ajax({
              url: "{{route('locations.getCityAreas')}}",
              type: "GET",
              data: {
                  city_id: city_id
              },
              success: function(response) {
                  // Show notification
                  if (response.status) {
                      // Insert empty area first
                      $('#area_id').append($('<option>', {
                          value: "",
                          text: "{{__('inventory::inventory.select_area')}}"
                      }));
                      $.each(response.data, function(i, area) {
                          $('#area_id').append($('<option>', {
                              value: area.id,
                              text: area.name
                          }));
                      });
                      if (selected_area_id) {
                          $('#area_id').selectpicker('val', selected_area_id);
                      }
                      $("#area_id").selectpicker("refresh");
                  } else {
                      // Notification message
                      if (response.message) {
                          // Empty notificaion messages
                          $('.messages').empty();

                          // Notification type
                          $('#notification').css('background-color', 'red');

                          // Display notification
                          $('#notification .messages').append(`<span>` + response.message + `</span> <br>`);
                          $('#notification').fadeIn("slow");
                          $('.dismiss').click(function() {
                              $('#notification').fadeOut('slow')
                          });

                          // Dismiss notification
                          setTimeout(function() {
                              $('#notification').fadeOut('slow')
                          }, 2000);
                      }
                  }
              },
              error: function(xhr, error_text, statusText) {
                  // Empty notification messages
                  $('.messages').empty();

                  // Notification type
                  $('#notification').css('background-color', 'red');

                  // Display notificaion
                  if (xhr.responseJSON && xhr.responseJSON.errors) {
                      $.each(xhr.responseJSON.errors, function(index, error) {
                          $('#notification .messages').append(`<span>` + error.message + `</span> <br>`);
                      });
                  } else {
                      $('#notification .messages').append(`<span>` + statusText + `</span> <br>`);
                  }
                  $('#notification').fadeIn("slow");
                  $('.dismiss').click(function() {
                      $('#notification').fadeOut('slow')
                  });
              }
          });
      }
  </script>
  <!-- End Locations -->

  <!-- Append project info to unit fields -->
  <script>
      function appendProjectData(id) {
          // Request parameters
          var url = "{{route('inventory.projects.select')}}"
          var data = {
              'id': id
          }
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': "{{ csrf_token() }}"
              }
          });
          var headers = {
              'Content-Type': 'application/json',
          }

          // Send the request
          $.post(url, data, headers).done(function(response) {
              // Area unit
              if (response.i_area_unit_id) {
                  $(`#i_area_unit_id`).val(response.i_area_unit_id).change();
              }

              // Area min and max restriction
              if (response.area_from && response.area_to) {
                  $('#area').attr({
                      'max':response.area_to,
                      'min':response.area_from
                  });
              }

              // Map location
              if (response.latitude && response.longitude) {
                  $('#lat').val(response.latitude);
                  $('#lng').val(response.longitude);
                  var latLng = {
                      lat: parseFloat(response.latitude),
                      lng: parseFloat(response.longitude)
                  };
                  initMap(latLng)
              }

              // Currency code
              if (response.currency_code) {
                  $(`#currency_code`).val(response.currency_code).change();
              }

              // Down payment restriction
              if (response.down_payment_from && response.down_payment_to) {
                  $('#down_payment').attr({
                      'max':response.down_payment_to,
                      'min':response.down_payment_from
                  });
              }

              // Price restriction
              if (response.price_from && response.price_to) {
                  $('#price').attr({
                      'max':response.price_to,
                      'min':response.price_from
                  });
              }

              // Number of installments restriction
              if (response.number_of_installments_from && response.number_of_installments_to) {
                  $('#number_of_installments').attr({
                      'max':response.number_of_installments_to,
                      'min':response.number_of_installments_from
                  });
              }

              // Facilities selection
              if(response.facilities && response.facilities.length > 0){
                  var facilities = response.facilities;
                  var values = new Array();
                  for (var i = 0; i < facilities.length; i++) {
                      values.push(facilities[i].id);
                      $('#facilities').val(values).trigger('change');
                  }
              }

              // Amenities selection
              if(response.amenities && response.amenities.length > 0){
                  var amenities = response.amenities;
                  var values = new Array();
                  for (var i = 0; i < amenities.length; i++) {
                      values.push(amenities[i].id);
                      $('#amenities').val(values).trigger('change');
                  }
              }

              // Tags selection
              if(response.tags && response.tags.length > 0){
                  var tags = response.tags;
                  var values = new Array();
                  for (var i = 0; i < tags.length; i++) {
                      values.push(tags[i].id);
                      $('#tags').val(values).trigger('change');
                  }
              }

              // Country, region, city, area
              if (response.country_id) {
                  $(`#country_id`).val(response.country_id).change();
                  if (response.region_id) {
                      getCountryRegions(response.country_id, response.region_id);
                      if (response.city_id) {
                          getRegionCities(response.region_id, response.city_id);
                          if (response.area_id) {
                              /* Delay the loading until areas reload occurs */
                              setTimeout(
                                function()
                                {
                              getCityAreas(response.city_id, response.area_id);
                                }, 5000);
                          } else {
                            getCityAreas(response.city_id);
                          }
                      }
                  }
              }

          });
      }
  </script>
  <!-- End Append  -->

  <!-- Unit Create Request  -->
  <script>
      $('.submit-unit').on('click', function() {
          var form = $(this).closest('form');

          /* Parsley validate front-end */
          if (!form.parsley().isValid()) {
              $('.messages').empty();
              $('#notification').css('background-color', 'red');
              $('#notification .messages').append(`<span>` + "{{trans('main.oh_snap_change_a_few_thing_up_and_try_submitting_again')}}" + `</span> <br>`);
              $('#notification').fadeIn("slow");
              $('.dismiss').click(function() {
                  $('#notification').fadeOut('slow')
              });

              form.find( '[data-parsley-type]' ).each( function( i , v ){
                  $(this).parsley().validate({
                      focusInvalid: false,
                      invalidHandler: function() {
                          $(this).find(":input.error:first").focus();
                      }
                  });

                  return;
              });
              form.find( '[data-parsley-pattern]' ).each(function( i, v ) {
                  $(this).parsley().validate({
                      focusInvalid: false,
                      invalidHandler: function() {
                          $(this).find(":input.error:first").focus();
                      }
                  });

                  return;
              });
              form.parsley().validate({
                  focusInvalid: false,
                  invalidHandler: function() {
                      $(this).find(":input.error:first").focus();
                  }
              });

              return;
          }

          // Block UI
          $.blockUI({
              overlayColor: "#000000",
              type: "loader",
              state: "success",
              message: "{{trans('main.please_wait')}}"
          });

          // Request parameters
          var url = "{{route('front.profile.addunit.store')}}";
          var data = new FormData(document.getElementById("add-unit"));

          // Send the request
          $.ajax({
              url: url,
              method: 'POST',
              data: data,
              processData: false,
              contentType: false,
          }).done(function(response) {
              // Unblock UI
              $.unblockUI();

              // Notification message
              if (response.message) {
                  // Empty notificaion messages
                  $('.messages').empty();

                  // Notification type
                  if (response.status) {
                      $('#notification').css('background-color', 'green');
                  } else {
                      $('#notification').css('background-color', 'red');
                  }

                  // Display notification
                  $('#notification .messages').append(`<span>` + response.message + `</span> <br>`);
                  $('#notification').fadeIn("slow");
                  $('.dismiss').click(function() {
                      $('#notification').fadeOut('slow')
                  });

                  // // Dismiss notification
                  // setTimeout(function() {
                  //     $('#notification').fadeOut('slow')
                  // }, 2000);
              }
          }).fail(function(xhr, error_text, statusText) {
              // Unblock UI
              $.unblockUI();

              // Empty notification messages
              $('.messages').empty();

              // Notification type
              $('#notification').css('background-color', 'red');

              // Display notificaion
              if (xhr.responseJSON && xhr.responseJSON.errors) {
                  $.each(xhr.responseJSON.errors, function(index, error) {
                      $('#notification .messages').append(`<span>` + error.message + `</span> <br>`);
                  });
              } else {
                  $('#notification .messages').append(`<span>` + statusText + `</span> <br>`);
              }
              $('#notification').fadeIn("slow");
              $('.dismiss').click(function() {
                  $('#notification').fadeOut('slow')
              });
          });
      });
  </script>
  <!-- End Unit Create Request  -->

  <!-- Search Project -->
  <script>
      $("#project_id").autocomplete({
          source: function(request, response) {
              var project_url = "{{route('inventory.projects.tagsinput')}}";
              project_url = project_url + '?needle=' + $('#project_id').val();

              // Remove previous value
              $('#i_project_id').removeAttr('value');

              $.ajax({
                  url: project_url,
                  type: "GET",
                  success: function(data) {
                      response($.map(data, function(item) {
                          var object = new Object();
                          object.label = item.value;
                          object.value = item.value;
                          object.id = item.id;
                          return object
                      }));

                  }
              });
          },
          change: function(event, ui) {
              // Changed
          },
          select: function(event, ui) {
              // Prevent value from being put in the input:
              this.value = ui.item.label;
              event.preventDefault();
              // Set the next input's value to the "value" of the item.
              $(this).next("input").val(ui.item.id);
              // Append project data
              appendProjectData(ui.item.id);
          }
      });
  </script>

  <!-- End Search Project -->

  <!-- Attachments Repeaters -->
  <script>
      $(document).ready(function() {
          $('.repeater-attachments').repeater({
              // (Required if there is a nested repeater)
              // Specify the configuration of the nested repeaters.
              // Nested configuration follows the same format as the base configuration,
              // supporting options "defaultValues", "show", "hide", etc.
              // Nested repeaters additionally require a "selector" field.
              repeaters: [{
                  // (Required)
                  // Specify the jQuery selector for this nested repeater
                  selector: '.inner-repeater'
              }]
          });

          $('.repeater-floor-plans').repeater({
              // (Required if there is a nested repeater)
              // Specify the configuration of the nested repeaters.
              // Nested configuration follows the same format as the base configuration,
              // supporting options "defaultValues", "show", "hide", etc.
              // Nested repeaters additionally require a "selector" field.
              repeaters: [{
                  // (Required)
                  // Specify the jQuery selector for this nested repeater
                  selector: '.inner-repeater'
              }]
          });

          $('.repeater-master-plans').repeater({
              // (Required if there is a nested repeater)
              // Specify the configuration of the nested repeaters.
              // Nested configuration follows the same format as the base configuration,
              // supporting options "defaultValues", "show", "hide", etc.
              // Nested repeaters additionally require a "selector" field.
              repeaters: [{
                  // (Required)
                  // Specify the jQuery selector for this nested repeater
                  selector: '.inner-repeater'
              }]
          });
      });
  </script>
  <!-- End Attachments Repeater -->
@endpush
