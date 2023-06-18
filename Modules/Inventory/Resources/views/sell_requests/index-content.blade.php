@section('title', trans('inventory::inventory.sell_requests'))

@include('dashboard.components.fast_modal')
@include('dashboard.styles.custom')

<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

    <!-- begin:: Content -->
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <!-- begin:: Content -->
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand fa fa-list"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            <span data-8xloadtitle>{{trans('inventory::inventory.sell_requests')}}</span>
                            <small>{{trans('inventory::inventory.list')}}</small>
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            {{--
                            <!-- Full creation form -->
                            <a href="{{route('inventory.sell_requests.create')}}" data-8xload class="btn btn-brand btn-icon-sm">
                                <i class="flaticon2-plus"></i> {{trans('inventory::inventory.create_new')}}
                            </a>
                            --}}
                            {{--
                            @haspermission('create-inventory-sell-request')
                                <a href="{{route('inventory.sell_requests.create')}}" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#fast_modal" data-path="{{route('inventory.sell_requests.modals.create')}}" data-title="{{trans('inventory::inventory.create_sell_request')}}" data-modal-load>
                                    <span>
                                        <i class="la la-plus"></i>
                                        <span>{{trans('inventory::inventory.create_sell_request')}}</span>
                                    </span>
                                </a>
                            @endhaspermission
                            --}}
                           
                        </div>
                    </div>
                </div>

                <div class="kt-portlet__body">


                    <!--begin: Datatable -->
                    <table class="table table-striped- table-bordered table-hover table-checkable datatable" id="sell_requests_table">
                        <thead>
                            <tr>
                                <th>{{__('inventory::inventory.id')}}</th>
                                <th>{{__('inventory::inventory.compound')}}</th>
                                <th>{{__('inventory::inventory.unit_name')}}</th>
                                <th>{{__('inventory::inventory.is_seen')}}</th>
                                <th>{{__('inventory::inventory.created_at')}}</th>
                                <th>{{__('inventory::inventory.last_updated_at')}}</th>
                                <th>{{__('inventory::inventory.actions')}}</th>
                            </tr>
                        </thead>
                    </table>
                    <!--end: Datatable -->
                </div>
            </div>
        </div>

        <!-- end:: Content -->
    </div>
    <!-- end:: Content -->
</div>