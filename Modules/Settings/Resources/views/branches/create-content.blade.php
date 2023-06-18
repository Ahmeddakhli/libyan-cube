<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title" data-8xloadtitle>{{__('settings::settings.create_contact')}}</h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="{{route('home')}}" class="kt-subheader__breadcrumbs-home"><i class="fa fa-home"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>

                @if (auth()->user()->hasPermission('index-settings-branches'))
                <a href="{{route('settings.branches.index')}}" data-8xload class="kt-subheader__breadcrumbs-link">{{__('settings::settings.branches')}}</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                @else
                <a href="#" class="kt-subheader__breadcrumbs-link">{{__('settings::settings.branches')}}</a>
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
                            <h3 class="kt-portlet__head-title">{{__('settings::settings.create_branch')}}</h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <a href="{{url()->previous()}}" data-8xload class="btn btn-clean kt-margin-r-10">
                                <i class="la la-arrow-left"></i>
                                <span class="kt-hidden-mobile">{{__('main.back')}}</span>
                            </a>
                        </div>
                    </div>
                    <!-- Create LCC Form -->
                    <form action="{{route('settings.branches.store')}}" data-async data-set-autofocus method="POST" id="create_contact_form" class="kt-form" enctype="multipart/form-data" data-parsley-validate>
                        @csrf
                        <div class="m-portlet__body">
                            <div class="form-group row">
                                <div class="form-group row col-12">
                                    <div class="col-12 mt-5">
                                        <label for="branch">{{__('settings::settings.branch')}} <small class="text-muted"> - {{__('settings::settings.optional')}}</small></label>
                                        <input name="branch" id="branch" type="text" class="form-control" placeholder="{{__('settings::settings.branch')}}"  data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('settings::settings.branch_max_is_150_characters_long')}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <!-- Map -->
                                    <div class="col-lg-12">
                                        <label>{{__('settings::settings.location')}}</label>
                                        <input id="map_search" name="map_search" class="form-control" type="text" placeholder="{{__('settings::settings.select_branch_location')}}">
                                        <div id="map" style="height:300px; width:100%;"></div>
                                        <input id="lat" name="latitude" type="hidden" value="" />
                                        <input id="lng" name="longitude" type="hidden" value="" />
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
                                             <a href="{{route('settings.branches.create')}}" data-8xload class="btn btn-brand btn-icon-sm">
                                            <i class="flaticon2-plus"></i> {{trans('settings::settings.create_new')}}
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