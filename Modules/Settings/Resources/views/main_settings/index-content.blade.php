@section('title', trans('settings::settings.settings'))

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
                            <span data-8xloadtitle>{{trans('settings::settings.settings')}}</span>
                            <small>{{trans('settings::settings.list')}}</small>
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">

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
                    <form action="{{route('settings.settings.update')}}" method="POST" id="update_setting_form" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="updateContactCallback" data-parsley-validate enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{$setting->id}}" />
                        <div class="m-portlet__body">
                            <div class="form-group row col-12">
                                <!-- <div class="col-6 mt-5">
                                    <label for="aside_title_en">{{__('settings::settings.aside_title_en')}}</label>
                                    <input name="aside_title_en" id="aside_title_en" type="text" class="form-control" value="{{$setting->aside_title_en}}" placeholder="{{__('settings::settings.aside_title_en')}}"  data-parsley-trigger="change focusout">
                                </div>
                                <div class="col-6 mt-5">
                                    <label for="aside_title_ar">{{__('settings::settings.aside_title_ar')}}</label>
                                    <input name="aside_title_ar" id="aside_title_ar" type="text" class="form-control" value="{{$setting->aside_title_ar}}" placeholder="{{__('settings::settings.aside_title_ar')}}"  data-parsley-trigger="change focusout">
                                </div> -->

                                <div class="col-sm-12 col-md-12 col-lg-6 mt-5">
                                    <label class="h6" for="pixel_code">{{__('settings::settings.pixel_code')}}</label>
                                    <textarea rows="6" name="pixel_code" id="pixel_code" type="text" class="form-control" placeholder="{{__('settings::settings.pixel_code')}}" data-parsley-trigger="change focusout">{{$setting->pixel_code}}</textarea>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-6 mt-5">
                                    <label class="h6" for="tags_manager">{{__('settings::settings.tags_manager')}}</label>
                                    <textarea rows="6" name="tags_manager" id="tags_manager" type="text" class="form-control" placeholder="{{__('settings::settings.tags_manager')}}" data-parsley-trigger="change focusout">{{$setting->tags_manager}}</textarea>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 mt-5">
                                    <label class="h6" for="body_tag_manager">{{__('settings::settings.body_tag_manager')}}</label>
                                    <textarea rows="6" name="body_tag_manager" id="body_tag_manager" type="text" class="form-control" placeholder="{{__('settings::settings.body_tag_manager')}}" data-parsley-trigger="change focusout">{{$setting->body_tag_manager}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-6 mt-5">
                                    <label class="h6" for="thank_you_message_en">{{__('settings::settings.thank_you_message_en')}}</label>
                                    <textarea rows="6" name="thank_you_message_en" id="thank_you_message_en" type="text" class="form-control" placeholder="{{__('settings::settings.thank_you_message_en')}}" data-parsley-trigger="change focusout">{{$setting->thank_you_message_en}}</textarea>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 mt-5">
                                    <label class="h6" for="thank_you_message_ar">{{__('settings::settings.thank_you_message_ar')}}</label>
                                    <textarea rows="6" name="thank_you_message_ar" id="thank_you_message_ar" type="text" class="form-control" placeholder="{{__('settings::settings.thank_you_message_ar')}}" data-parsley-trigger="change focusout">{{$setting->thank_you_message_ar}}</textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-6 mt-5">
                                    <label class="h6" for="auto_reply_message_en">{{__('settings::settings.auto_reply_message_en')}}</label>
                                    <textarea rows="6" name="auto_reply_message_en" id="auto_reply_message_en" type="text" class="form-control" placeholder="{{__('settings::settings.auto_reply_message_en')}}" data-parsley-trigger="change focusout">{{$setting->auto_reply_message_en}}</textarea>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 mt-5">
                                    <label class="h6" for="auto_reply_message_ar">{{__('settings::settings.auto_reply_message_ar')}}</label>
                                    <textarea rows="6" name="auto_reply_message_ar" id="auto_reply_message_ar" type="text" class="form-control" placeholder="{{__('settings::settings.auto_reply_message_ar')}}" data-parsley-trigger="change focusout">{{$setting->auto_reply_message_ar}}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12 col-md-12 col-lg-6 mt-5">
                                    <label class="h6" for="about_us_en">{{__('settings::settings.about_us_en')}}</label>
                                    <textarea rows="6" name="about_en" id="about_us_en" type="text" class="form-control" placeholder="{{__('settings::settings.about_us_en')}}" data-parsley-trigger="change focusout">{{$setting->about_en}}</textarea>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 mt-5">
                                    <label class="h6" for="about_us_ar">{{__('settings::settings.about_us_ar')}}</label>
                                    <textarea rows="6" name="about_ar" id="about_us_ar" type="text" class="form-control" placeholder="{{__('settings::settings.about_us_ar')}}" data-parsley-trigger="change focusout">{{$setting->about_ar}}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12 col-md-12 col-lg-6 mt-5">
                                    <label class="h6" for="slogan_en">{{__('settings::settings.slogan_en')}}</label>
                                    <input name="slogan_en" id="slogan_en" type="text" class="form-control" value="{{$setting->slogan_en}}" placeholder="{{__('settings::settings.slogan_en')}}"  data-parsley-trigger="change focusout">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 mt-5">
                                    <label class="h6" for="slogan_ar">{{__('settings::settings.slogan_ar')}}</label>
                                    <input name="slogan_ar" id="slogan_ar" type="text" class="form-control" value="{{$setting->slogan_ar}}" placeholder="{{__('settings::settings.slogan_ar')}}"  data-parsley-trigger="change focusout">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12 col-md-12 col-lg-2">
                                    <label for="enable_ar">{{__('settings::settings.enable_ar')}}</label>
                                    <input name="enable_ar" id="enable_ar" type="checkbox" @if($setting->enable_ar) checked @endif class="form-control">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-3">
                                    <label for="active_whatsapp_icon">{{__('settings::settings.active_whatsapp_icon')}}</label>
                                    <input name="active_whatsapp_icon" id="active_whatsapp_icon" type="checkbox" @if($setting->active_whatsapp_icon) checked @endif class="form-control">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-3">
                                    <label for="active_messanger_icon">{{__('settings::settings.active_messanger_icon')}}</label>
                                    <input name="active_messanger_icon" id="active_messanger_icon" type="checkbox" @if($setting->active_messanger_icon) checked @endif class="form-control">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-3">
                                    <label for="active_phone_icon">{{__('settings::settings.active_phone_icon')}}</label>
                                    <input name="active_phone_icon" id="active_phone_icon" type="checkbox" @if($setting->active_phone_icon) checked @endif class="form-control">
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions--solid">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <button type="submit" class="btn btn-success btn-brand">{{trans('main.submit')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </form>
                    <!--end: Datatable -->
                </div>
            </div>
        </div>
        <!-- end:: Content -->
    </div>
    <!-- end:: Content -->
</div>