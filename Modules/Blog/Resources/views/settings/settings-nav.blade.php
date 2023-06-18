<div class="kt-section">
    <div class="kt-section__content kt-section__content--solid kt-section__content--fit">
        <ul class="kt-nav kt-nav--bold kt-nav--md-space kt-nav--v3 set-as-active" id="settings_nav" role="tablist">

            @haspermission('index-settings-footer-links')
            <li class="kt-nav__item">
                <a href="{{route('settings.footer_links.index')}}" data-8xload-it-in-href="#loadBISettingsContent" class="kt-nav__link active">
                    <span class="kt-nav__link-text">{{trans('left_aside.footerlinks')}}</span>
                </a>
            </li>
            @endhaspermission
        </ul>
    </div>
</div>