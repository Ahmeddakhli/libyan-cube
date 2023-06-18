<div class="sidebar__filter">
    <form class="filter-form" action="{{route('front.search')}}" method="GET" data-parsley-validate>
        <h5 class="list-title text-capitalize mb-3">{{__('main.filter')}}</h5>
        <div class="row">
            <!-- Location -->
            <div class="col-xl-12 col-lg-4 col-md-6 mb-3">
                <div class="form-group search__input mb-1">
                    <input type="text" name="location" placeholder="{{__('locations::location.locations')}}" class="form-control" id="location">
                    <input type="hidden" @if (Request::input('location_id')) value="{{Request::input('location_id')}}" @endif name="location_id" id="location_id">
                </div> <!-- ./ form-group -->
            </div> <!-- ./ col-xl-12 col-lg-4 col-md-6 mb-3 -->

            <!-- Bedrooms -->
            <div class="col-xl-12 col-lg-4 col-md-6 mb-3">
                <div class="form-group m-0">
                    <label class="p-2" for="bedrooms">{{__('inventory::inventory.bedrooms')}}</label>
                    <select class='dropdown-select show-tick beds-select form-control' name="bedrooms[]" multiple title="{{__('inventory::inventory.bedrooms')}}">
                        @foreach($bedrooms as $bedroom)
                           <option value="{{$bedroom->id}}" @if(in_array($bedroom->id, Request::input('bedrooms') ? Request::input('bedrooms') : [])) selected @endif>{{$bedroom->bedroom}}</option>
                        @endforeach
                    </select>
                </div>
            </div> <!-- ./ col-xl-12 col-lg-4 col-md-6 mb-3 -->

            <!-- Budget -->
            <div class="col-xl-12 col-lg-4 col-md-6 mb-3">
                <div class="budget-select custom-select-box">
                    <ul class="custom-options budget-options">
                        <div class="range-budget d-flex align-items-center text-center border-bottom pb-3 w-100">
                            <div class="reset">
                                <ion-icon class='close' name="close-circle-outline"></ion-icon>
                            </div>
                            <div class='range-price focused'>
                                <label for="" class='m-0 p-0'>{{__('inventory::inventory.price_from')}}</label>
                                <input type="text" name="price_from" @if (Request::input('price_from')) value="{{Request::input('price_from')}}" @endif class='min-input focused form-control' placeholder="{{trans('main.min_price')}}">
                            </div>
                            <span class="separtor">-</span>
                            <div class='range-price'>
                                <label for="" class='m-0 p-0'>{{__('inventory::inventory.price_to')}}</label>
                                <input type="text" name="price_to" @if (Request::input('price_to')) value="{{Request::input('price_to')}}" @endif class='max-input form-control' placeholder="{{trans('main.max_price')}}">
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
            </div> <!-- ./ col-xl-12 -->

            <!-- Budget Type -->
            <div class="col-xl-12 col-lg-4 col-md-6 mb-3">
                <div class="form-group m-0">
                    <label class="p-2" for="budget_type">{{__('main.budget_type')}}</label>
                    <select class='dropdown-select show-tick beds-select form-control' name="budget_type" title="{{__('main.budget_type')}}">
                        <option value="total_unit_price" @if (Request::input('budget_type') && Request::input('budget_type') == 'total_unit_price') selected @endif >{{__('main.total_unit_price')}}</option>
                        <option value="down_payment" @if (Request::input('budget_type') && Request::input('budget_type') == 'down_payment') selected @endif >{{__('inventory::inventory.down_payment')}}</option>
                    </select>
                </div>
            </div>
        </div> <!-- ./ row -->

        <!-- Advanced Search Button -->
        <div class="advanced-search-btn">
            <ion-icon name="search-outline" class='search'></ion-icon>
            <span>{{__('main.advanced_search')}}</span>
        </div> <!-- ./ advanced-search-btn -->

        <!-- Advanced Search Area -->
        <div class="advanced-search-area pt-3">
            <div class="row">
                <!-- Must Have -->
                <div class="col-xl-12 col-lg-4 col-md-6">
                    <div class="form-group search__input mb-3">
                        <label class="p-2" for="must_have">{{__('main.include')}}</label>
                        <select class="form-control" id="must-have" name="must_have[]" multiple>
                            @foreach($facilities as $facility)
                                <option value="{{$facility->id}}" @if (in_array($facility->id, Request::input('must_have') ? Request::input('must_have') : [])) selected @endif >{{$facility->facility}}</option>
                            @endforeach
                            @foreach($amenities as $amenity)
                                <option value="{{$amenity->id}}" @if (in_array($amenity->id, Request::input('must_have') ? Request::input('must_have') : [])) selected @endif>{{$amenity->amenity}}</option>
                            @endforeach
                        </select>
                        <ion-icon name="add-outline"></ion-icon>
                    </div> <!-- ./ form-group -->
                </div> <!-- ./ col-xl-12 col-lg-4 col-md-6 -->

                <!-- Don't Have -->
                <div class="col-xl-12 col-lg-4 col-md-6">
                    <div class="form-group search__input">
                        <label class="p-2" for="not_have">{{__('main.exclude')}}</label>
                        <select class="form-control" id="dont-have" name="not_have[]" multiple>
                            @foreach($facilities as $facility)
                                <option value="{{$facility->id}}" @if (in_array($facility->id, Request::input('not_have') ? Request::input('not_have') : [])) selected @endif>{{$facility->facility}}</option>
                            @endforeach
                            @foreach($amenities as $amenity)
                                <option value="{{$amenity->id}}" @if (in_array($amenity->id, Request::input('not_have') ? Request::input('not_have') : [])) selected @endif>{{$amenity->amenity}}</option>
                            @endforeach
                        </select>
                        <ion-icon name="remove-outline"></ion-icon>
                    </div> <!-- ./ form-group -->
                </div> <!-- ./ col-xl-12 col-lg-4 col-md-6 -->

                <!-- Area From -->
                <div class="col-md-12 p-0 ">
                    <div class='form-group search__input mb-1 col-12 p-2 border-left border-dark'>
                        <label class="p-2" for="area_from">{{__('inventory::inventory.area_from')}}</label>
                        <input type="number" parsley-type="number" @if (Request::input('area_from')) value="{{Request::input('area_from')}}" @endif name="area_from" class='form-control' placeholder="{{__('inventory::inventory.area_from')}}">
                    </div>
                    <div class='form-group search__input mb-1 col-12 p-2 border-left border-dark'>
                        <label class="p-2" for="area_to">{{__('inventory::inventory.area_to')}}</label>
                        <input type="number" parsley-type="number" @if (Request::input('area_to')) value="{{Request::input('area_to')}}" @endif name="area_to" class='form-control' placeholder="{{__('inventory::inventory.area_to')}}">
                    </div>
                </div> <!-- ./ col-xl-6 -->

                {{--
                <!-- Build Up Area From && Build Up Area To -->
                <div class="col-md-12 p-0 ">
                    <div class='form-group search__input mb-1 col-12 p-2 border-left border-dark'>
                        <label class="p-2" for="build_up_area_from">{{__('inventory::inventory.build_up_area_from')}}</label>
                        <input type="number" step="0.01" parsley-type="number" @if (Request::input('build_up_area_from')) value="{{Request::input('build_up_area_from')}}" @endif name="build_up_area_from" class='form-control' placeholder="{{__('inventory::inventory.build_up_area_from')}}">
                    </div>
                    <div class='form-group search__input mb-1 col-12 p-2 border-left border-dark'>
                        <label class="p-2" for="build_up_area_to">{{__('inventory::inventory.build_up_area_to')}}</label>
                        <input type="number" step="0.01" parsley-type="number" @if (Request::input('build_up_area_to')) value="{{Request::input('build_up_area_to')}}" @endif name="build_up_area_to" class='form-control' placeholder="{{__('inventory::inventory.build_up_area_to')}}">
                    </div>
                </div>

                <!-- Plot Area From && Plot Area To -->
                <div class="col-md-12 p-0 ">
                    <div class='form-group search__input mb-1 col-12 p-2 border-left border-dark'>
                        <label class="p-2" for="plot_area_from">{{__('inventory::inventory.plot_area_from')}}</label>
                        <input type="number" step="0.01" parsley-type="number" @if (Request::input('plot_area_from')) value="{{Request::input('plot_area_from')}}" @endif name="plot_area_from" class='form-control' placeholder="{{__('inventory::inventory.plot_area_from')}}">
                    </div>
                    <div class='form-group search__input mb-1 col-12 p-2 border-left border-dark'>
                        <label class="p-2" for="plot_area_to">{{__('inventory::inventory.plot_area_to')}}</label>
                        <input type="number" step="0.01" parsley-type="number" @if (Request::input('plot_area_to')) value="{{Request::input('plot_area_to')}}" @endif name="plot_area_to" class='form-control' placeholder="{{__('inventory::inventory.plot_area_to')}}">
                    </div>
                </div>

                <!-- Garden Area From && Garden Area To -->
                <div class="col-md-12 p-0 ">
                    <div class='form-group search__input mb-1 col-12 p-2 border-left border-dark'>
                        <label class="p-2" for="garden_area_from">{{__('inventory::inventory.garden_area_from')}}</label>
                        <input type="number" step="0.01" parsley-type="number" @if (Request::input('garden_area_from')) value="{{Request::input('garden_area_from')}}" @endif name="garden_area_from" class='form-control' placeholder="{{__('inventory::inventory.garden_area_from')}}">
                    </div>
                    <div class='form-group search__input mb-1 col-12 p-2 border-left border-dark'>
                        <label class="p-2" for="garden_area_to">{{__('inventory::inventory.garden_area_to')}}</label>
                        <input type="number" step="0.01" parsley-type="number" @if (Request::input('garden_area_to')) value="{{Request::input('garden_area_to')}}" @endif name="garden_area_to" class='form-control' placeholder="{{__('inventory::inventory.garden_area_to')}}">
                    </div>
                </div>
                --}}

                <!-- Delivery Date From && Delivery Date To -->
                <div class="col-md-12 p-0 ">
                    <div class='form-group search__input mb-1 col-12 p-2 border-left border-dark'>
                        <label class="p-2" for="delivery_date_from">{{__('inventory::inventory.delivery_date_from')}}</label>
                        <input type="text" @if (Request::input('delivery_date_from')) value="{{Request::input('delivery_date_from')}}" @endif name="delivery_date_from" class='form-control datetimepicker-init' placeholder="{{__('inventory::inventory.delivery_date_from')}}">
                    </div>
                    <div class='form-group search__input mb-1 col-12 p-2 border-left border-dark'>
                        <label class="p-2" for="delivery_date_to">{{__('inventory::inventory.delivery_date_to')}}</label>
                        <input type="text" @if (Request::input('delivery_date_to')) value="{{Request::input('delivery_date_to')}}" @endif name="delivery_date_to" class='form-control datetimepicker-init' placeholder="{{__('inventory::inventory.delivery_date_to')}}">
                    </div>
                </div><!-- ./ col-xl-12 col-lg-4 col-md-6 mt-xl-3 -->

                <!-- Offering Types -->
                @if (!in_array(Route::currentRouteName(), ['front.resale', 'primary']))
                    <div class="col-xl-12 col-lg-4 col-md-6 mb-3">
                        <div class="form-group search__input mb-1">
                            <label class="p-2" for="offering_types">{{__('inventory::inventory.offering_type')}}</label>
                            <select class="form-control" id="select-type" name="offering_types[]" multiple>
                                @foreach($offering_types as $offering_type)
                                    <option value="{{$offering_type->id}}" @if (in_array($offering_type->id, Request::input('offering_types') ? Request::input('offering_types') : [])) selected @endif >{{$offering_type->offering_type}}</option>
                                @endforeach
                            </select>
                            {{-- <ion-icon name="keypad-outline"></ion-icon> --}}
                        </div> <!-- ./ form-group -->
                    </div> <!-- ./ col-xl-12 col-lg-4 col-md-6 mb-3 -->
                @endif

                <!-- Payment Methods -->
                <div class="col-xl-12 col-lg-4 col-md-6 mb-3">
                    <div class="form-group m-0">
                        <label class="p-2" for="payment_methods">{{__('inventory::inventory.payment_method')}}</label>
                        <select class="dropdown-select show-tick form-control" id="payment_methods" name="payment_methods[]" multiple>
                            @foreach($payment_methods as $payment_method)
                                <option value="{{$payment_method->id}}" @if (in_array($payment_method->id, Request::input('payment_methods') ? Request::input('payment_methods') : [])) selected @endif>{{$payment_method->payment_method}}</option>
                            @endforeach
                        </select>
                    </div> <!-- ./ form-group -->
                </div>

                <!-- Purposes -->
                <div class="col-xl-12 col-lg-4 col-md-6 mb-3">
                    <div class="form-group m-0">
                        <label class="p-2" for="purpose_ids">{{__('inventory::inventory.purposes')}}</label>
                        <select class='dropdown-select show-tick Property-sell-select form-control' name="purpose_ids[]" multiple onchange="getPurposePurposeTypes($(this).val(), 'i_purpose_type_id')" title="{{__('inventory::inventory.select_purpose')}}"  data-parsley-errors-container="#purpose_error_container">
                            @foreach($purposes as $purpose)
                                <option value="{{$purpose->id}}" @if (in_array($purpose->id, Request::input('purpose_ids') ? Request::input('purpose_ids') : [])) selected @endif >{{$purpose->purpose}}</option>
                            @endforeach
                        </select>
                        <div id="purpose_error_container" class="error_container"></div>
                    </div>
                </div>

                <!-- Purpose Types -->
                <div class="col-xl-12 col-lg-4 col-md-6 mb-3">
                    <div class="form-group m-0">
                        <label class="p-2" for="purpose_type_ids">{{__('inventory::inventory.purpose_types')}}</label>
                        <select class='dropdown-select show-tick prop-type-select form-control' name="purpose_type_ids[]" id="i_purpose_type_id"  multiple title="{{__('inventory::inventory.purpose_type')}}">
                        </select>
                    </div>
                </div> <!-- ./ col-xl-12 col-lg-4 col-md-6 mb-3 -->

                <!-- Developers -->
                <div class="col-xl-12 col-lg-4 col-md-6 mb-3">
                    <div class="form-group m-0">
                        <label class="p-2" for="developers">{{__('inventory::inventory.developers')}}</label>
                        <select class='dropdown-select show-tick developers-select form-control' name="developers[]" multiple title="{{__('inventory::inventory.developer')}}">
                            @foreach($developers as $developer)
                                <option value="{{$developer->id}}" @if (in_array($developer->id, Request::input('developers') ? Request::input('developers') : [])) selected @endif >{{$developer->developer}}</option>
                            @endforeach
                        </select>
                    </div>
                </div> <!-- ./ col-xl-12 col-lg-4 col-md-6 mb-3 -->

                <!-- Finishing Types -->
                <div class="col-xl-12 col-lg-4 col-md-6 mb-3">
                    <div class="form-group m-0">
                        <label class="p-2" for="finishing_types">{{__('inventory::inventory.finishing_types')}}</label>
                        <select class='dropdown-select show-tick finishing-select form-control' name="finishing_types[]" multiple title="{{__('inventory::inventory.finishing_type')}}">
                            @foreach($finishing_types as $finishing_type)
                                <option value="{{$finishing_type->id}}" @if (in_array($finishing_type->id, Request::input('finishing_types') ? Request::input('finishing_types') : [])) selected @endif >{{$finishing_type->finishing_type}}</option>
                            @endforeach
                        </select>
                    </div>
                </div> <!-- ./ col-xl-12 col-lg-4 col-md-6 mb-3 -->

                <!-- Design Types -->
                <div class="col-xl-12 col-lg-4 col-md-6 mb-3">
                    <div class="form-group m-0">
                        <label class="p-2" for="design_types">{{__('inventory::inventory.design_types')}}</label>
                        <select class='dropdown-select show-tick finishing-select form-control' name="design_types[]" multiple title="{{__('inventory::inventory.design_type')}}">
                            @foreach($design_types as $design_type)
                                <option value="{{$design_type->id}}" @if (in_array($design_type->id, Request::input('design_types') ? Request::input('design_types') : [])) selected @endif >{{$design_type->type}}</option>
                            @endforeach
                        </select>
                    </div>
                </div> <!-- ./ col-xl-2 -->
            </div>

            <!-- Unit Type -->
            <div class="form-group ml-sm-3 ml-0 mt-2 mt-sm-0 d-block d-sm-inline-block mb-0 radiobutton">
                @if (Route::currentRouteName() == "front.search")
                    <div class="form-group m-0 d-block d-sm-inline-block radiobutton">
                        <input type="radio" name="type" @if (Request::input('type') && Request::input('type') == 'unit') checked @endif value="unit" id="radio_1" />
                        <label for="radio_1">{{__('inventory::inventory.unit')}}</label>
                    </div>
                    <div class="form-group ml-sm-3 ml-0 mt-2 mt-sm-0 d-block d-sm-inline-block mb-0 radiobutton">
                        <input type="radio" name="type" value="project" @if (Request::input('type') && Request::input('type') == 'project') checked @endif id="radio_2" />
                        <label for="radio_2">{{__('inventory::inventory.project')}}</label>
                    </div>
                @endif
            </div>
        </div>

        <!-- Design Type -->
        @if(Route::currentRouteName() == "front.design_type")
            <input type="hidden" name="design_type" value="{{$title}}">
        @endif

        <div class="submit-btn-container mt-3">
            <button type="submit">
                <ion-icon name="search-outline" class='search'></ion-icon>
                {{__('main.search')}}
            </button>
        </div> <!-- ./ row -->
    </form>

    <!-- ./ submit-btn--container -->

    @include('front.components.compare')
    <!-- ./ sidebar__compare--list-->
</div>

@push('scripts')
    <!-- Load request data -->
    <script>
        @if (Request::input('location') && !empty(Request::input('location')))
            $('#location').autocomplete({
              // do whatever
            }).val("{{Request::input('location')}}");
            $('#location_id').val("{{Request::input('location_id')}}");  
        @endif

        @if(Request::input('purpose_ids') && Request::input('purpose_type_ids'))
            getPurposePurposeTypes(@json(Request::input('purpose_ids')), 'i_purpose_type_id')

            @if (Request::input('purpose_type_ids'))
                /* Delay the loading until purpose types reload occurs */
                setTimeout(
                  function() 
                  {
                    $('#i_purpose_type_id').selectpicker('val', @json(Request::input('purpose_type_ids')));
                    $("#i_purpose_type_id").selectpicker("refresh");
                  }, 5000);    
            @endif
        @endif
    </script>
@endpush
