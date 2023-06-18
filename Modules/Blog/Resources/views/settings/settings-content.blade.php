@section('title', __('settings::settings.settings_settings'))

<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-margin-t-10">

    <!-- begin:: Content -->
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <!-- begin:: Content -->
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
            <div class="kt-portlet">
                <div class="kt-portlet__head head-zindex-fix">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title kt-font-danger animated bounceIn">
                            <i class="fas fa-city"></i> <span title>{{__('settings::settings.settings')}}</span> <small><span class="kt-font-success kt-font-bolder">{{__('settings::settings.settings')}}</span></small>
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <a href="{{route('settings.settings')}}" class="btn btn-clean btn-icon-sm">
                                <i class="la la-long-arrow-left"></i>
                                {{__('settings::settings.back_to_settings')}}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__bar">
                    <div class="col-12">
                        @include('settings::settings.settings-bar')
                    </div>
                </div>
                <div id="lccfilter" class="toggleit kt-padding-t-15">
                    <div class="col-12">
                        @include('settings::settings.settings-filter')
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            @include('settings::settings.settings-nav')
                        </div>
                        <div class="col-12 col-md-9">
                            <div id="loadBISettingsContent" -it-here data-path="{{route('settings.logos.index')}}"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>