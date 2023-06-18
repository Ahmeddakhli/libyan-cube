<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title" data-8xloadtitle>{{__('settings::settings.create_top_agent')}}</h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="{{route('home')}}" class="kt-subheader__breadcrumbs-home"><i class="fa fa-home"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                @if (auth()->user()->hasPermission('index-settings-teems'))
                <a href="{{route('settings.top_agents.index')}}" data-8xload class="kt-subheader__breadcrumbs-link">{{__('settings::settings.top_agents')}}</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                @else
                <a href="#" class="kt-subheader__breadcrumbs-link">{{__('settings::settings.top_agents')}}</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                @endif
                <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">{{__('settings::settings.create_top_agent')}}</span>
            </div>
        </div>
    </div>
    <!-- end:: Subheader -->
    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Portlet-->
                <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">{{__('settings::settings.create_top_agent')}}</h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <a href="{{url()->previous()}}" data-8xload class="btn btn-clean kt-margin-r-10">
                                <i class="la la-arrow-left"></i>
                                <span class="kt-hidden-mobile">{{__('main.back')}}</span>
                            </a>
                        </div>
                    </div>
                    <form action="{{route('settings.top_agents.store')}}" data-async data-set-autofocus method="POST" id="create_top_agent_form" class="kt-form" enctype="multipart/form-data" data-parsley-validate>
                        @csrf
                        <div class="row">
                            <div class="col-xl-2"></div>
                            <div class="col-xl-10">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="form-group">
                                            <h3 class="kt-section__title kt-section__title-lg kt-margin-b-0">{{__('settings::settings.top_agents')}}:</h3>
                                        </div>
                                        <div class="m-portlet__body">
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <input type="text" id="users_ids" name="users_ids" required data-parsley-required data-parsley-required-message="{{__('settings::settings.agents_are_required')}}" data-parsley-trigger="change focusout" class="form-control" data-role="tagsinput" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-portlet__foot">
                                        <div class="kt-form__actions">
                                            <div class="kt-section kt-section--last">
                                                <div class="kt-section__body">
                                                    <div class="form-group row">
                                                        <div class="col-12">
                                                            <div class="btn-group">
                                                                <button type="submit" class="btn btn-brand">
                                                                    <i class="la la-check"></i>
                                                                    <span class="kt-hidden-mobile">Save</span>
                                                                </button>
                                                                <button type="button" class="btn btn-brand dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <ul class="kt-nav">
                                                                        <li class="kt-nav__item">
                                                                            <a href="#" class="kt-nav__link">
                                                                                <i class="kt-nav__link-icon flaticon2-reload"></i>
                                                                                <span class="kt-nav__link-text">Save & continue</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="kt-nav__item">
                                                                            <a href="#" class="kt-nav__link">
                                                                                <i class="kt-nav__link-icon flaticon2-power"></i>
                                                                                <span class="kt-nav__link-text">Save & exit</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="kt-nav__item">
                                                                            <a href="#" class="kt-nav__link">
                                                                                <i class="kt-nav__link-icon flaticon2-edit-interface-symbol-of-pencil-tool"></i>
                                                                                <span class="kt-nav__link-text">Save & edit</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="kt-nav__item">
                                                                            <a href="#" class="kt-nav__link">
                                                                                <i class="kt-nav__link-icon flaticon2-add-1"></i>
                                                                                <span class="kt-nav__link-text">Save & add new</span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end:: Content -->
</div>