<main class="main-content" @if($project->landing_page_image) style="background-image:url({{$project->landing_page_image}}) !important" @endif>
    <div class="container">
        <div class="content-wrapper">
            <header class="main-header">
                @foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale)
                    @if (App::getLocale() == 'en')
                        @if ($locale == 'ar')
                            @if ($setting->enable_ar)
                                <a class="lang-btn" href="{{ LaravelLocalization::getLocalizedURL($locale) }}">
                                    <span
                                        class="lang-text">{{ Config::get('laravellocalization.supportedLocales.' . $locale . '.native') }}</span>
                                    <img class="lang-img"
                                        src="{{ asset('8x/assets/media/flags/' . $locale . '.svg') }}"
                                        alt="{{ Config::get('laravellocalization.supportedLocales.' . $locale . '.native') }}">
                                </a>
                            @endif
                        @endif
                    @endif
                    @if (App::getLocale() == 'ar')
                        @if ($locale == 'en')
                            <a class="lang-btn" href="{{ LaravelLocalization::getLocalizedURL($locale) }}">
                                <span
                                    class="lang-text">{{ Config::get('laravellocalization.supportedLocales.' . $locale . '.native') }}</span>
                                <img class="lang-img" src="{{ asset('8x/assets/media/flags/' . $locale . '.svg') }}"
                                    alt="{{ Config::get('laravellocalization.supportedLocales.' . $locale . '.native') }}">
                            </a>
                        @endif
                    @endif
                @endforeach
                <div class="logo">
                    <img src="{{ asset('front/landing/img/logo-white.svg') }}">
                </div>
            </header>
            <div id=" block-content" class="block-content">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <h1 class="mb-3">{{ $project->project }}</h1>
                        {!! $project->landing_description !!}
                    </div>
                    <div class="col-md-10 col-lg-5">
                        <form class="contact-form p-4 rounded-3 form-contact"
                            action="{{ route('contact_us.contact_us.store') }}" method="POST" data-parsley-validate>
                            @csrf
                            <input type="hidden" name="link" value="{{ Request::url() }}">
                            <input type="hidden" name="type" value="contact">
                            <input type="hidden" name="model_name" value="{{ $project->project }}">

                            <div class="form-group">
                                <input id='full-name' type="text" name="full_name" class="form-control"
                                    placeholder="{{ __('users.full_name') }}" data-parsley-trigger="change focusout"
                                    required data-parsley-required-message="{{ __('main.please_enter_your_name') }}">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control phone-input"
                                    placeholder="{{ __('users.mobile_number') }}" name="phone"
                                    data-parsley-trigger="change focusout" required
                                    data-parsley-required-message="{{ __('main.please_enter_your_mobile_number') }}">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email"
                                    placeholder="{{ __('users.email') }}"
                                    data-parsley-type-message="يجب أن يكون عنوان بريد إلكتروني" required
                                    data-parsley-required-message="{{ __('main.please_enter_your_email') }}">
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    @foreach ($project->unit_types as $unit_type)
                                        <div class="col-6 form-check">
                                            <input id="inp-{{ $unit_type->id }}" value="{{ $unit_type->unit_type }}"
                                                name="unit_types[]" type="checkbox">
                                            <label for="inp-{{ $unit_type->id }}"
                                                class="check-label">{{ $unit_type->unit_type }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <input class="myField" data-parsley-errors-container="#errorContainer" data-parsley-required="true" value="" type="text" style="display:none;" data-parsley-required-message="please verify you not spam">
                            <span id='errorContainer'></span>
                    
                            <div class="g-recaptcha w-100"
                            data-sitekey="{{env('NOCAPTCHA_SITEKEY')}}" data-callback="recaptchaCallback" ></div>
                    
                            <div class="form-group mb-0">
                                <button id="submit-form" class="cta-btn contact-from" type="button">
                                    {{ __('main.request_a_call_back') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <footer class="main-footer">
                <p class="mb-1">{{ __('main.all_rights_reserved') }}
                    <bdi>
                        <strong>8WORX</strong>
                    </bdi>
                </p>

            </footer>
        </div>
    </div>
</main>
