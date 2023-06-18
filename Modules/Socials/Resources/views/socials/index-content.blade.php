@section('title', trans('socials::social.socials'))

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
                            <span data-8xloadtitle>{{trans('socials::social.socials')}}</span>
                            <small>{{trans('socials::social.list')}}</small>
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                    
                            @if (auth()->user()->hasPermission('create-social'))
                            <a href="{{route('socials.create')}}" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#fast_modal" data-path="{{route('socials.modals.create')}}" data-title="{{trans('socials::social.create_social')}}" data-modal-load>
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>{{trans('socials::social.create_social')}}</span>
                                </span>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">


                    <!--begin: Datatable -->
                    <table class="table table-striped- table-bordered table-hover table-checkable datatable" id="socials_table">
                        <thead>
                            <tr>
                                <th>{{__('socials::social.id')}}</th>
                                <th>{{__('socials::social.social')}}</th>
                                <th>{{__('socials::social.link')}}</th>
                                <th>{{__('socials::social.icon')}}</th>
                                <th>{{__('socials::social.created_at')}}</th>
                                <th>{{__('socials::social.last_updated_at')}}</th>
                                <th>{{__('socials::social.actions')}}</th>
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