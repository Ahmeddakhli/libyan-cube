@section('title', trans('blog::blog.blogs'))

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
                            <span data-8xloadtitle>{{trans('blog::blog.blogs')}}</span>
                            <small>{{trans('blog::blog.list')}}</small>
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            {{--
                            <!-- Full creation form -->
                            <a href="{{route('blogs.create')}}" data-8xload class="btn btn-brand btn-icon-sm">
                                <i class="flaticon2-plus"></i> {{trans('blog::blog.create_new')}}
                            </a>
                            --}}
                            @if (auth()->user()->hasPermission('create-blog'))
                                <a href="{{route('blogs.create')}}" class="btn btn-primary btn-sm"  data-path="{{route('blogs.modals.create')}}" data-title="{{trans('blog::blog.create_blog')}}" data-modal-load>
                                    <span>
                                        <i class="la la-plus"></i>
                                        <span>{{trans('blog::blog.create_blog')}}</span>
                                    </span>
                                </a>
                            @endif
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
                    <table class="table table-striped- table-bordered table-hover table-checkable datatable" id="blogs_table">
                        <thead>
                            <tr>
                                <th>{{__('blog::blog.id')}}</th>
                                <th>{{__('blog::blog.blog')}}</th>
                                <th>{{__('blog::blog.created_at')}}</th>
                                <th>{{__('blog::blog.last_updated_at')}}</th>
                                <th>{{__('blog::blog.actions')}}</th>
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