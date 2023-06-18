<div class="kt-section">
    <div class="kt-section__content kt-section__content--solid kt-section__content--fit">
        <ul class="kt-nav kt-nav--bold kt-nav--md-space kt-nav--v3 set-as-active" id="settings_nav" role="tablist">
            <li class="kt-nav__item">
                <a href="{{route('settings.mainSettings')}}" data-8xload-it-in-href="#loadBISettingsContent" class="kt-nav__link active">
                    <span class="kt-nav__link-text">{{trans('left_aside.settings')}}</span>
                </a>
            </li>            
            @haspermission('index-settings-footer-links')
            <li class="kt-nav__item">
                <a href="{{route('settings.footer_links.index')}}" data-8xload-it-in-href="#loadBISettingsContent" class="kt-nav__link active">
                    <span class="kt-nav__link-text">{{trans('left_aside.footerlinks')}}</span>
                </a>
            </li>
            @endhaspermission

            @haspermission('index-settings-logos')
            <li class="kt-nav__item">
                <a href="{{route('settings.logos.index')}}" data-8xload-it-in-href="#loadBISettingsContent" class="kt-nav__link">
                    <span class="kt-nav__link-text">{{trans('left_aside.logos')}}</span>
                </a>
            </li>
            @endhaspermission

            @haspermission('index-settings-contacts')
            <li class="kt-nav__item">
                <a href="{{route('settings.contacts.index')}}" data-8xload-it-in-href="#loadBISettingsContent" class="kt-nav__link">
                    <span class="kt-nav__link-text">{{trans('left_aside.contacts')}}</span>
                </a>
            </li>
            @endhaspermission

            @haspermission('index-socials')
            <li class="kt-nav__item">
                <a href="{{route('socials.index')}}" data-8xload-it-in-href="#loadBISettingsContent" class="kt-nav__link">
                    <span class="kt-nav__link-text">{{trans('left_aside.socials')}}</span>
                </a>
            </li>
            @endhaspermission

            @haspermission('index-about-sections')
            <li class="kt-nav__item">
                <a href="{{route('about.index')}}" data-8xload-it-in-href="#loadBISettingsContent" class="kt-nav__link">
                    <span class="kt-nav__link-text">{{trans('left_aside.about')}}</span>
                </a>
            </li>
            @endhaspermission
            @haspermission('index-settings-main-sliders')
            <li class="kt-nav__item">
                <a href="{{route('settings.main_sliders.index')}}" data-8xload-it-in-href="#loadBISettingsContent" class="kt-nav__link">
                    <span class="kt-nav__link-text">{{trans('left_aside.mainsliders')}}</span>
                </a>
            </li>
            @endhaspermission
            <!-- @haspermission('index-settings-teems')
            <li class="kt-nav__item">
                <a href="{{route('settings.top_agents.index')}}" data-8xload-it-in-href="#loadBISettingsContent" class="kt-nav__link">
                    <span class="kt-nav__link-text">{{trans('left_aside.top_agents')}}</span>
                </a>
            </li>
            @endhaspermission -->
            @haspermission('index-settings-branches')
            <li class="kt-nav__item">
                <a href="{{route('settings.branches.index')}}" data-8xload-it-in-href="#loadBISettingsContent" class="kt-nav__link">
                    <span class="kt-nav__link-text">{{trans('left_aside.branches')}}</span>
                </a>
            </li>
            @endhaspermission
            {{--@haspermission('index-settings-how-works')
            <li class="kt-nav__item">
                <a href="{{route('settings.how_works.index')}}" data-8xload-it-in-href="#loadBISettingsContent" class="kt-nav__link">
                    <span class="kt-nav__link-text">{{trans('settings::settings.how_works')}}</span>
                </a>
            </li>
            @endhaspermission--}}
            @haspermission('index-terms-conditions')
            <li class="kt-nav__item">
                <a href="{{route('terms.index')}}" data-8xload-it-in-href="#loadBISettingsContent" class="kt-nav__link">
                    <span class="kt-nav__link-text">{{__('cms::cms.terms')}}</span>
                </a>
            </li>
            @endhaspermission
            @haspermission('index-privacies')
            <li class="kt-nav__item">
                <a href="{{route('privacies.index')}}" data-8xload-it-in-href="#loadBISettingsContent" class="kt-nav__link">
                    <span class="kt-nav__link-text">{{__('cms::cms.privacies')}}</span>
                </a>
            </li>
            @endhaspermission
        </ul>
    </div>
</div>