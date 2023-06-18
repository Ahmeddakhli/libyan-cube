<!--begin: Language bar -->
<div class="kt-header__topbar-item kt-header__topbar-item--langs pr-0">
    <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,10px">
        <span class="kt-header__topbar-icon">
            <img src="{{asset('8x/assets/media/flags/'. LaravelLocalization::getCurrentLocale() .'.svg')}}" alt="" />
        </span>
    </div>
    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim">
        <ul class="kt-nav kt-margin-t-10 kt-margin-b-10">
            @foreach(LaravelLocalization::getSupportedLanguagesKeys() as $locale)
            <li class="kt-nav__item @if(LaravelLocalization::getCurrentLocale() == $locale)  kt-nav__item--active @endif">
                <a href="{{ LaravelLocalization::getLocalizedURL($locale) }}" class="kt-nav__link">
                    <span class="kt-nav__link-icon"><img src="{{asset('8x/assets/media/flags/'.$locale.'.svg')}}" alt="{{ Config::get('laravellocalization.supportedLocales.'.$locale.'.native') }}" /></span>
                    <span class="kt-nav__link-text">{{ Config::get('laravellocalization.supportedLocales.'.$locale.'.native') }}</span>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>
<!--end: Language bar -->
