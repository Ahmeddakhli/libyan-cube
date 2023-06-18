<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title" data-8xloadtitle>{{trans('groups.create_group')}}</h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="{{route('home')}}" class="kt-subheader__breadcrumbs-home"><i class="fa fa-home"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>

                <a href="{{route('groups.index')}}" data-8xload class="kt-subheader__breadcrumbs-link">{{trans('groups.groups')}}</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>

                <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">{{trans('groups.create_group')}}</span>
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
                            <h3 class="kt-portlet__head-title">{{trans('groups.create_group')}}</h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <a href="{{url()->previous()}}" data-8xload class="btn btn-clean kt-margin-r-10">
                                <i class="la la-arrow-left"></i>
                                <span class="kt-hidden-mobile">{{__('main.back')}}</span>
                            </a>
                        </div>
                    </div>


                    <div class="kt-portlet__body">
                        <!-- Create Group Form -->
                        <form action="{{route('groups.store')}}" data-async data-set-autofocus method="POST" id="create_group_form" class="kt-form" data-parsley-validate>
                            @csrf
                            <div class="row">
                                <div class="col-xl-2"></div>
                                <div class="col-xl-8">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            <div class="form-group">
                                                <h3 class="kt-section__title kt-section__title-lg kt-margin-b-0">{{trans('groups.group_info')}}:</h3>
                                            </div>
                                            <div class="form-group row">
                                                <!-- Group Info -->
                                                <div class="col-3">
                                                    <label for="name">{{trans('groups.group_name')}}</label>
                                                    <input name="name" id="name" type="text" class="form-control" placeholder="{{trans('groups.enter_group_name')}}" required data-parsley-required data-parsley-required-message="{{trans('groups.group_name_is_required')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('groups.group_name_max_is_90_characters_long')}}">
                                                    <span class="m-form__help">{{trans('groups.please_enter_the_group_name')}}</span>
                                                </div>
                                                <div class="col-3">
                                                    <label for="parent_id">{{trans('groups.select_parent_group')}}</label>
                                                    <select class="form-control selectpicker" data-live-search="true" id="parent_id" name="parent_id" required data-parsley-required data-parsley-required-message="{{trans('groups.parent_group_is_required')}}" data-parsley-trigger="change focusout">
                                                        <option value="" selected disabled>{{trans('groups.select_parent_group')}}</option>
                                                        @foreach ($groups as $group)
                                                            <option value="{{$group->id}}">{{$group->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <label for="permissions_group_id">{{trans('groups.select_permissions_group_if_any')}}</label>
                                                    <select class="form-control selectpicker" data-live-search="true" id="permissions_group_id" name="permissions_group_id" data-parsley-trigger="change focusout">
                                                        <option value="" selected disabled>{{trans('groups.select_permissions_group_if_any')}}</option>
                                                        @foreach ($groups as $group)
                                                            <option value="{{$group->id}}">{{$group->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <label for="users">{{trans('groups.select_deselect_users')}}</label>
                                                    <select class="form-control m-select2" id="users" name="users[]"  data-parsley-trigger="change focusout" multiple="multiple">
                                                        @foreach ($users as $user)
                                                            <option value="{{$user->id}}">{{$user->email}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!-- Group Info -->
                                            </div>

                                            <!-- Description -->
                                            <div class="form-group">
                                                <label for="description">{{trans('groups.description')}}</label>
                                                
                                                    <input name="description" id="description" type="text" class="form-control" placeholder="{{trans('groups.enter_description')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{trans('groups.group_description_max_is_150_characters_long')}}">
                                                    <span class="m-form__help">{{trans('groups.please_enter_the_description')}}</span>
                                                
                                            </div>
                                            <!-- Description -->

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
    </div>
    <!-- end:: Content -->

</div>