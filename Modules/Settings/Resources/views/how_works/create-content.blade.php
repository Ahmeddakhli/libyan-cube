<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title" data-8xloadtitle>{{__('settings::settings.create_how_work')}}</h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="{{route('home')}}" class="kt-subheader__breadcrumbs-home"><i class="fa fa-home"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>

                @if (auth()->user()->hasPermission('index-settings-how-works'))
                    <a href="{{route('settings.how_works.index')}}" data-8xload class="kt-subheader__breadcrumbs-link">{{__('settings::settings.how_works')}}</a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                @else
                    <a href="#" class="kt-subheader__breadcrumbs-link">{{__('settings::settings.how_works')}}</a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                @endif
                <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">{{__('settings::settings.create_how_work')}}</span>
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
                            <h3 class="kt-portlet__head-title">{{__('settings::settings.create_how_work')}}</h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <a href="{{url()->previous()}}" data-8xload class="btn btn-clean kt-margin-r-10">
                                <i class="la la-arrow-left"></i>
                                <span class="kt-hidden-mobile">{{__('main.back')}}</span>
                            </a>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <form action="{{route('settings.how_works.store')}}" data-async data-set-autofocus method="POST" id="create_how_work_form" class="kt-form" enctype="multipart/form-data" data-parsley-validate>
                            @csrf
                            <div class="row">
                                <div class="col-xl-2"></div>
                                <div class="col-xl-10">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            <div class="form-group">
                                                <h3 class="kt-section__title kt-section__title-lg kt-margin-b-0">{{__('settings::settings.how_work')}}:</h3>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-12 repeater">
                                                    <div data-repeater-list="translations">
                                                        <div data-repeater-item class="row">
                                                            <div class="col-5 mt-5">
                                                                <label for="language_id">{{__('settings::settings.language')}}</label>
                                                                <select class="form-control" id="language_id" name="language_id" required data-parsley-required data-parsley-required-message="{{__('settings::settings.please_select_the_language')}}" data-parsley-trigger="change focusout">
                                                                    <option value="" selected disabled>{{__('settings::settings.language')}}</option>
                                                                    @foreach ($languages as $language)
                                                                    <option value="{{$language->id}}" @if($language->id == 1) selected @endif>{{$language->code}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-5 mt-5">
                                                                <label for="title">{{__('settings::settings.title')}}</label>
                                                                <input name="title" id="title" type="text" class="form-control" placeholder="{{__('settings::settings.please_enter_the_title')}}" required data-parsley-required data-parsley-required-message="{{__('settings::settings.please_enter_the_title')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('settings::settings.title_max_is_150_characters_long')}}">
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
                                                        <i class="fa fa-plus"></i> {{trans('settings::settings.add_how_work_translation')}}
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="form-group row col-12">
                                                <div class="col-12 mt-5">
                                                    <label for="image">{{__('settings::settings.image')}}</label>
                                                    <input name="image" id="image" type="file" placeholder="" required data-parsley-required data-parsley-required-message="" data-parsley-trigger="change focusout">
                                                </div>
                                                <div class="col-12 mt-5">
                                                    <label for="link">{{__('settings::settings.link')}}</label>
                                                    <input name="link" id="link" type="link" class="form-control" placeholder="{{__('settings::settings.please_enter_the_link')}}" required data-parsley-required data-parsley-required-message="{{__('settings::settings.please_enter_the_link')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('settings::settings.link_max_is_150_characters_long')}}">
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
    </div>
    <!-- end:: Content -->
</div>