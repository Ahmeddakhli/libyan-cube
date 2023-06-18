<div class="kt-section">
    <div class="kt-section__content kt-section__content--solid kt-section__content--fit">
        <ul class="kt-nav kt-nav--bold kt-nav--md-space kt-nav--v3 set-as-active" id="settings_nav" role="tablist">

            {{-- @haspermission('index-inventory-developers')
            <li class="kt-nav__item">
                <a href="{{route('inventory.developers.index')}}" data-8xload-it-in-href="#loadBISettingsContent" class="kt-nav__link active">
                    <span class="kt-nav__link-text">{{trans('left_aside.developers_list')}}</span>
                </a>
            </li>
            @endhaspermission --}}

            @haspermission('index-inventory-facilities')
            <li class="kt-nav__item">
                <a href="{{route('inventory.facilities.index')}}" data-8xload-it-in-href="#loadBISettingsContent" class="kt-nav__link">
                    <span class="kt-nav__link-text">{{trans('left_aside.facilities_list')}}</span>
                </a>
            </li>
            @endhaspermission

            @haspermission('index-inventory-amenities')
                <li class="kt-nav__item">
                    <a href="{{route('inventory.amenities.index')}}" data-8xload-it-in-href="#loadBISettingsContent" class="kt-nav__link">
                        <span class="kt-nav__link-text">{{trans('left_aside.amenities_list')}}</span>
                    </a>
                </li>
            @endhaspermission

            @haspermission('index-inventory-area-units')
            <li class="kt-nav__item">
                <a href="{{route('inventory.area_units.index')}}" data-8xload-it-in-href="#loadBISettingsContent" class="kt-nav__link">
                    <span class="kt-nav__link-text">{{trans('left_aside.area_units_list')}}</span>
                </a>
            </li>
            @endhaspermission

            @haspermission('index-inventory-bathrooms')
            <li class="kt-nav__item">
                <a href="{{route('inventory.bathrooms.index')}}" data-8xload-it-in-href="#loadBISettingsContent" class="kt-nav__link">
                    <span class="kt-nav__link-text">{{trans('left_aside.bathrooms_list')}}</span>
                </a>
            </li>
            @endhaspermission

            @haspermission('index-inventory-bedrooms')
            <li class="kt-nav__item">
                <a href="{{route('inventory.bedrooms.index')}}" data-8xload-it-in-href="#loadBISettingsContent" class="kt-nav__link">
                    <span class="kt-nav__link-text">{{trans('left_aside.bedrooms_list')}}</span>
                </a>
            </li>
            @endhaspermission

            @haspermission('index-inventory-finishing-types')
            <li class="kt-nav__item">
                <a href="{{route('inventory.finishing_types.index')}}" data-8xload-it-in-href="#loadBISettingsContent" class="kt-nav__link">
                    <span class="kt-nav__link-text">{{trans('left_aside.finishing_types_list')}}</span>
                </a>
            </li>
            @endhaspermission

            @haspermission('index-inventory-purposes')
            <li class="kt-nav__item">
                <a href="{{route('inventory.purposes.index')}}" data-8xload-it-in-href="#loadBISettingsContent" class="kt-nav__link">
                    <span class="kt-nav__link-text">{{trans('left_aside.purposes_list')}}</span>
                </a>
            </li>
            @endhaspermission

            @haspermission('index-inventory-furnishing-statuses')
            <li class="kt-nav__item">
                <a href="{{route('inventory.furnishing_statuses.index')}}" data-8xload-it-in-href="#loadBISettingsContent" class="kt-nav__link">
                    <span class="kt-nav__link-text">{{trans('left_aside.furnishing_statuses_list')}}</span>
                </a>
            </li>
            @endhaspermission

            @haspermission('index-inventory-offering-types')
            <li class="kt-nav__item">
                <a href="{{route('inventory.offering_types.index')}}" data-8xload-it-in-href="#loadBISettingsContent" class="kt-nav__link">
                    <span class="kt-nav__link-text">{{trans('left_aside.offering_types_list')}}</span>
                </a>
            </li>
            @endhaspermission
            @haspermission('index-inventory-purpose-types')
                <li class="kt-nav__item">
                    <a href="{{route('inventory.purpose_types.index')}}" data-8xload-it-in-href="#loadBISettingsContent" class="kt-nav__link">
                        <span class="kt-nav__link-text">{{trans('left_aside.purpose_types_list')}}</span>
                    </a>
                </li>
            @endhaspermission
            @haspermission('index-inventory-payment-methods')
                <li class="kt-nav__item">
                    <a href="{{route('inventory.payment_methods.index')}}" data-8xload-it-in-href="#loadBISettingsContent" class="kt-nav__link">
                        <span class="kt-nav__link-text">{{trans('left_aside.payment_methods_list')}}</span>
                    </a>
                </li>
            @endhaspermission
            {{--
            @haspermission('index-inventory-positions')
                <li class="kt-nav__item">
                    <a href="{{route('inventory.positions.index')}}" data-8xload-it-in-href="#loadBISettingsContent" class="kt-nav__link">
                        <span class="kt-nav__link-text">{{trans('left_aside.positions_list')}}</span>
                    </a>
                </li>
            @endhaspermission

            @haspermission('index-inventory-views')
                <li class="kt-nav__item">
                    <a href="{{route('inventory.views.index')}}" data-8xload-it-in-href="#loadBISettingsContent" class="kt-nav__link">
                        <span class="kt-nav__link-text">{{trans('left_aside.views_list')}}</span>
                    </a>
                </li>
            @endhaspermission

            @haspermission('index-inventory-floor-numbers')
                <li class="kt-nav__item">
                    <a href="{{route('inventory.floor_numbers.index')}}" data-8xload-it-in-href="#loadBISettingsContent" class="kt-nav__link">
                        <span class="kt-nav__link-text">{{trans('left_aside.floor_numbers')}}</span>
                    </a>
                </li>
            @endhaspermission

            @haspermission('index-inventory-design-types')
                <li class="kt-nav__item">
                    <a href="{{route('inventory.design_types.index')}}" data-8xload-it-in-href="#loadBISettingsContent" class="kt-nav__link">
                        <span class="kt-nav__link-text">{{trans('left_aside.designtypes_list')}}</span>
                    </a>
                </li>
            @endhaspermission--}}
          
        </ul>
    </div>
</div>