<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title" data-8xloadtitle>{{__('locations::location.create_location')}}</h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="{{route('home')}}" class="kt-subheader__breadcrumbs-home"><i class="fa fa-home"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                @if (auth()->user()->hasPermission('index-locations'))
                <a href="{{route('locations.index')}}" data-8xload class="kt-subheader__breadcrumbs-link">{{__('locations::location.locations')}}</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                @else
                <a href="#" class="kt-subheader__breadcrumbs-link">{{__('locations::location.locations')}}</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                @endif

                <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">{{__('locations::location.create_location')}}</span>
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
                            <h3 class="kt-portlet__head-title">{{__('locations::location.create_location')}}</h3>
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
                        <form action="{{route('locations.store')}}" method="POST" id="create_location_form" enctype="multipart/form-data" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="createLocationCallback" data-parsley-validate>
                            @csrf
                            <div class="m-portlet__body">
                                <div class="form-group row">
                                    <div class="col-12 repeater">
                                        <div data-repeater-list="translations">
                                            <div data-repeater-item class="row">
                                                <div class="col-5">
                                                    <label for="language_id">{{__('locations::location.language')}}</label>
                                                    <select class="form-control" id="language_id" name="language_id" required data-parsley-required data-parsley-required-message="{{__('locations::location.please_select_the_language')}}" data-parsley-trigger="change focusout">
                                                        <option value="" selected disabled>{{__('locations::location.language')}}</option>
                                                        @foreach ($languages as $language)
                                                        <option value="{{$language->id}}" @if($language->id == 1) selected @endif>{{$language->code}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-5">
                                                    <label for="name">{{__('locations::location.name')}}</label>
                                                    <input name="name" id="name" type="text" class="form-control" placeholder="{{__('locations::location.please_enter_the_location')}}" required data-parsley-required data-parsley-required-message="{{__('locations::location.please_enter_the_location')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('locations::location.title_max_is_150_characters_long')}}">
                                                </div>
                                                <div class="col-5">
                                                    <label for="second_title">{{__('locations::location.second_title')}}</label>
                                                    <input name="second_title" id="second_title" type="text" class="form-control" placeholder="{{__('locations::location.please_enter_the_location')}}" required data-parsley-required data-parsley-required-message="{{__('locations::location.please_enter_the_location')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('locations::location.title_max_is_150_characters_long')}}">
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
                                            <i class="fa fa-plus"></i> {{trans('locations::location.add_location_translation')}}
                                        </a>
                                    </div>
                                </div>
                                <input type="hidden" name="parent_id" value="{{$parent_id}}">
                            </div>
                            <div class="col-12 d-flex mb-4">
                                <div class="col-5">
                                    <label for="code">{{__('locations::location.code')}}</label>
                                    <input name="code" id="code" type="text" class="form-control" placeholder="{{__('locations::location.title')}}" required data-parsley-required data-parsley-required-message="{{__('locations::location.name')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('locations::location.title_max_is_150_characters_long')}}">
                                </div>
                                <div class="col-5">
                                    <label for="order">{{__('locations::location.order')}}</label>
                                    <input name="order" id="order" type="number" class="form-control" placeholder="{{__('locations::location.title')}}" required data-parsley-required data-parsley-required-message="{{__('locations::location.name')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('locations::location.title_max_is_150_characters_long')}}">
                                </div>
                                <div class="col-1">
                                    <label for="is_active">{{__('locations::location.is_active')}}</label>
                                    <input name="is_active" id="is_active" type="checkbox" class="form-control">
                                </div>
                                <div class="col-1">
                                    <label for="in_discover_by">{{__('main.where_do_we_work')}}</label>
                                    <input name="in_discover_by" id="in_discover_by" type="checkbox" class="form-control">
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions--solid">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-success">{{__('main.submit')}}</button>
                                            <button type="reset" class="btn btn-secondary">{{__('main.reset')}}</button>
                                            {{--
                                      <a href="{{route('locations.create')}}" data-8xload class="btn btn-brand btn-icon-sm">
                                            <i class="flaticon2-plus"></i> {{trans('locations::location.create_new')}}
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