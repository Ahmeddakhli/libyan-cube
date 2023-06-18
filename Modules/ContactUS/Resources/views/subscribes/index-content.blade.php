@section('title', trans('contactus::contact_us.contact'))

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
                            <span data-8xloadtitle>{{trans('contactus::contact_us.subscribes')}}</span>
                            <small>{{trans('contactus::contact_us.list')}}</small>
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            {{--
                            <!-- Full creation form -->
                            <a href="{{route('contact_us.contact_us.create')}}" data-8xload class="btn btn-brand btn-icon-sm">
                            <i class="flaticon2-plus"></i> {{trans('contactus::contact_us.create_new')}}
                            </a>
                            --}}
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">

                    <!--begin: Datatable -->
                    <table class="table table-striped- table-bordered table-hover table-checkable datatable" id="subscribes_table">
                        <thead>
                            <tr>
                                <th>{{__('contactus::contact_us.id')}}</th>
                                <th>{{__('contactus::contact_us.email')}}</th>
                                <th>{{__('contactus::contact_us.created_at')}}</th>
                                <th>{{__('contactus::contact_us.actions')}}</th>
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