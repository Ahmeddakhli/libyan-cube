<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title" data-8xloadtitle>{{__('seo::seo.create_seo')}}</h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="{{route('home')}}" class="kt-subheader__breadcrumbs-home"><i class="fa fa-home"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>

                @if (auth()->user()->hasPermission('index-seo-seo'))
                <a href="{{route('seo.index')}}" data-8xload class="kt-subheader__breadcrumbs-link">{{__('seo::seo.seo')}}</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                @else
                <a href="#" class="kt-subheader__breadcrumbs-link">{{__('seo::seo.seo')}}</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                @endif

                <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">{{__('seo::seo.create_seo')}}</span>
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
                            <h3 class="kt-portlet__head-title">{{__('seo::seo.create_seo')}}</h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <a href="{{url()->previous()}}" class="btn btn-clean kt-margin-r-10">
                                <i class="la la-arrow-left"></i>
                                <span class="kt-hidden-mobile">{{__('main.back')}}</span>
                            </a>
                        </div>
                    </div>


                    <div class="kt-portlet__body">
                        <!-- Create LCC Form -->
                        <!--begin::Form-->
                        <form action="{{route('seo.store')}}" method="POST" id="create_seo_form" enctype="multipart/form-data" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="createseoCallback" data-parsley-validate>
                            @csrf
                            <div class="m-portlet__body">
                                <div class="fancy-checkbox">
                                    <input name="show_short_description" id="show_short_description" type="checkbox">
                                    <label for="show_short_description">{{__('seo::seo.show_short_description')}}</label>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 repeater">
                                        <div data-repeater-list="translations">
                                            <div data-repeater-item class="row">
                                                <div class="col-6">
                                                     <label for="language_id">{{__('seo::seo.language')}}</label>
                                                    <select class="form-control" id="language_id" name="language_id" required data-parsley-required data-parsley-required-message="{{__('seo::seo.please_select_the_language')}}" data-parsley-trigger="change focusout">
                                                        <option value="" selected disabled>{{__('seo::seo.language')}}</option>
                                                        @foreach ($languages as $language)
                                                        <option value="{{$language->id}}" @if($language->id == 1) selected @endif>{{$language->code}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-6">
                                                    <label for="title">{{__('seo::seo.meta_title')}}</label>
                                                    <input name="title" id="title" type="text" class="form-control" placeholder="{{__('seo::seo.please_enter_the_seo')}}" required data-parsley-required data-parsley-required-message="{{__('seo::seo.please_enter_the_seo')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('seo::seo.title_max_is_150_characters_long')}}">
                                                </div>
                                                <div class="col-12">
                                                    <label for="popup_contact_us_title">{{__('seo::seo.popup_contact_us_title')}}</label>
                                                    <input name="popup_contact_us_title" id="popup_contact_us_title" type="text" class="form-control" placeholder="{{__('seo::seo.popup_contact_us_title')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('seo::seo.title_max_is_150_characters_long')}}">
                                                </div>
                                                <div class="col-lg-12">
                                                    <label for="description">{{__('seo::seo.meta_description')}} <small class="text-muted"> - {{__('seo::seo.optional')}}</small></label>
                                                    <textarea rows="6" name="description" id="description" class="form-control description" placeholder="{{__('seo::seo.enter_description')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295" data-parsley-maxlength-message="{{__('seo::seo.description_max_is_4294967295_characters_long')}}" required data-parsley-required data-parsley-required-message="{{__('seo::seo.please_enter_the_seo')}}"></textarea>
                                                </div>
                                                <div class="col-6 mt-2">
                                                    <label for="key_words">{{__('seo::seo.key_words')}} <small class="text-muted"> - {{__('seo::seo.optional')}}</small></label>
                                                    <input name="key_words" id="key_words" type="text" class="form-control" placeholder="{{__('seo::seo.key_words')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('seo::seo.title_max_is_150_characters_long')}}">
                                                </div>
                                                <div class="col-lg-6 mt-2">
                                                    <label for="short_description">{{__('seo::seo.description')}} <small class="text-muted"> - {{__('seo::seo.optional')}}</small></label>
                                                    <textarea rows="6" name="short_description" id="short_description-0" class="form-control short_description" placeholder="{{__('seo::seo.short_description')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295" data-parsley-maxlength-message="{{__('seo::seo.description_max_is_4294967295_characters_long')}}"></textarea>
                                                </div>
                                                <div class="col-md-2 col-sm-2">
                                                    {{-- <label class="control-label">&nbsp;</label> --}}
                                                    <a href="javascript:;" data-repeater-delete class="btn btn-brand data-repeater-delete">
                                                        <i class="fa fa-times"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="javascript:;" data-repeater-create id="repeater_btn" class="btn">
                                            <i class="fa fa-plus"></i> {{trans('seo::seo.add_seo_translation')}}
                                        </a>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-4">
                                        <label>{{trans('seo::seo.page')}}</label>
                                        <select class="form-control" id="page" name="page" required data-parsley-required data-parsley-required-message="{{__('seo::seo.page')}}" data-parsley-trigger="change focusout">
                                            <option value="" selected disabled>{{__('seo::seo.page')}}</option>
                                            @foreach (['home','projects','properties','contact','careers','developers','about','thank_you','blogs','unit_types','terms','privacy','sell_unit'] as $page)
                                                <option value="{{$page}}">{{__('seo::seo.'.$page)}}</option>
                                            @endforeach
                                        </select>
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
                                <a href="{{route('seo.create')}}" data-8xload class="btn btn-brand btn-icon-sm">
                                            <i class="flaticon2-plus"></i> {{trans('seo::seo.create_new')}}
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