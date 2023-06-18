<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title" data-8xloadtitle>{{__('contactus::contact_us.create_contact')}}</h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="{{route('home')}}" class="kt-subheader__breadcrumbs-home"><i class="fa fa-home"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>

                @if (auth()->user()->hasPermission('index-contact-us'))
                    <a href="{{route('contact_us.contact_us.index')}}" data-8xload class="kt-subheader__breadcrumbs-link">{{__('contactus::contact_us.contactus')}}</a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                @else
                    <a href="#" class="kt-subheader__breadcrumbs-link">{{__('contactus::contact_us.contactus')}}</a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                @endif

                <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">{{__('contactus::contact_us.create_contact')}}</span>
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
                            <h3 class="kt-portlet__head-title">{{__('contactus::contact_us.create_contact')}}</h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <a href="{{url()->previous()}}" class="btn btn-clean kt-margin-r-10">
                                <i class="la la-arrow-left"></i>
                                <span class="kt-hidden-mobile">{{__('main.back')}}</span>
                            </a>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <!--begin::Form-->
                        <form action="{{route('contact_us.contact_us.store')}}" method="POST" id="create_contact_form" enctype="multipart/form-data" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="createContactUsCallback" data-parsley-validate>
                            @csrf
                            <div class="m-portlet__body">

                                <div class="form-group row">
                                    <div class="col-4">
                                        <label for="full_name">{{__('contactus::contact_us.full_name')}}</label>
                                        <input name="full_name" id="title" type="text" class="form-control" placeholder="{{__('contactus::contact_us.please_enter_the_full_name')}}" required data-parsley-required data-parsley-required-message="{{__('contactus::contact_us.please_enter_the_full_name')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('contactus::contact_us.full_name_max_is_150_characters_long')}}">
                                    </div>
                                    <div class="col-4">
                                        <label for="email">{{__('contactus::contact_us.email')}}</label> <small class="text-muted"> - {{__('contactus::contact_us.optional')}}</small>
                                        <input name="email" id="email" type="email" class="form-control" placeholder="{{__('contactus::contact_us.please_enter_the_email')}}" data-parsley-required-message="{{__('contactus::contact_us.please_enter_the_email')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('contactus::contact_us.email_max_is_150_characters_long')}}" data-parsley-type="email">
                                    </div>
                                    <div class="col-4">
                                        <label for="phone">{{__('contactus::contact_us.phone')}}</label>
                                        <input name="phone" id="phone" type="number" class="form-control" placeholder="{{__('contactus::contact_us.please_enter_the_phone')}}" required data-parsley-required data-parsley-required-message="{{__('contactus::contact_us.please_enter_the_phone')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="20" data-parsley-maxlength-message="{{__('contactus::contact_us.phone_max_is_20_characters_long')}}">
                                    </div>
                                    <div class="col-4">
                                        <label for="link">{{__('contactus::contact_us.link')}}</label>
                                        <input name="link" id="link" type="text" class="form-control" placeholder="{{__('contactus::contact_us.please_enter_the_link')}}" required data-parsley-required data-parsley-required-message="{{__('contactus::contact_us.please_enter_the_link')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295" data-parsley-maxlength-message="{{__('contactus::contact_us.link_max_is_4294967295_characters_long')}}">
                                    </div>
                                    <div class="col-8">
                                        <label for="message">{{__('contactus::contact_us.message')}} <small class="text-muted"> - {{__('contactus::contact_us.optional')}}</small></label>
                                        <textarea rows="4" name="message" id="message" class="form-control" placeholder="{{__('contactus::contact_us.please_enter_the_message')}}" required data-parsley-required data-parsley-required-message="{{__('contactus::contact_us.please_enter_the_message')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295" data-parsley-maxlength-message="{{__('contactus::contact_us.message_max_is_4294967295_characters_long')}}"></textarea>
                                    </div>
                                    <div class="col-4">
                                        <label>{{trans('contactus::contact_us.best_time_to_call_from')}}</label>
                                        <input name="best_time_to_call_from" autocomplete="off" class="form-control datetimepicker-init" placeholder="{{trans('contactus::contact_us.best_time_to_call_from')}}" data-parsley-trigger="change focusout" />
                                        <label>{{trans('contactus::contact_us.best_time_to_call_to')}}</label>
                                        <input name="best_time_to_call_to" autocomplete="off" class="form-control datetimepicker-init" placeholder="{{trans('contactus::contact_us.best_time_to_call_to')}}" data-parsley-trigger="change focusout" />
                                    </div>

                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions--solid">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-success">{{__('main.submit')}}</button>
                                            <button type="reset" class="btn btn-secondary">{{__('main.reset')}}</button>
                                            {{--
                                                <a href="{{route('contact_us.contact_us.create')}}" data-8xload class="btn btn-brand btn-icon-sm">
                                            <i class="flaticon2-plus"></i> {{trans('contactus::contact_us.create_new')}}
                                            </a>
                                            --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end:: Content -->

</div>