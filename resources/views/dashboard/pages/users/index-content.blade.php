@section('title', trans('users.users'))
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
                            <i class="kt-font-brand fa fa-filter"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            <span data-8xloadtitle>{{trans('users.users')}}</span>
                            <small>{{trans('users.list')}}</small>
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            @haspermission('create-user')
                                <a href="{{route('users.create')}}" class="btn btn-brand btn-sm" data-toggle="modal" data-target="#fast_modal" data-path="{{route('users.modals.create')}}" data-title="{{trans('users.create_user_form')}}" data-modal-load>
                                    <span>
                                        <i class="flaticon2-plus"></i>
                                        <span>{{trans('users.create_user')}}</span>
                                    </span>
                                </a>
                            @endhaspermission
                            {{--
                            &nbsp;
                            <div class="dropdown dropdown-inline">
                                <button type="button" class="btn btn-brand btn-icon-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="flaticon2-list"></i> Options
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="kt-nav">
                                        <li class="kt-nav__section kt-nav__section--first">
                                            <span class="kt-nav__section-text">Choose an action:</span>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-open-text-book"></i>
                                                <span class="kt-nav__link-text">Reservations</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-calendar-4"></i>
                                                <span class="kt-nav__link-text">Appointments</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-bell-alarm-symbol"></i>
                                                <span class="kt-nav__link-text">Reminders</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-contract"></i>
                                                <span class="kt-nav__link-text">Announcements</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-shopping-cart-1"></i>
                                                <span class="kt-nav__link-text">Orders</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__separator kt-nav__separator--fit">
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-rocket-1"></i>
                                                <span class="kt-nav__link-text">Projects</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-chat-1"></i>
                                                <span class="kt-nav__link-text">User Feedbacks</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            --}}
                        </div>
                    </div>
                </div>

                <div class="kt-portlet__body">


                    <!--begin: Datatable -->
                    <table class="table table-striped- table-bordered table-hover table-checkable datatable" id="index_users_table">
                        <thead>
                            <tr>
                                <th>{{trans('users.user_id')}}</th>
                                <th>{{trans('users.image')}}</th>
                                <th>{{trans('users.full_name')}}</th>
                                {{-- <th>{{trans('users.username')}}</th> --}}
                                <th>{{trans('users.email')}}</th>
                                <th>{{trans('users.mobile_number')}}</th>
                                <!-- <th>{{trans('users.job_title')}}</th> -->
                                <th>{{trans('users.group_name')}}</th>
                                {{-- <th>{{trans('users.last_assignment_date')}}</th> --}}
                                {{-- <th>{{trans('users.connection_status')}}</th> --}}
                                <th>{{trans('users.suspension_status')}}</th>
                                {{-- <th>{{trans('users.age')}}</th> --}}
                                {{-- <th>{{trans('users.gender')}}</th> --}}
                                {{-- <th>{{trans('users.last_login_at')}}</th> --}}
                                {{-- <th>{{trans('users.last_login_ip')}}</th> --}}
                                {{-- <th>{{trans('users.created_at')}}</th> --}}
                                {{-- <th>{{trans('users.updated_at')}}</th> --}}
                                <th>{{trans('datatables.actions')}}</th>
                            </tr>
                        </thead>
                    </table>
                    <!--end: Datatable -->

                    {{--
                    <!--begin::Modal-->
                    <div class="modal fade" id="kt_modal_fetch_id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="kt-scrollable" data-scrollbar-shown="true" data-scrollable="true" data-height="200">
                                        <ul class="kt-datatable_selected_ids"></ul>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--end::Modal-->

                    <!--begin::Modal-->
                    <div class="modal fade" id="kt_modal_fetch_id_server" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="kt-scrollable" data-scrollbar-shown="true" data-scrollable="true" data-height="200">
                                        <ul class="kt-datatable_selected_ids"></ul>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--end::Modal-->
                    --}}
                </div>
            </div>
        </div>

        <!-- end:: Content -->
    </div>
    <!-- end:: Content -->
</div>