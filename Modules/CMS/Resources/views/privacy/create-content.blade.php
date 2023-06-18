<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title" data-8xloadtitle>{{__('cms::cms.create_privacy')}}</h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="{{route('home')}}" class="kt-subheader__breadcrumbs-home"><i class="fa fa-home"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>

                @if (auth()->user()->hasPermission('index-privacies'))
                <a href="{{route('privacies.index')}}" data-8xload class="kt-subheader__breadcrumbs-link">{{__('cms::cms.privacy')}}</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                @else
                <a href="#" class="kt-subheader__breadcrumbs-link">{{__('cms::cms.privacy')}}</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                @endif

                <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">{{__('cms::cms.create_privacy')}}</span>
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
                            <h3 class="kt-portlet__head-title">{{__('cms::cms.create_privacy')}}</h3>
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
                        <form action="{{route('privacies.privacies.store')}}" data-async data-set-autofocus method="POST" id="create_privacy_form" class="kt-form" enctype="multipart/form-data" data-parsley-validate>
                            @csrf
                            <div class="row">
                                <div class="col-xl-2"></div>
                                <div class="col-xl-10">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            <div class="form-group">
                                                <h3 class="kt-section__title kt-section__title-lg kt-margin-b-0">{{__('cms::cms.privacy')}}:</h3>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-2">
                                                    {{-- <label for="order">{{__('cms::cms.order')}}</label> --}}
                                                    <input name="order" id="order" type="text" class="form-control" placeholder="{{__('cms::cms.order')}}" required data-parsley-required data-parsley-required-message="{{__('cms::cms.order_is_required')}}" data-parsley-trigger="change focusout" data-parsley-type="integer" data-parsley-min="0">
                                                </div>

                                                <div class="col-8 repeater">
                                                    <div data-repeater-list="translations">
                                                        <div data-repeater-item class="row">
                                                            <div class="col-3">
                                                                {{-- <label for="language_id">{{__('cms::cms.language')}}</label> --}}
                                                                <select class="form-control" id="language_id" name="language_id" required data-parsley-required data-parsley-required-message="{{__('cms::cms.please_select_the_language')}}" data-parsley-trigger="change focusout">
                                                                    <option value="" selected disabled>{{__('cms::cms.language')}}</option>
                                                                    @foreach ($languages as $language)
                                                                    <option value="{{$language->id}}" @if($language->id == 1) selected @endif>{{$language->code}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-6 mt-5">
                                                                <label for="title">{{__('cms::cms.title')}}</label>
                                                                <input name="title" id="title" type="text" class="form-control" placeholder="{{__('cms::cms.title')}}" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('cms::cms.privacy_max_is_150_characters_long')}}">
                                                            </div>

                                                            <div class="col-12 mt-5">
                                                                <label for="description">{{__('cms::cms.description')}}</label>
                                                                <textarea name="description" id="description" class="form-control" placeholder="{{__('cms::cms.please_enter_the_privacy')}}" required data-parsley-required data-parsley-required-message="{{__('cms::cms.description')}}" data-parsley-trigger="change focusout" cols="30" rows="10"></textarea>
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
                                                        <i class="fa fa-plus"></i> {{trans('cms::cms.add_translation')}}
                                                    </a>
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