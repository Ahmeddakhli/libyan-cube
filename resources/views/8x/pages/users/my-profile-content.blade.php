<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="leadProfile-{{$user->id}}">
    <!-- begin:: Subheader -->
    <div class="kt-subheader kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <div class="kt-subheader__breadcrumbs">
                <a href="{{route('home')}}" data-8xload class="kt-subheader__breadcrumbs-home"><i class="fa fa-home"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">{{__('users.my_profile')}}</span>
            </div>
        </div>
        <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">

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
                            <h3 class="animated fadeIn"><i class="fa fa-id-badge"></i> <span data-8xloadtitle>{{__('users.my_profile')}}</span></h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <ul class="nav nav-pills" role="tablist">
                                <li class="nav-item ">
                                    <a class="nav-link active" data-toggle="tab" href="#about_me"><i class="fa fa-info-circle"></i>{{__('users.about_me')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#change_password"><i class="fa fa-unlock-alt"></i>{{__('users.change_password')}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="kt-portlet__body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="about_me" role="tabpanel">
                                <!-- Edit My Profile Basic Info -->
                                <form action="{{route('users.update')}}" data-async data-set-autofocus method="POST" id="create_lead_form" class="kt-form" data-parsley-validate>
                                    @csrf
                                    <input type="hidden" id="id" name="id" value="{{$user->id}}"/>
                                    <div class="row">
                                        <div class="col-xl-2"></div>
                                        <div class="col-xl-8">
                                            <div class="kt-section kt-section--first">
                                                <div class="kt-section__body">
                                                    <div class="form-group row">

                                                        <div class="col-3">
                                                            <label>{{__('users.full_name')}}</label>
                                                            <input name="full_name" value="{{$user->full_name}}" id="full_name" type="text" class="form-control m-input" placeholder="{{trans('users.enter_full_name')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{trans('users.full_name_max_is_150_characters_long')}}">
                                                        </div>

                                                        <div class="col-3">
                                                            <label>{{trans('users.mobile_number')}}</label>
                                                            <input name="mobile_number" value="{{$user->mobile_number}}" id="mobile_number" type="text" class="form-control m-input" placeholder="{{trans('users.enter_mobile_number')}}" required data-parsley-required data-parsley-required-message="{{trans('users.mobile_number_is_required')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{trans('users.mobile_number_max_is_150_characters_long')}}" data-parsley-pattern="/((?:\+|00)[17](?: |\-)?|(?:\+|00)[1-9]\d{0,2}(?: |\-)?|(?:\+|00)1\-\d{3}(?: |\-)?)?(0\d|\([0-9]{3}\)|[1-9]{0,3})(?:((?: |\-)[0-9]{2}){4}|((?:[0-9]{2}){4})|((?: |\-)[0-9]{3}(?: |\-)[0-9]{4})|([0-9]{7}))/" data-parsley-pattern="{{trans('users.mobile_number_is_invalid')}}">
                                                        </div>

                                                        <div class="col-3">
                                                            <label>{{trans('users.email')}}</label>
                                                            <input name="email" value="{{$user->email}}" id="email" type="text" class="form-control m-input" placeholder="{{trans('users.enter_email')}}" required data-parsley-required data-parsley-required-message="{{trans('users.email_is_required')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{trans('users.email_max_is_150_characters_long')}}" data-parsley-type="email" data-parsley-type-message="{{trans('users.email_is_invalid')}}">
                                                        </div>

                                                        <div class="col-3">
                                                            <label>{{trans('users.username')}}</label>
                                                            <input name="username" value="{{$user->username}}" id="username" type="text" class="form-control m-input" placeholder="{{trans('users.enter_username')}}" required data-parsley-required data-parsley-required-message="{{trans('users.username_is_required')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{trans('users.username_max_is_150_characters_long')}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-3">
                                                            <label>{{trans('users.job_title')}}</label>
                                                            <input name="job_title" value="{{$user->job_title}}" id="job_title" type="text" class="form-control m-input" placeholder="{{trans('users.enter_job_title')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{trans('users.job_title_max_is_150_characters_long')}}">
                                                        </div>

                                                        <div class="col-md-3">
                                                            <label for="timezone">{{trans('users.select_timezone')}}</label>
                                                            <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="timezone" name="timezone" required data-parsley-required data-parsley-required-message="{{trans('users.timezone_is_required')}}" data-parsley-trigger="change focusout">
                                                                <option value="" selected disabled>{{trans('users.select_timezone')}}</option>
                                                                @foreach ($timezones as $timezone)
                                                                    <option value="{{$timezone}}" @if ($timezone == $user->timezone) selected @endif>{{$timezone}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        {{--
                                                        <div class="col-3">
                                                            <label>{{trans('users.age')}}</label>
                                                            <input name="age" value="{{$user->age}}" type="text" class="form-control" placeholder="{{trans('users.age')}}" data-parsley-required="false" id="age" data-parsley-trigger="change focusout" data-parsley-type="integer" data-parsley-range="[1, 999]">
                                                        </div>
                                                        --}}

                                                        <div class="col-3">
                                                            <label>{{__('users.gender')}}</label>
                                                            <div class="kt-radio-inline">
                                                                <label class="kt-radio">
                                                                <input type="radio" value="1" name="gender" @if($user->gender == 1) checked @endif required data-parsley-required="true" data-parsley-required-message="{{trans('users.gender_is_required')}}" style="height:20px;width:25px;" tabindex="1997"> ذكر
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-radio">
                                                                <input type="radio" value="2" name="gender" @if($user->gender == 2) checked @endif required data-parsley-required="true" data-parsley-required-message="{{trans('users.gender_is_required')}}"" style="height:20px;width:25px;" tabindex="1997"> أنثى
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-3">
                                                            <label>{{trans('users.avatar')}}</label>
                                                            <input name="image" type="file" id="image" data-parsley-trigger="change focusout" data-parsley-filemaxmegabytes="2" data-parsley-filemimetypes="image/jpg, image/jpeg, image/png">
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="kt-portlet__foot">
                                                    <div class="kt-form__actions">
                                                        <div class="kt-section kt-section--last">
                                                            <div class="kt-section__body">
                                                                <div class="form-group row1">
                                                                    <div class="col-12">
                                                                        <button type="submit" class="btn btn-brand">{{__('users.update')}}</button>
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
                                <!-- Edit My Profile Basic Info -->
                            </div>
                            <div class="tab-pane" id="change_password" role="tabpanel">
                                <!-- Edit My Password -->
                                <form action="{{route('users.updatePassword')}}" data-async data-set-autofocus method="POST" id="create_lead_form" class="kt-form" data-parsley-validate>
                                    @csrf
                                    <input type="hidden" id="id" name="id" value="{{$user->id}}"/>
                                    <div class="row">
                                        <div class="col-xl-2"></div>
                                        <div class="col-xl-8">
                                            <div class="kt-section kt-section--first">
                                                <div class="kt-section__body">
                                                    <div class="form-group row">

                                                        <div class="col-4">
                                                            <label>{{__('users.old_password')}}</label>
                                                            <input name="old_password" id="old_password" type="password" class="form-control m-input" placeholder="{{trans('users.enter_password')}}" required data-parsley-required data-parsley-required-message="{{trans('users.password_is_required')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{trans('users.password_max_is_150_characters_long')}}" data-parsley-minlength="6" data-parsley-minlength-message="{{trans('users.password_min_is_6_characters_long')}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-4">
                                                            <label>{{trans('users.new_password')}}</label>
                                                            <input name="password" id="password" type="password" class="form-control m-input" placeholder="{{trans('users.enter_password')}}" required data-parsley-required data-parsley-required-message="{{trans('users.password_is_required')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{trans('users.password_max_is_150_characters_long')}}" data-parsley-minlength="6" data-parsley-minlength-message="{{trans('users.password_min_is_6_characters_long')}}">
                                                        </div>

                                                        <div class="col-4">
                                                            <label>{{trans('users.confirm_new_password')}}</label>
                                                            <input name="password_confirmation" id="password_confirmation" type="password" class="form-control m-input" placeholder="{{trans('users.enter_password_confirmation')}}" required data-parsley-required data-parsley-required-message="{{trans('users.password_confirmation_is_required')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{trans('users.password_confirmation_max_is_150_characters_long')}}" data-parsley-minlength="6" data-parsley-minlength-message="{{trans('users.password_confirmation_min_is_6_characters_long')}}">
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="kt-portlet__foot">
                                                    <div class="kt-form__actions">
                                                        <div class="kt-section kt-section--last">
                                                            <div class="kt-section__body">
                                                                <div class="form-group row1">
                                                                    <div class="col-12">
                                                                        <button type="submit" class="btn btn-brand">{{__('users.update_password')}}</button>
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
                                <!-- Edit My Password -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end:: Content -->

</div>