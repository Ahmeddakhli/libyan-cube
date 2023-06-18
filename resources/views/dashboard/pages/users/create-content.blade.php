<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title" data-8xloadtitle>{{trans('users.create_user')}}</h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="{{route('home')}}" class="kt-subheader__breadcrumbs-home"><i class="fa fa-home"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>

                <a href="{{route('users.index')}}" data-8xload class="kt-subheader__breadcrumbs-link">{{trans('users.users')}}</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>

                <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">{{trans('users.create_user')}}</span>
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
                            <h3 class="kt-portlet__head-title">{{trans('users.create_user')}}</h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <a href="{{url()->previous()}}" data-8xload class="btn btn-clean kt-margin-r-10">
                                <i class="la la-arrow-left"></i>
                                <span class="kt-hidden-mobile">{{__('main.back')}}</span>
                            </a>
                        </div>
                    </div>


                    <div class="kt-portlet__body">
                        <!-- Create LCC Form -->
                        <form action="{{route('users.store')}}" data-async data-reset="true" data-set-autofocus method="POST" id="create_user_form" class="kt-form" data-parsley-validate>
                            @csrf
                            <input type="hidden" name="remember_me" value="0"/>
                            <div class="row">
                                <div class="col-xl-2"></div>
                                <div class="col-xl-8">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            <div class="form-group">
                                                <h3 class="kt-section__title kt-section__title-lg kt-margin-b-0">{{trans('users.user_info')}}:</h3>
                                            </div>
                                            <div class="form-group row">
                                                <!-- User Info -->
                                                <div class="col-4">
                                                    <label for="username">{{trans('users.username')}}</label>
                                                    <input name="username" id="username" type="text" class="form-control m-input" placeholder="{{trans('users.enter_username')}}" required data-parsley-required data-parsley-required-message="{{trans('users.username_is_required')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{trans('users.username_max_is_150_characters_long')}}">
                                                    <span class="m-form__help">{{trans('users.please_enter_the_username')}}</span>
                                                </div>
                                                <div class="col-4">
                                                    <label for="email">{{trans('users.email')}}</label>
                                                    <input name="email" id="email" type="text" class="form-control m-input" placeholder="{{trans('users.enter_email')}}" required data-parsley-required data-parsley-required-message="{{trans('users.email_is_required')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{trans('users.email_max_is_150_characters_long')}}" data-parsley-type="email" data-parsley-type-message="{{trans('users.email_is_invalid')}}">
                                                    <span class="m-form__help">{{trans('users.please_enter_the_email')}}</span>
                                                </div>
                                                <div class="col-4">
                                                    <label for="mobile_number">{{trans('users.mobile_number')}}</label>
                                                    <input name="mobile_number" id="mobile_number" type="text" class="form-control m-input" placeholder="{{trans('users.enter_mobile_number')}}" required data-parsley-required data-parsley-required-message="{{trans('users.mobile_number_is_required')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{trans('users.mobile_number_max_is_150_characters_long')}}" data-parsley-pattern="/((?:\+|00)[17](?: |\-)?|(?:\+|00)[1-9]\d{0,2}(?: |\-)?|(?:\+|00)1\-\d{3}(?: |\-)?)?(0\d|\([0-9]{3}\)|[1-9]{0,3})(?:((?: |\-)[0-9]{2}){4}|((?:[0-9]{2}){4})|((?: |\-)[0-9]{3}(?: |\-)[0-9]{4})|([0-9]{7}))/" data-parsley-pattern="{{trans('users.mobile_number_is_invalid')}}">
                                                    <span class="m-form__help">{{trans('users.please_enter_the_mobile_number')}}</span>
                                                </div>
                                                <!-- User Info -->
                                            </div>

                                            <!-- Group && Password -->
                                            <div class="form-group row">
                                                <div class="col-4">
                                                    <label for="group_id">{{trans('users.select_group')}}</label>
                                                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="group_id" name="group_id" required data-parsley-required data-parsley-required-message="{{trans('users.group_id_required')}}" data-parsley-trigger="change focusout">
                                                        <option value="" selected disabled>{{trans('users.select_group')}}</option>
                                                        @foreach ($groups as $group)
                                                            <option value="{{$group->id}}">{{$group->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-4">
                                                    <label for="password">{{trans('users.password')}}</label>
                                                    <input name="password" id="password" type="password" class="form-control m-input" placeholder="{{trans('users.enter_password')}}" required data-parsley-required data-parsley-required-message="{{trans('users.password_is_required')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{trans('users.password_max_is_150_characters_long')}}" data-parsley-minlength="6" data-parsley-minlength-message="{{trans('users.password_min_is_6_characters_long')}}">
                                                    <span class="m-form__help">{{trans('users.please_enter_the_password')}}</span>
                                                </div>
                                                <div class="col-4">
                                                    <label for="password_confirmation">{{trans('users.password_confirmation')}}</label>
                                                    <input name="password_confirmation" id="password_confirmation" type="password" class="form-control m-input" placeholder="{{trans('users.enter_password_confirmation')}}" required data-parsley-required data-parsley-required-message="{{trans('users.password_confirmation_is_required')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{trans('users.password_confirmation_max_is_150_characters_long')}}" data-parsley-minlength="6" data-parsley-minlength-message="{{trans('users.password_confirmation_min_is_6_characters_long')}}">
                                                    <span class="m-form__help">{{trans('users.please_enter_the_password_confirmation')}}</span>
                                                </div>
                                            </div>
                                            <!-- Group && Password -->

                                            <!-- More Details -->
                                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
                                            <div class="form-group">
                                                <h3 class="kt-section__title kt-section__title-lg kt-margin-b-0">{{trans('users.more_details')}}:</h3>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <div class="col-3">
                                                    <label for="full_name">{{trans('users.full_name')}}</label>
                                                    <input name="full_name" id="full_name" type="text" class="form-control m-input" placeholder="{{trans('users.enter_full_name')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{trans('users.full_name_max_is_150_characters_long')}}">
                                                    <span class="m-form__help">{{trans('users.please_enter_the_full_name')}}</span>
                                                </div>
                                               
                                            <!-- More Details -->

                                            <div class="form-group m-form__group row">
                                                <label class="col-lg-4 col-form-label" for="bio">{{trans('users.bio')}}</label>
                                                <div class="col-lg-8">
                                                    <textarea name="bio" id="bio" type="text" class="form-control m-input" placeholder="{{trans('users.enter_bio')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295" data-parsley-maxlength-message="{{trans('users.bio_max_is_4294967295_characters_long')}}"></textarea>
                                                    <span class="m-form__help">{{trans('users.please_enter_the_bio')}}</span>
                                                </div>
                                            </div>

                                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
                                            <div class="form-group">
                                                <h3 class="kt-section__title kt-section__title-lg kt-margin-b-0">{{trans('users.profile_image')}}:</h3>
                                            </div>

                                            <!-- Profile Image -->
                                            <div class="form-group row">
                                                <div class="col-4">
                                                    <label for="image">{{trans('users.image')}}</label>
                                                    <input type="file" id="image" data-parsley-trigger="change focusout" data-parsley-filemaxmegabytes="2" data-parsley-filemimetypes="image/jpg, image/jpeg, image/png" name="image">
                                                </div>
                                            </div>
                                            <!-- Profile Image -->
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