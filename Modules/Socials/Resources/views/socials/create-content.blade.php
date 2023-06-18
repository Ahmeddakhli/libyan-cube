<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title" data-8xloadtitle>{{__('socials::social.create_social')}}</h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="{{route('home')}}" class="kt-subheader__breadcrumbs-home"><i class="fa fa-home"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                @if (auth()->user()->hasPermission('index-socials'))
                <a href="{{route('socials.index')}}" data-8xload class="kt-subheader__breadcrumbs-link">{{__('socials::social.socials')}}</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                @else
                <a href="#" class="kt-subheader__breadcrumbs-link">{{__('socials::social.socials')}}</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                @endif
                <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">{{__('socials::social.create_social')}}</span>
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
                            <h3 class="kt-portlet__head-title">{{__('socials::social.create_social')}}</h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <a href="{{url()->previous()}}" data-8xload class="btn btn-clean kt-margin-r-10">
                                <i class="la la-arrow-left"></i>
                                <span class="kt-hidden-mobile">{{__('main.back')}}</span>
                            </a>
                        </div>
                    </div>
                    <!-- Create LCC Form -->
                    <form action="{{route('socials.store')}}" data-async data-set-autofocus method="POST" id="create_social_form" class="kt-form" enctype="multipart/form-data" data-parsley-validate>
                        @csrf
                        <div class="m-portlet__body">
                            <div class="form-group row">
                                <div class="form-group row">
                                    <div class="col-12 repeater">
                                        <div data-repeater-list="translations">
                                            <div data-repeater-item class="row">
                                                <div class="col-5 mt-5">
                                                    <label for="language_id">{{__('socials::social.language')}}</label>
                                                    <select class="form-control" id="language_id" name="language_id" required data-parsley-required data-parsley-required-message="{{__('socials::social.please_select_the_language')}}" data-parsley-trigger="change focusout">
                                                        <option value="" selected disabled>{{__('socials::social.language')}}</option>
                                                        @foreach ($languages as $language)
                                                        <option value="{{$language->id}}" @if($language->id == 1) selected @endif>{{$language->code}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-5 mt-5">
                                                    <label for="title">{{__('socials::social.title')}}</label>
                                                    <input name="title" id="title" type="text" class="form-control" placeholder="{{__('socials::social.please_enter_the_social')}}" required data-parsley-required data-parsley-required-message="{{__('socials::social.please_enter_the_social')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('socials::social.social_max_is_150_characters_long')}}">
                                                </div>
                                                <div class="col-md-2 col-sm-2 mt-auto">
                                                    {{-- <label class="control-label">&nbsp;</label> --}}
                                                    <a href="javascript:;" data-repeater-delete class="btn btn-brand data-repeater-delete">
                                                        <i class="fa fa-times"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="javascript:;" data-repeater-create id="repeater_btn" class="btn">
                                            <i class="fa fa-plus"></i> {{trans('socials::social.add_social_translation')}}
                                        </a>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-5 mt-5">
                                        <label for="link">{{__('socials::social.social')}}</label>
                                        <input name="link" id="link" type="text" class="form-control" placeholder="{{__('socials::social.please_enter_the_social_link')}}" required data-parsley-required data-parsley-required-message="{{__('socials::social.please_enter_the_social_link')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('socials::social.social_max_is_150_characters_long')}}">
                                    </div>
                                    <div class="col-5 mt-5">
                                        <label for="icon">{{__('socials::social.icon')}}</label>
                                        <input name="icon" id="icon" type="text" autocomplete="off" class="form-control icon-font" placeholder="{{__('socials::social.please_enter_the_social_icon')}}" required data-parsley-required data-parsley-required-message="{{__('socials::social.please_enter_the_social_icon')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('socials::social.social_max_is_150_characters_long')}}">
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
                                                <a href="{{route('socials.create')}}" data-8xload class="btn btn-brand btn-icon-sm">
                                            <i class="flaticon2-plus"></i> {{trans('socials::social.create_new')}}
                                            </a>
                                            --}}
                                        </div>
                                    </div>
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