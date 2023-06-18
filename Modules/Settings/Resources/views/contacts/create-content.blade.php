<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title" data-8xloadtitle>{{__('settings::settings.create_contact')}}</h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="{{route('home')}}" class="kt-subheader__breadcrumbs-home"><i class="fa fa-home"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                @if (auth()->user()->hasPermission('index-settings-contacts'))
                <a href="{{route('settings.contacts.index')}}" data-8xload class="kt-subheader__breadcrumbs-link">{{__('settings::settings.contacts')}}</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                @else
                <a href="#" class="kt-subheader__breadcrumbs-link">{{__('settings::settings.contacts')}}</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                @endif
                <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">{{__('settings::settings.create_contact')}}</span>
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
                            <h3 class="kt-portlet__head-title">{{__('settings::settings.create_contact')}}</h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <a href="{{url()->previous()}}" data-8xload class="btn btn-clean kt-margin-r-10">
                                <i class="la la-arrow-left"></i>
                                <span class="kt-hidden-mobile">{{__('main.back')}}</span>
                            </a>
                        </div>
                    </div>
                    <!-- Create LCC Form -->
                    <form action="{{route('settings.contacts.store')}}" data-async data-set-autofocus method="POST" id="create_contact_form" class="kt-form" enctype="multipart/form-data" data-parsley-validate>
                        @csrf
                        <div class="m-portlet__body">
                            <div class="form-group row">
                                <div class="col-12 mt-5">
                                    <label for="value">{{__('settings::settings.contact')}}</label>
                                    <input name="value" id="value" type="text" class="form-control" placeholder="{{__('settings::settings.please_enter_the_contact')}}" required data-parsley-required data-parsley-required-message="{{__('settings::settings.please_enter_the_contact')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('settings::settings.contact_max_is_150_characters_long')}}">
                                </div>
                                <div class="col-12 mt-5">
                                    <label for="type">{{__('settings::settings.select_type')}}</label>
                                    <select name="type" id="type" class="form-control selectpicker" data-live-search="true" required data-parsley-required data-parsley-required-message="{{__('settings::settings.please_select_the_type')}}" data-parsley-trigger="change focusout" data-parsley-errors-container="#type_error_container">
                                        <option selected disabled value="">{{__('settings::settings.select_type')}}</option>
                                        <option value="careers">{{__('settings::settings.email_to_receive_career_applications')}}</option>
                                        <option value="contact_us">{{__('settings::settings.email_to_receive_contact_us_messages')}}</option>
                                        <option value="phone">{{__('settings::settings.website_contact_us_phone_number')}}</option>
                                        <option value="email">{{__('settings::settings.website_contact_us_email')}}</option>
                                        <option value="whatsapp">{{__('settings::settings.website_contact_us_whatsapp')}}</option>
                                    </select>
                                    <div id="type_error_container" class="error_container"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end:: Content -->
</div>