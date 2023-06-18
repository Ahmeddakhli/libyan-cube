<div class="main-search-box">
    <form action="{{route('front.search')}}" method="GET">
        <input type="hidden" name="search_type" value="rent">
        <div class="row m-0">
            <!-- Locations -->
            <div class="col-xl-4 p-0 mb-1 mb-xl-0">
                <div class="form-group search__input mb-1">
                    <input type="text" name="location" placeholder="{{__('locations::location.locations')}}" class="form-control" id="location_rent_form">
                    <input type="hidden" name="location_id" id="location_id">
                </div> <!-- ./ form-group -->
            </div> <!-- ./ col-xl-6 -->

            <!-- Bedrooms -->
            <div class="col-xl-2 col-md-6 p-0 mb-1 mb-xl-0">
                <div class="form-group m-0">
                    <select class='dropdown-select show-tick beds-select form-control' name="bedrooms[]" multiple title='{{__('inventory::inventory.bedrooms')}}'>
                        @foreach($bedrooms as $bedroom)
                            <option value="{{$bedroom->id}}">{{$bedroom->bedroom}}</option>
                        @endforeach
                    </select>
                </div>
            </div> <!-- ./ col-xl-2 -->

            <!-- Budget -->
            <div class="col-xl-4 col-md-6 p-0 mb-1 mb-xl-0 d-flex">
                <div class="budget-select custom-select-box col-6">
                    <ul class="custom-options budget-options">
                        <div class="range-budget d-flex align-items-center text-center border-bottom pb-3 w-100">
                            <div class="reset">
                                <ion-icon class='close' name="close-circle-outline"></ion-icon>
                            </div>
                            <div class='range-price focused'>
                                <label for="" class='m-0 p-0'>{{__('inventory::inventory.price_from')}}</label>
                                <input type="text" name="price_from" class='min-input focused form-control' placeholder="{{trans('main.min_price')}}">
                            </div>
                            <span class="separtor">-</span>
                            <div class='range-price'>
                                <label for="" class='m-0 p-0'>{{__('inventory::inventory.price_to')}}</label>
                                <input type="text" name="price_to" class='max-input form-control' placeholder="{{trans('main.max_price')}}">
                            </div>
                        </div>
                        <ul class="min">
                            @if (count($unit_prices_list))
                                @foreach($unit_prices_list as $price)
                                    <li class="option" data-value='{{$price}}'>{{$price}}</li>
                                @endforeach
                            @endif
                        </ul>
                        <ul class="max">
                            @if (count($unit_prices_list))
                                @foreach($unit_prices_list as $price)
                                    <li class="option" data-value='{{$price}}'>{{$price}}</li>
                                @endforeach
                            @endif
                        </ul>
                    </ul>
                    <span class='selected-budget'>{{__('main.budget')}}</span>
                    <ion-icon name="caret-down-outline" class='chev'></ion-icon>
                </div>
                <div class="form-group p-0 col-6 m-0">
                    <select class='dropdown-select show-tick beds-select form-control' name="budget_type" title="{{__('main.budget_type')}}">
                        <option value="total_unit_price">{{__('main.total_unit_price')}}</option>
                        <option value="down_payment">{{__('inventory::inventory.down_payment')}}</option>
                    </select>
                </div>
            </div> <!-- ./ col-xl-2 -->

            <!-- Search Button -->
            <div class="col-xl-2  p-0  search-first d-none d-xl-block">
                <div class="form-group m-0">
                    <div class="submit-btn-container">
                        <button type="submit">
                            <ion-icon name="search-outline" class='search'></ion-icon>
                            {{__('main.search')}}
                        </button>
                    </div> <!-- ./ submit-btn-container -->
                </div> <!-- ./ form-group-->
            </div> <!-- ./ col-xl-2 -->
        </div> <!-- ./ row -->

        <!-- Advanced Search Area -->
        <div class="advanced-search-area">
            <div class="row mt-xl-1 mx-0">
                <!-- Must Have -->
                <div class="col-xl-6 p-0">
                    <div class="form-group search__input mb-1">
                        <select class="form-control" id="must-have-rent" name="must_have[]" multiple>
                            @foreach($facilities as $facility)
                                <option value="{{$facility->id}}">{{$facility->facility}}</option>
                            @endforeach
                            @foreach($amenities as $amenity)
                                <option value="{{$amenity->id}}">{{$amenity->amenity}}</option>
                            @endforeach

                        </select>
                        <ion-icon name="add-outline"></ion-icon>
                    </div> <!-- ./ form-group -->
                </div> <!-- ./ col-xl-6 -->

                <!-- Don't Have -->
                <div class="col-xl-6 p-0">
                    <div class="form-group search__input mb-1">
                        <select class="form-control" id="dont-have-rent" name="not_have[]" multiple>
                            @foreach($facilities as $facility)
                                <option value="{{$facility->id}}">{{$facility->facility}}</option>
                            @endforeach
                            @foreach($amenities as $amenity)
                                <option value="{{$amenity->id}}">{{$amenity->amenity}}</option>
                            @endforeach

                        </select>
                        <ion-icon name="remove-outline"></ion-icon>
                    </div> <!-- ./ form-group -->
                </div> <!-- ./ col-xl-6 -->

                <!-- Area From && Area To -->
                <div class="col-md-6 p-0 d-flex">
                    <div class='form-group search__input mb-1 col-6 p-0 border-left border-dark'>
                        <input type="number" name="area_from" class='form-control' placeholder="{{__('inventory::inventory.area_from')}}">
                    </div>
                    <div class='form-group search__input mb-1 col-6 p-0 border-left border-dark'>
                        <input type="number" name="area_to" class='form-control' placeholder="{{__('inventory::inventory.area_to')}}">
                    </div>
                </div> <!-- ./ col-xl-6 -->

                {{--
                <!-- Build Up Area From && Build Up Area To -->
                <div class="col-md-6 p-0 d-flex">
                    <div class='form-group search__input mb-1 col-6 p-0 border-left border-dark'>
                        <input type="number" step="0.01" name="build_up_area_from" class='form-control' placeholder="{{__('inventory::inventory.build_up_area_from')}}">
                    </div>
                    <div class='form-group search__input mb-1 col-6 p-0 border-left border-dark'>
                        <input type="number" step="0.01" name="build_up_area_to" class='form-control' placeholder="{{__('inventory::inventory.build_up_area_to')}}">
                    </div>
                </div>

                <!-- Plot Area From && Plot Area To -->
                <div class="col-md-6 p-0 d-flex">
                    <div class='form-group search__input mb-1 col-6 p-0 border-left border-dark'>
                        <input type="number" step="0.01" name="plot_area_from" class='form-control' placeholder="{{__('inventory::inventory.plot_area_from')}}">
                    </div>
                    <div class='form-group search__input mb-1 col-6 p-0 border-left border-dark'>
                        <input type="number" step="0.01" name="plot_area_to" class='form-control' placeholder="{{__('inventory::inventory.plot_area_to')}}">
                    </div>
                </div>

                <!-- Garden Area From && Garden Area To -->
                <div class="col-md-6 p-0 d-flex">
                    <div class='form-group search__input mb-1 col-6 p-0 border-left border-dark'>
                        <input type="number" step="0.01" name="garden_area_from" class='form-control' placeholder="{{__('inventory::inventory.garden_area_from')}}">
                    </div>
                    <div class='form-group search__input mb-1 col-6 p-0 border-left border-dark'>
                        <input type="number" step="0.01" name="garden_area_to" class='form-control' placeholder="{{__('inventory::inventory.garden_area_to')}}">
                    </div>
                </div>
                --}}

                <!-- Delivery Date From && Delivery Date To -->
                <div class="col-md-6 p-0 d-flex">
                    <div class='form-group search__input mb-1 col-6 p-0 border-left border-dark'>
                        <input type="text" name="delivery_date_from" class='form-control datetimepicker-init' placeholder="{{__('inventory::inventory.delivery_date_from')}}">
                    </div>
                    <div class='form-group search__input mb-1 col-6 p-0 border-left border-dark'>
                        <input type="text" name="delivery_date_to" class='form-control datetimepicker-init' placeholder="{{__('inventory::inventory.delivery_date_to')}}">
                    </div>
                </div>

                <!-- Payment Methods -->
                <!-- ./ col-xl-6 -->
                <div class="col-md-3 p-0">
                    <div class="form-group search__input mb-1">
                        <select class="form-control" id="payment_method_rent" name="payment_methods[]" multiple>
                            @foreach($payment_methods as $payment_method)
                                <option value="{{$payment_method->id}}">{{$payment_method->payment_method}}</option>
                            @endforeach
                        </select>
                        <ion-icon name="keypad-outline"></ion-icon>
                    </div> <!-- ./ form-group -->
                </div>

                <!-- Purposes -->
                <div class="col-xl-3 mb-1 col-sm-6 p-0">
                    <div class="form-group m-0">
                        <select class='dropdown-select show-tick Property-sell-select form-control' name="purpose_ids[]" multiple onchange="getPurposePurposeTypes($(this).val(), 'i_purpose_type_id_rent')" title="{{__('inventory::inventory.select_purpose')}}"  data-parsley-errors-container="#purpose_error_container">
                            @foreach($purposes as $purpose)
                                <option value="{{$purpose->id}}">{{$purpose->purpose}}</option>
                            @endforeach
                        </select>
                        <div id="purpose_error_container" class="error_container"></div>
                    </div>
                </div>

                <!-- Purpose Types -->
                <div class="col-xl-3 mb-1 col-sm-6 p-0">
                    <div class="form-group m-0">
                        <select class='dropdown-select show-tick prop-type-select form-control' id="i_purpose_type_id_rent" name="purpose_type_ids[]" multiple title="{{__('inventory::inventory.purpose_type')}}">
                        </select>
                    </div>
                </div> <!-- ./ col-xl-2 -->

                <!-- Developers -->
                <div class="col-xl-2 mb-1 col-sm-6 p-0">
                    <div class="form-group m-0">
                        <select class='dropdown-select show-tick developers-select form-control' name="developers[]" multiple title="{{__('inventory::inventory.developer')}}">
                            @foreach($developers as $developer)
                                <option value="{{$developer->id}}">{{$developer->developer_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div> <!-- ./ col-xl-2 -->

                <!-- Finishing Types -->
                <div class="col-xl-2 mb-1 col-sm-6 p-0">
                    <div class="form-group m-0">
                        <select class='dropdown-select show-tick finishing-select form-control' name="finishing_types[]" multiple title="{{__('inventory::inventory.finishing_type')}}">
                            @foreach($finishing_types as $finishing_type)
                                <option value="{{$finishing_type->id}}">{{$finishing_type->finishing_type}}</option>
                            @endforeach
                        </select>
                    </div>
                </div> <!-- ./ col-xl-2 -->

                <!-- Design Types -->
                <div class="col-xl-2 mb-1 col-sm-6 p-0">
                    <div class="form-group m-0">
                        <select class='dropdown-select show-tick design-types-select form-control' name="design_types[]" multiple title="{{__('inventory::inventory.design_type')}}">
                            @foreach($design_types as $design_type)
                                <option value="{{$design_type->id}}">{{$design_type->type}}</option>
                            @endforeach
                        </select>
                    </div>
                </div> <!-- ./ col-xl-2 -->

                <!-- Unit or Project -->
                <div class="col-sm-6 pr-0 pl-2 mt-2">
                    <div class="form-group m-0 d-block d-sm-inline-block">
                        <input type="radio" name="type" value="unit" id="radio_1" />
                        <label for="radio_1">{{__('inventory::inventory.unit')}}</label>
                        <input type="radio" name="type" value="project" id="radio_2" />
                        <label for="radio_2">{{__('inventory::inventory.project')}}</label>
                    </div>
                </div>
            </div> <!-- ./ row -->
        </div> <!-- ./ advanced-search-area -->
        <div class="col-xl-2 p-0 mt-3 d-block d-xl-none search-last">
            <div class="form-group m-0">
                <div class="submit-btn-container">
                    <button type="submit">
                        <ion-icon name="search-outline" class='search'></ion-icon>
                        {{__('main.search')}}
                    </button>
                </div> <!-- ./ submit-btn-container -->
            </div> <!-- ./ form-group-->
        </div> <!-- ./ col-xl-2 -->
    </form>
</div>