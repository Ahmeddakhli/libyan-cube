<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title" data-8xloadtitle>{{__('inventory::inventory.create_facility')}}</h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="{{route('home')}}" class="kt-subheader__breadcrumbs-home"><i class="fa fa-home"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>

                @if (auth()->user()->hasPermission('index-inventory-facilities'))
                <a href="{{route('inventory.facilities.index')}}" data-8xload class="kt-subheader__breadcrumbs-link">{{__('inventory::inventory.facilities')}}</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                @else
                <a href="#" class="kt-subheader__breadcrumbs-link">{{__('inventory::inventory.facilities')}}</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                @endif

                <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">{{__('inventory::inventory.create_facility')}}</span>
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
                            <h3 class="kt-portlet__head-title">{{__('inventory::inventory.create_facility')}}</h3>
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
                        <form action="{{route('inventory.facilities.store')}}" data-async data-set-autofocus method="POST" id="create_facility_form" class="kt-form" enctype="multipart/form-data" data-parsley-validate>
                            @csrf
                            <div class="row">
                                <div class="col-xl-2"></div>
                                <div class="col-xl-10">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            <div class="form-group">
                                                <h3 class="kt-section__title kt-section__title-lg kt-margin-b-0">{{__('inventory::inventory.facility')}}:</h3>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-2">
                                                    {{-- <label for="order">{{__('inventory::inventory.order')}}</label> --}}
                                                    <input name="order" id="order" type="text" class="form-control" placeholder="{{__('inventory::inventory.order')}}"  data-parsley-trigger="change focusout" data-parsley-type="integer" data-parsley-min="0">
                                                </div>

                                                <div class="col-8">
                                                    <label for="svg">{{__('inventory::inventory.svg')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                    <textarea rows="6" name="svg" id="svg" class="form-control" placeholder="{{__('inventory::inventory.svg')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295" data-parsley-maxlength-message="{{__('inventory::inventory.svg_max_is_4294967295_characters_long')}}"></textarea>
                                                </div>

                                                <div class="col-8 repeater">
                                                    <div data-repeater-list="translations">
                                                        <div data-repeater-item class="row">
                                                            <div class="col-3">
                                                                {{-- <label for="language_id">{{__('inventory::inventory.language')}}</label> --}}
                                                                <select class="form-control" id="language_id" name="language_id" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_select_the_language')}}" data-parsley-trigger="change focusout">
                                                                    <option value="" selected disabled>{{__('inventory::inventory.language')}}</option>
                                                                    @foreach ($languages as $language)
                                                                    <option value="{{$language->id}}" @if($language->id == 1) selected @endif>{{$language->code}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-3">
                                                                {{-- <label for="facility">{{__('inventory::inventory.facility')}}</label> --}}
                                                                <input name="facility" id="facility" type="text" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_facility')}}" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_enter_the_facility')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('inventory::inventory.facility_max_is_150_characters_long')}}">
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
                                                        <i class="fa fa-plus"></i> {{trans('inventory::inventory.add_facility_translation')}}
                                                    </a>
                                                </div>

                                            </div>
                                            <div class="form-group row">

                                                <div class="col-lg-4">
                                                    {{-- <div class="form-group">
                                                    <h4 class="kt-section__title kt-section__title-lg kt-margin-b-0">{{__('inventory::inventory.unit_attachments')}}:</h4>
                                                </div> --}}
                                                <div class="row">
                                                    <div class="box">
                                                        <label for="attachments">{{__('inventory::inventory.attachments')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                        <input type="file" name="attachments" class="inputfile inputfile-5" id="file-6" data-multiple-caption="{count} {{trans('inventory::inventory.files_selected')}}" />
                                                        <label for="file-6">
                                                            <figure><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                                                                    <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z" /></svg></figure> <span></span>
                                                        </label>
                                                    </div>
                                                </div>
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