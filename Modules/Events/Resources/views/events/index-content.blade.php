@section('title', trans('events::event.events'))

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
                            <span data-8xloadtitle>{{trans('events::event.events')}}</span>
                            <small>{{trans('events::event.list')}}</small>
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">

                            @if (auth()->user()->hasPermission('create-event'))
                            <a href="{{route('events.create')}}" class="btn btn-primary btn-sm" data-path="{{route('events.modals.create')}}" data-title="{{trans('events::event.create_event')}}" data-modal-load>
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>{{trans('events::event.create_event')}}</span>
                                </span>
                            </a>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <!--begin: Datatable -->
                    <table class="table table-striped- table-bordered table-hover table-checkable datatable" id="events_table">
                        <thead>
                            <tr>
                                <th>{{__('events::event.id')}}</th>
                                <th>{{__('events::event.event')}}</th>
                                <th>{{__('events::event.created_at')}}</th>
                                <th>{{__('events::event.last_updated_at')}}</th>
                                <th>{{__('events::event.actions')}}</th>
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