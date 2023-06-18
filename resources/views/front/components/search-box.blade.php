{{-- <div class="search-box">
    <form class="search-form" action=" {{ isset($url) ? $url : route('front.properties') }}" method="GET">

        <div class="row g-2 align-items-start">

            <div class="col-lg-10">
                <div class="row g-2">

                    <div class="col-6 col-md-8">
                        <select class="form-select form-select-locs" multiple name="region_id[]">
                            @foreach ($regions as $region)
                                <option value="{{ $region->id }}"
                                    @if (request('region_id') && in_array($region->id, request('region_id'))) selected @endif>{{ $region->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 col-md-4">
                        <select class="form-select dd-select" placeholder="{{ __('main.purpose') }}"
                            name="purpose_ids[]" multiple>
                            @foreach ($purposes as $purpose)
                                <option value="{{ $purpose->id }}"
                                    @if (request('purpose_ids') && in_array($purpose->id, request('purpose_ids'))) selected @endif>{{ $purpose->purpose }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 collapse" id="moreOptions">
                        <div class="row g-2">
                            <div class="col-6 col-md-3">
                                <select class="form-select form-select-checkbox" multiple
                                    placeholder="{{ __('inventory::inventory.bedrooms') }} & {{ __('inventory::inventory.bedrooms') }}"
                                    name="bed_bath_rooms[]">
                                    <optgroup label="{{ __('inventory::inventory.bedrooms') }}">
                                        @foreach ($bedrooms as $bedroom)
                                            <option value="bedroom-{{ $bedroom->id }}"
                                                @if (request('bedrooms') && in_array($bedroom->id, request('bedrooms'))) selected @endif>{{ $bedroom->bedroom }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="{{ __('inventory::inventory.bedrooms') }}">
                                        @foreach ($bathrooms as $bathroom)
                                            <option value="bathroom-{{ $bathroom->id }}"
                                                @if (request('bathrooms') && in_array($bathroom->id, request('bathrooms'))) selected @endif>{{ $bathroom->bathroom }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>

                            <div class="col-6 col-md-3">
                                <select class="form-select dd-select" placeholder="{{ __('main.purpose') }}"
                                    name="purpose_ids[]" multiple>
                                    @foreach ($purposes as $purpose)
                                        <option value="{{ $purpose->id }}"
                                            @if (request('purpose_ids') && in_array($purpose->id, request('purpose_ids'))) selected @endif>{{ $purpose->purpose }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 col-lg-3 col-sm-4">
                                <select class="form-select dd-select" placeholder="أقل سعر" name="price_from">
                                    @foreach ($unit_prices_list['units'] as $unit_price)
                                        @if (!is_null($unit_price->price))
                                            <option value="{{ $unit_price->price }}">{{ $unit_price->price }} EGP
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-6 col-lg-3 col-sm-4">
                                <select class="form-select dd-select" placeholder="أعلى سعر" name="price_to">
                                    @foreach ($unit_prices_list['units'] as $unit_price)
                                        @if (!is_null($unit_price->price))
                                            <option value="{{ $unit_price->price }}">{{ $unit_price->price }} EGP
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-6 col-lg-3 col-sm-4">
                                <select class="form-select dd-select" placeholder="المساحة (م2)" name="area">
                                    @foreach ($unit_prices_list['units'] as $unit_price)
                                        @if (!is_null($unit_price->area))
                                            <option value="{{ $unit_price->area }}">{{ $unit_price->area }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-6 col-lg-3 col-sm-4">
                                <select class="form-select dd-select" placeholder="نوع الفرش" name="finishing_types[]"
                                    multiple>
                                    @foreach ($finishing_types as $finishing_type)
                                        <option value="{{ $finishing_type->id }}"
                                            @if (request('finishing_types') && in_array($finishing_type->id, request('finishing_types'))) selected @endif>
                                            {{ $finishing_type->finishing_type }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-6 col-lg-3 col-sm-4">
                                <select class="form-select dd-select"
                                    placeholder="{{ __('inventory::inventory.facilities') }}" name="facilities[]"
                                    multiple>
                                    @foreach ($facilities as $facility)
                                        <option value="{{ $facility->id }}"
                                            @if (request('facilities') && in_array($facility->id, request('facilities'))) selected @endif>
                                            {{ $facility->facility }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-6 col-lg-3 col-sm-4">
                                <select class="form-select dd-select" placeholder="{{ __('main.finishing_type') }}"
                                    name="finishing_types[]" multiple>
                                    @foreach ($finishing_types as $finishing_type)
                                        <option value="{{ $finishing_type->id }}"
                                            @if (request('finishing_types') && in_array($finishing_type->id, request('finishing_types'))) selected @endif>
                                            {{ $finishing_type->finishing_type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row py-2">

                            @foreach ($amenities as $amenity)
                                <div class="col-6 col-lg-3 col-sm-4">
                                    <div class="form-check">
                                        <input type="checkbox" name="amenities[]"
                                            @if (request('amenities') && in_array($amenity->id, request('amenities'))) checked @endif class="form-check-input"
                                            id="feat-{{ $amenity->id }}">
                                        <label class="form-check-label"
                                            for="feat-{{ $amenity->id }}">{{ $amenity->amenity }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>

                </div>

            </div>

            <div class="col-lg-2 order-lg-last order-last">
                <button type="submit" class="submit-btn">
                    {{ __('main.search') }}
                    {{ __('main.advanced_search') }}
                    <i class="ri-search-2-line"></i>
                </button>
            </div>

        </div>

        <button type="button" data-bs-toggle="collapse" data-bs-target="#moreOptions" aria-expanded="false"
            class="more-options-btn">
        </button>

    </form>
</div> --}}
<div class="search-box">
    <form class="search-form"  action=" {{ isset($url) ? $url : route('front.properties') }}" method="GET">

      <div class="nav nav-pills nav-with-indicator mb-3">
        @foreach($offering_types as $offering_type)
         <button class="nav-link {{request('offering_types') ? (in_array($offering_type,request('offering_types')) ? 'active' : '') : ''}}" data-id="{{$offering_type->id}}" onclick="$('.offering_hidden_input').val($(this).attr('data-id'))" data-bs-toggle="pill" aria-selected="true" type="button">{{$offering_type->offering_type}}</button>
         @endforeach
         <input type="hidden" name="offering_types[]" class="offering_hidden_input" value="">
        <span class="nav-indicator"></span>
      </div>

      <div class="row g-2 align-items-start">

        <div class="col-lg-11">
          <div class="row g-2">

            <div class="col-12 col-md-6">
              <input class="form-control" type="text" name="q" value="{{request('q')}}" placeholder="Project, Developer">
            </div>

            <div class="col-6 col-md-3">
              <select class="form-select form-select-checkbox" multiple
              placeholder="{{ __('inventory::inventory.bedrooms') }} & {{ __('inventory::inventory.bedrooms') }}"
              name="bed_bath_rooms[]">
              <optgroup label="{{ __('inventory::inventory.bedrooms') }}">
                  @foreach ($bedrooms as $bedroom)
                      <option value="bedroom-{{ $bedroom->id }}"
                          @if (request('bedrooms') && in_array($bedroom->id, request('bedrooms'))) selected @endif>{{ $bedroom->bedroom }}
                      </option>
                  @endforeach
              </optgroup>
              <optgroup label="{{ __('inventory::inventory.bedrooms') }}">
                  @foreach ($bathrooms as $bathroom)
                      <option value="bathroom-{{ $bathroom->id }}"
                          @if (request('bathrooms') && in_array($bathroom->id, request('bathrooms'))) selected @endif>{{ $bathroom->bathroom }}
                      </option>
                  @endforeach
              </optgroup>
              </select>
            </div>

            <div class="col-6 col-md-3">
              <select class="form-select dd-select" placeholder="{{ __('main.purpose') }}"
                name="purpose_ids[]" multiple>
                @foreach ($purposes as $purpose)
                    <option value="{{ $purpose->id }}"
                        @if (request('purpose_ids') && in_array($purpose->id, request('purpose_ids'))) selected @endif>{{ $purpose->purpose }}
                    </option>
                @endforeach
              </select>
            </div>

            <div class="col-12 collapse" id="moreOptions">
              <div class="row g-2 align-items-center">

                <div class="col-6 col-lg-3 col-sm-4">
                  <select class="form-select dd-select" data-filter="true" placeholder="Min.price(EGP)" name="price_from">
                    <option></option>
                        @foreach ($unit_prices_list['units'] as $unit_price)
                            @if (!is_null($unit_price->price))
                                <option value="{{ $unit_price->price }}">{{ $unit_price->price }} EGP
                                </option>
                            @endif
                        @endforeach
                  </select>
                </div>

                <div class="col-6 col-lg-3 col-sm-4">
                  <select class="form-select dd-select" data-filter="true" placeholder="Max.price(EGP)" name="price_to">
                    <option></option>
                        @foreach ($unit_prices_list['units'] as $unit_price)
                            @if (!is_null($unit_price->price))
                                <option value="{{ $unit_price->price }}">{{ $unit_price->price }} EGP
                                </option>
                            @endif
                        @endforeach
                  </select>
                </div>

                <div class="col-6 col-lg-3 col-sm-4">
                  <select class="form-select dd-select" placeholder="{{ __('main.purpose') }}"
                    name="purpose_ids[]" multiple>
                        <option></option>
                        @foreach ($purposes as $purpose)
                            <option value="{{ $purpose->id }}"
                                @if (request('purpose_ids') && in_array($purpose->id, request('purpose_ids'))) selected @endif>{{ $purpose->purpose }}
                            </option>
                        @endforeach
                  </select>
                </div>

                <div class="col-6 col-lg-3 col-sm-4">
                  <select class="form-select dd-select" data-filter="true" placeholder="{{__('inventory::inventory.down_payment_from')}}" name="down_payment_from">
                    <option></option>
                    @foreach ($unit_prices_list['units'] as $unit_price)
                            @if (!is_null($unit_price->price))
                                <option value="{{ $unit_price->price }}">{{ $unit_price->price }} EGP
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="col-6 col-lg-3 col-sm-4">
                  <select class="form-select dd-select" data-filter="true" placeholder="{{__('inventory::inventory.down_payment_to')}}" name="down_payment_to">
                    <option></option>
                        @foreach ($unit_prices_list['units'] as $unit_price)
                            @if (!is_null($unit_price->price))
                                <option value="{{ $unit_price->price }}">{{ $unit_price->price }} EGP
                                </option>
                            @endif
                        @endforeach

                  </select>
                </div>

                <div class="col-6 col-lg-3 col-sm-4">
                  <select class="form-select dd-select" placeholder="{{__('inventory::inventory.finishing_type')}}" name="finishing_types[]"
                  multiple>
                  @foreach ($finishing_types as $finishing_type)
                      <option value="{{ $finishing_type->id }}"
                          @if (request('finishing_types') && in_array($finishing_type->id, request('finishing_types'))) selected @endif>
                          {{ $finishing_type->finishing_type }}</option>
                  @endforeach>Ultra Super Lux</option>
                  </select>
                </div>

                <div class="col-6 col-lg-3 col-sm-4">
                  <select class="form-select dd-select" placeholder="{{__('main.area')}}" name="area">
                    <option></option>
                    @foreach ($unit_prices_list['units'] as $unit_price)
                        @if (!is_null($unit_price->area))
                            <option value="{{ $unit_price->area }}">{{ $unit_price->area }}
                            </option>
                        @endif
                    @endforeach
                  </select>
                </div>

                <div class="col-6 col-lg-3 col-sm-4">
                  <div class="input-group">
                    <span class="input-group-text">
                      <i class="ri-calendar-check-fill"></i>
                    </span>
                    <input type="text" class="date-input form-control" placeholder="Delivery date">
                  </div>
                </div>

                <div class="col-6 col-lg-3 col-sm-4">
                  <select class="form-select dd-select" placeholder="{{__('inventory::inventory.furnishing_statuses')}}" name="furnishing_status_ids[]">
                    <option></option>
                    @foreach ($furnishing_statuses as $furnishing_status)
                        <option value="{{ $furnishing_status->id }}"
                            @if (request('furnishing_status_ids') && in_array($furnishing_status->id, request('furnishing_status_ids'))) selected @endif>{{ $furnishing_status->furnishing_status }}
                        </option>
                    @endforeach
                  </select>
                </div>

              </div>

              <div class="row py-2">
                    @foreach ($amenities as $amenity)
                        <div class="col-6 col-lg-3 col-sm-4">
                            <div class="form-check">
                                <input type="checkbox" name="amenities[]"
                                    @if (request('amenities') && in_array($amenity->id, request('amenities'))) checked @endif class="form-check-input"
                                    id="feat-{{ $amenity->id }}">
                                <label class="form-check-label"
                                    for="feat-{{ $amenity->id }}">{{ $amenity->amenity }}</label>
                            </div>
                        </div>
                    @endforeach
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-1 order-lg-last order-last">
          <button type="submit" class="submit-btn site-btn" title="Search">
            <i class="ri-search-line"></i>
            <span class="d-inline-block d-lg-none">{{__('main.search')}}</span>
          </button>
        </div>

      </div>

      <button type="button" data-bs-toggle="collapse" data-bs-target="#moreOptions" aria-expanded="false"
        class="more-options-btn">
      </button>

    </form>
    <div class="most-searched mt-2">
      {{-- <a href="units.html" class="badge">North coast</a>
      <a href="units.html" class="badge">New capital</a>
      <a href="units.html" class="badge">New cairo</a>
      <a href="units.html" class="badge">October</a>
      <a href="units.html" class="badge">Hurghada</a> --}}
    </div>
  </div>




@push('scripts')
{{-- <script>
    @if((request('region_id') && !empty(request('region_id'))))
    getRegionCities(@json(request('region_id')), @json(request('city_id')))
    @endif
</script> --}}
@endpush
