<header class="main-header">

    <nav class="navbar navbar-expand-lg">
      <div class="container mx-0">

        <a class="navbar-brand p-0 m-0" href="{{route('front.home')}}">
          <img class="dark-logo" src="{{asset('front/assets/logo/logo.png')}}" alt="" style="height: 60px; width: 60px;">
          <img class="white-logo" src="{{asset('front/assets/logo/logo-white.png')}}" alt=""  style="height: 60px; width: 60px;">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-menu"
          aria-expanded="false">
        </button>

        <div class="collapse navbar-collapse" id="main-menu">
          <ul class="navbar-nav align-items-lg-center ms-auto my-lg-0 my-3 mb-lg-0 mx-auto">
            <li class="nav-item active mx-3">
                <a class="nav-link" href="{{route('front.home')}}">{{ __('main.home_title') }}</a>
              </li>
            <li class="nav-item ">
              <a class="nav-link" href="{{ route('front.about') }}">{{ __('main.about_us') }}</a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle"  href="{{ route('front.properties') }}"  >
                {{__('main.properties')}}
              </a>
              <ul class="dropdown-menu">
                @foreach ($offering_types as $offering_type)
                {{-- @if($offering_type->id==3) --}}
                {{-- @else --}}
                <li><a class="dropdown-item" style="--delay:.{{$loop->index}}s"
                    href="{{ route('front.properties', ['offering_types[]' => $offering_type->id]) }}">{{ $offering_type->offering_type }}</a></li>
                {{-- @endif --}}
                @endforeach
              </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle"  href="{{ route('front.projects') }}"  >
                  {{__('main.projects')}}
                </a>
                <ul class="dropdown-menu">
                  @foreach ($purposes as $offering_type)

                  <li><a class="dropdown-item" style="--delay:.{{$loop->index}}s"
                      href="{{ route('front.projects', ['purpose_ids[]' => $offering_type->id]) }}">{{ $offering_type->purpose }}</a></li>
                  @endforeach
                </ul>
              </li>

            <li class="nav-item">
              <a class="nav-link"  href="{{ route('front.developers') }}">{{ __('inventory::inventory.developers') }}</a>

            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{route('front.blogs')}}">{{__('main.blog')}}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('front.services')}}">{{__('main.services')}}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('front.careers')}}">{{__('main.careers')}}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('front.contact-us')}}">{{__('main.contact_us')}}</a>
            </li>
            <li class="nav-item">
              <a class="site-btn sell-btn" data-bs-toggle="modal" href="#sell-area">
                {{__('main.sell_your_unit')}}
              </a>
            </li>

            <li class="nav-item change-mode">
              <button class="theme-toggle" id="theme-toggle" title="Toggles light &amp; dark">
                <svg width="24" height="24" viewBox="0 0 24 24">
                  <mask id="moon" class="moon">
                    <rect x="0" y="0" width="100%" height="100%" fill="#fff"></rect>
                    <circle cx="40" cy="8" r="11" fill="#000"></circle>
                  </mask>
                  <circle class="sun" cx="12" cy="12" r="11" mask="url(#moon)"></circle>
                  <g class="sun-beams">
                    <line x1="12" y1="1" x2="12" y2="3"></line>
                    <line x1="12" y1="21" x2="12" y2="23"></line>
                    <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                    <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                    <line x1="1" y1="12" x2="3" y2="12"></line>
                    <line x1="21" y1="12" x2="23" y2="12"></line>
                    <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                    <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                  </g>
                </svg>
              </button>
            </li>

            <li class="nav-item">
                @foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale)
                    @if (App::getLocale() == 'en')
                        @if ($locale == 'ar')
                            @if ($setting->enable_ar)
                                <a class="nav-link lang-btn d-flex align-items-center gap-1" href="{{ LaravelLocalization::getLocalizedURL($locale) }}">
                                    <svg width="20" viewBox="0 0 100 100"><path fill="currentColor" d="M49.947 0A50 50 0 0 0 0 50a50 50 0 0 0 50 50a50 50 0 0 0 50-50A50 50 0 0 0 50 0a50 50 0 0 0-.053 0zM52.5 5.682c5.268.896 10.302 5.236 14.268 12.437c1.278 2.321 2.42 4.927 3.408 7.75H52.5V5.682zm-5 .197v19.99H30.75c.988-2.823 2.13-5.429 3.408-7.75C37.89 11.341 42.571 7.102 47.5 5.88zM35.98 7.232c-2.324 2.352-4.41 5.22-6.203 8.475c-1.68 3.05-3.125 6.467-4.312 10.162H12.01c5.535-8.706 13.975-15.37 23.97-18.637zm29.41.463c9.398 3.413 17.32 9.868 22.6 18.174H75.455c-1.184-3.695-2.627-7.112-4.307-10.162c-1.676-3.045-3.613-5.749-5.757-8.012zM9.257 30.87h14.808c-1.245 5.162-2.008 10.76-2.203 16.631H5.072a44.79 44.79 0 0 1 4.184-16.63zm19.974 0H47.5V47.5H26.867c.212-5.935 1.043-11.554 2.363-16.63zm23.27 0h19.195c1.32 5.077 2.152 10.696 2.364 16.631H52.5V30.87zm24.355 0h13.89a44.79 44.79 0 0 1 4.181 16.63H79.053c-.194-5.872-.955-11.468-2.198-16.63zM5.072 52.5h16.762c.129 5.856.82 11.454 1.994 16.63H9.256A44.79 44.79 0 0 1 5.072 52.5zm21.762 0H47.5v16.63H28.98c-1.245-5.1-2.006-10.715-2.146-16.63zm25.666 0h21.592c-.14 5.915-.902 11.53-2.147 16.63H52.5V52.5zm26.576 0h15.852a44.79 44.79 0 0 1-4.184 16.63H77.09c1.17-5.177 1.857-10.775 1.986-16.63zM12.01 74.13h13.136c1.242 4.085 2.8 7.84 4.631 11.165c1.438 2.61 3.068 4.969 4.854 7.017c-9.407-3.41-17.336-9.869-22.621-18.181zm18.394 0H47.5v20.798c-.308-.017-.612-.048-.918-.07c-4.59-1.5-8.924-5.62-12.424-11.975c-1.428-2.594-2.692-5.537-3.754-8.752zm22.096 0h18.021c-1.06 3.216-2.325 6.159-3.753 8.753c-3.428 6.225-7.656 10.308-12.141 11.883a45.48 45.48 0 0 1-2.127.162V74.13zm23.275 0H87.99a45.06 45.06 0 0 1-21.228 17.641c1.604-1.92 3.075-4.094 4.386-6.476c1.831-3.325 3.388-7.08 4.627-11.164z" color="currentColor"/></svg>
                                    <span>{{ Config::get('laravellocalization.supportedLocales.' . $locale . '.native') }}</span>
                                </a>

                            @endif
                        @endif
                    @endif
                    @if (App::getLocale() == 'ar')
                        @if ($locale == 'en')
                            <a class="nav-link lang-btn d-flex align-items-center gap-1" href="{{ LaravelLocalization::getLocalizedURL($locale) }}">
                                <svg width="20" viewBox="0 0 100 100"><path fill="currentColor" d="M49.947 0A50 50 0 0 0 0 50a50 50 0 0 0 50 50a50 50 0 0 0 50-50A50 50 0 0 0 50 0a50 50 0 0 0-.053 0zM52.5 5.682c5.268.896 10.302 5.236 14.268 12.437c1.278 2.321 2.42 4.927 3.408 7.75H52.5V5.682zm-5 .197v19.99H30.75c.988-2.823 2.13-5.429 3.408-7.75C37.89 11.341 42.571 7.102 47.5 5.88zM35.98 7.232c-2.324 2.352-4.41 5.22-6.203 8.475c-1.68 3.05-3.125 6.467-4.312 10.162H12.01c5.535-8.706 13.975-15.37 23.97-18.637zm29.41.463c9.398 3.413 17.32 9.868 22.6 18.174H75.455c-1.184-3.695-2.627-7.112-4.307-10.162c-1.676-3.045-3.613-5.749-5.757-8.012zM9.257 30.87h14.808c-1.245 5.162-2.008 10.76-2.203 16.631H5.072a44.79 44.79 0 0 1 4.184-16.63zm19.974 0H47.5V47.5H26.867c.212-5.935 1.043-11.554 2.363-16.63zm23.27 0h19.195c1.32 5.077 2.152 10.696 2.364 16.631H52.5V30.87zm24.355 0h13.89a44.79 44.79 0 0 1 4.181 16.63H79.053c-.194-5.872-.955-11.468-2.198-16.63zM5.072 52.5h16.762c.129 5.856.82 11.454 1.994 16.63H9.256A44.79 44.79 0 0 1 5.072 52.5zm21.762 0H47.5v16.63H28.98c-1.245-5.1-2.006-10.715-2.146-16.63zm25.666 0h21.592c-.14 5.915-.902 11.53-2.147 16.63H52.5V52.5zm26.576 0h15.852a44.79 44.79 0 0 1-4.184 16.63H77.09c1.17-5.177 1.857-10.775 1.986-16.63zM12.01 74.13h13.136c1.242 4.085 2.8 7.84 4.631 11.165c1.438 2.61 3.068 4.969 4.854 7.017c-9.407-3.41-17.336-9.869-22.621-18.181zm18.394 0H47.5v20.798c-.308-.017-.612-.048-.918-.07c-4.59-1.5-8.924-5.62-12.424-11.975c-1.428-2.594-2.692-5.537-3.754-8.752zm22.096 0h18.021c-1.06 3.216-2.325 6.159-3.753 8.753c-3.428 6.225-7.656 10.308-12.141 11.883a45.48 45.48 0 0 1-2.127.162V74.13zm23.275 0H87.99a45.06 45.06 0 0 1-21.228 17.641c1.604-1.92 3.075-4.094 4.386-6.476c1.831-3.325 3.388-7.08 4.627-11.164z" color="currentColor"/></svg>
                                <span>{{ Config::get('laravellocalization.supportedLocales.' . $locale . '.native') }}</span>
                            </a>
                        @endif
                    @endif
                @endforeach
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
