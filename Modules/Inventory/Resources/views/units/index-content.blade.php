@include('dashboard.components.full_modal')
@section('title', __('inventory::inventory.units'))

<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-margin-t-10">

    <!-- begin:: Content -->
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <!-- begin:: Content -->
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
            <div class="kt-portlet">
                <div class="kt-portlet__head head-zindex-fix">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title kt-font-danger animated bounceIn">
                            <i class="fas fa-city"></i> <span>{{__('inventory::inventory.units')}}</span> <small><span class="kt-font-success kt-font-bolder">{{trans('inventory::inventory.real_estate')}}</span></small>
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        {{--@haspermission('create-inventory-unit')
                            <a href="{{route('inventory.units.importModal')}}" class="btn btn-secondary mx-3 py-2" data-toggle="modal" data-target="#full_modal" data-path="{{route('inventory.units.importModal')}}" data-title="{{trans('inventory::inventory.units_import')}}" data-modal-load>
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>{{trans('inventory::inventory.units_import')}}</span>
                                </span>
                            </a>
                        @endhaspermission--}}
                        <ul class="nav nav-pills nav-pills-sm animated fadeIn" id="lccatypesFilter" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active filter-lcca-type" data-push-it='{"target":"#workspaceTitle", "type":"html", "html": "<i class=\"fas fa-building fa-sm\"></i> {{__("inventory::inventory.properties")}}"}' data-toggle="tab" href="#" role="tab">
                                    <i class="fas fa-building"></i> {{trans('inventory::inventory.units')}}
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-plus"></i> {{trans('inventory::inventory.create_new')}}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(95px, 59px, 0px);">
                                    @haspermission('create-inventory-unit')
                                        <a class="dropdown-item" href="{{route('inventory.units.create')}}"><i class="fas fa-building kt-padding-t-5 fa-sm kt-menu__link-bullet"></i> {{trans('inventory::inventory.unit')}}</a>
                                    @endhaspermission

                                    @haspermission('create-inventory-project')
                                        <a class="dropdown-item" href="{{route('inventory.projects.create')}}"><i class="fas fa-city kt-padding-t-5 fa-sm kt-menu__link-bullet"></i> {{trans('inventory::inventory.project')}}</a>
                                    @endhaspermission
                                </div>
                            </li>

                            @if (
                            auth()->user()->hasPermission('index-inventory-developers') ||
                            auth()->user()->hasPermission('index-inventory-facilities') ||
                            auth()->user()->hasPermission('index-inventory-amenities') ||
                            auth()->user()->hasPermission('index-inventory-area-units') ||
                            auth()->user()->hasPermission('index-inventory-bathrooms') ||
                            auth()->user()->hasPermission('index-inventory-bedrooms') ||
                            auth()->user()->hasPermission('index-inventory-finishing-types') ||
                            auth()->user()->hasPermission('index-inventory-purposes') ||
                            auth()->user()->hasPermission('index-inventory-projects') ||
                            auth()->user()->hasPermission('index-inventory-furnishing-statuses') ||
                            auth()->user()->hasPermission('index-inventory-offering-types') ||
                            auth()->user()->hasPermission('index-inventory-payment-methods') ||
                            auth()->user()->hasPermission('index-inventory-positions') ||
                            auth()->user()->hasPermission('index-inventory-views') ||
                            auth()->user()->hasPermission('index-inventory-purpose-types') || 
                            auth()->user()->hasPermission('index-inventory-floor-numbers') ||
                            auth()->user()->hasPermission('index-inventory-design-types')
                            )
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('inventory.settings')}}" data-skin="dark" data-toggle="kt-tooltip" data-placement="top" title="" data-original-title="{{trans('inventory::inventory.settings')}}" role="tab">
                                        <i class="fas fa-cogs"></i>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="kt-portlet__bar">
                    <div class="col-12">
                        @include('inventory::units.index-bar')
                    </div>
                </div>
                <div id="lccfilter" class="toggleit-off kt-padding-t-15">
                    <div class="col-12">
                        @include('inventory::units.index-filter')
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-12 col-md-12 kt-margin-b-15">
                            <div id="BIListing">
                                <!--begin: Datatable -->
                                <table class="table table-striped table-bordered table-hover table-checkable datatable" id="units_table">
                                    <thead>
                                        <tr>
                                        <th title="{{__('inventory::inventory.id')}}">#</th>
                                            <th>{{__('inventory::inventory.title')}}</th>
                                            <th>{{__('inventory::inventory.space')}}</th>
                                            <th>{{__('inventory::inventory.offering_type')}}</th>
                                            <th>{{__('inventory::inventory.location')}}</th>
                                            <th>{{__('inventory::inventory.price')}}</th>
                                            {{-- <th>{{__('inventory::inventory.description')}}</th> --}}
                                            <th>{{__('inventory::inventory.created_at')}}</th>
                                            <th>{{__('inventory::inventory.last_updated_at')}}</th>
                                            <th>{{__('inventory::inventory.last_updated_by')}}</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                                <!--end: Datatable -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>