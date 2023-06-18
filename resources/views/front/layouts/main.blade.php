@php
$whatsapp = '';
foreach ($contacts as $key => $contact) {
    if ($key == 'whatsapp') {
        foreach ($contact as $whats) {
            $whatsapp = $whats->contact;
            break;
        }
    }
}
$phone_number = '';
foreach ($contacts as $key => $contact) {
    if ($key == 'phone') {
        foreach ($contact as $ph) {
            $phone_number = $ph->contact;
            break;
        }
    }
}

if (App::getLocale() == 'ar') {
    $dir = 'rtl';
} else {
    $dir = 'ltr';
}

@endphp


<!DOCTYPE html>
<html lang="ar" dir="{{ $dir }}">

<head>
    @include('front.components.header-scripts')
</head>

<body class="@if (App::getLocale() == 'ar') dir-rtl @endif">

    @if ($setting->body_tag_manager)
        {!! $setting->body_tag_manager !!}
    @endif

    {{-- <div class="icons-holder">
        <nav>
            <ul class="contacts-list">
                <li class="mob-contact-form">
                    <button class="show-contact-us">
                        {{ __('main.contact_us') }}
                    </button>

                    @include('front.components.contact_form', ['type' => 'contact'])
                </li>
                @if ($setting->active_messanger_icon)
                    <li class="messenger">
                        <div id="fb-root"></div>
                        <div id="fb-customer-chat" class="fb-customerchat">
                    </li>
                @endif
                @if ($setting->active_whatsapp_icon)
                    <li class="whatsapp ">
                        <a class="link" href="whatsapp://send?phone={{ $whatsapp }}">
                            <i class="fab fa-whatsapp"></i>
                            <span>whatsapp</span>
                        </a>
                    </li>
                @endif

            </ul>
        </nav>
    </div> --}}
    <div class="cookie-banner">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-10">
                    <p class="p-0">
                        @if (App::getLocale() == 'en')
                            We use cookies. When you interact with advisors web site, we'd like to provide you with the
                            best experience that we can. Cookies are used to help personalise your online experience,
                            tailor advertising, and learn how visitors use our website. If you continue to use this
                            site, you consent to our use of cookies
                        @else
                            نحن نستخدم ملفات تعريف الارتباط. عندما تتواصل مع انلاند عبر موقعها الإلكتروني، فإننا نود أن
                            نقدم إليك أفضل تجربة ممكنة. تُستخدم ملفات تعريف الارتباط للمساعدة في تخصيص تجربتك عبر
                            الإنترنت وتخصيص الإعلانات ومعرفة كيفية استخدام الزوار موقعنا. إذا واصلت استخدام هذا الموقع،
                            فإنك توافق على استخدامنا لملفات تعريف الارتباط
                        @endif
                        <a href="{{ route('front.privacies') }}">{{ __('main.privcy_policy') }}</a>
                    </p>
                </div>
                <div class="col-md-2 text-md-right">
                    <button class="cookie-btn mt-md-0 mt-3">{{ __('main.got_it') }}</button>
                </div>
            </div>
        </div>
    </div>

    @if (Route::currentRouteName() == 'front.home')
        <!-- START splash screen -->
        <div class="splash-screen">
            <div class="logo">
                <img class="symbol" src="{{asset('front/assets/logo/logo.png')}}" alt="">
            </div>
        </div>
        <!-- END splash screen -->
    @endif

    {{-- contact us --}}
    @include('front.components.contact_form', ['type' => 'contact'])
    {{-- go top --}}
    <a href="#" class="go-top-btn">
        <i class="ri-arrow-up-s-line"></i>
        <span>TOP</span>
    </a>


    <nav class="chat-actions">
        <input type="checkbox" class="visually-hidden toggle-action-input" id="chat-input">
        <label class="toggle-action-label toggle-chat-label" for="chat-input" title='Message Us'></label>

        <div class="social-links">

            @if ($setting->active_messanger_icon)
                <a href="https://m.me/Advisors.REExperts" class="social-link messenger-link" title='Messenger' style="--delay: 0.1s"
                    target="_blank" rel="noopener" noreferrer>
                    <i class="ri-messenger-line"></i>
                </a>
            @endif
            @if ($setting->active_whatsapp_icon)
                <a href="https://api.whatsapp.com/send?phone={{ $whatsapp }}" class="social-link whatsapp-link" title='WhatsApp'
                    style="--delay: 0.15s" target="_blank" rel="noopener" noreferrer>
                    <i class="ri-whatsapp-line"></i>
                </a>
            @endif


        </div>

    </nav>

    <div class="cookie-banner">
        <div class="">
            <img class="cookie-icon" src="{{asset('front/assets/icons/cookie.png')}}" />
            <p>
                We serve cookies on this site to analyze traffic, remember your preferences, and optimize your
                experience.
            </p>
        </div>

        <div class="mt-3">
            <a href="https://policies.google.com/technologies/cookies" target="_blank" rel="noopener" noreferrer
                class="site-btn">LEARN MORE</a>
            <button class="site-btn cookie-btn">OK</button>
        </div>
    </div>

    @include('front.components.header')

    <div class="social-media-fixed">
        <ul class="list-unstyled social-list">
            @foreach ($socials as $social)
                    <li>
                        <a href="{{ $social->link }}" title="{{ $social->link }}">
                            <i class="{{ $social->icon }}"></i>
                        </a>
                    </li>
            @endforeach
            <li class="line"></li>
            <li class="txt">{{__('main.follow_us')}}</li>
        </ul>
    </div>
    <!-- START HEADER -->
    <!-- END HEADER -->

    @yield('breadcrumb')
    <!-- START PAGE WRAPPER -->
    <main class="main-content">
        @yield('content')
    </main>
    <!-- START DISCOVER -->
    <!-- END DISCOVER -->
    @include('front.components.footer')
    <!-- SELL MODAL -->
    <div class="modal fade" id="sell-area" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{__('main.sell_your_unit')}}!</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form  id="sell-from" data-parsley-validate>
                @csrf
                <div class="row align-items-end">
                  <div class="col-md-4">
                    <div class="mb-3">
                      <input type="text" name="compound" class="form-control" inputmode="text" placeholder="{{__('inventory::inventory.please_enter_the_compound')}}">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="mb-3">
                      <input type="text" class="form-control" inputmode="text" name="unit_name"
                      placeholder="{{ __('inventory::inventory.unit_name') }}" required
                      data-parsley-required
                      data-parsley-required-message="{{ __('main.please_enter_your_unit_name') }}"
                      data-parsley-trigger="change focusout">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="custom-file-input mb-3">
                      <label for="unit-imgs" class="form-label" >
                        <i class="ri-camera-line"></i>
                        {{__('inventory::inventory.unit_attachments')}}
                      </label>
                      <input class="form-control" type="file" id="unit-imgs" name="attachments[]" multiple required
                      data-parsley-required
                      data-parsley-required-message="{{ __('main.please_enter_your_attachments') }}"
                      data-parsley-trigger="change focusout"
                      data-parsley-errors-container="#attachments_error_container">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <select class="form-select dd-select" name="i_purpose_id"
                      placeholder="{{ __('inventory::inventory.purposes') }}"
                      onchange="getPurposePurposeTypesRequest([$(this).val()], 'sell-from')">
                        <option></option>
                        @foreach ($purposes as $purpose)
                            <option value="{{ $purpose->id }}">{{ $purpose->purpose }}
                            </option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <select class="form-select dd-select" name="i_purpose_type_id"
                        placeholder="{{ __('inventory::inventory.purpose_types') }}"
                        id="i_purpose_type_id_sell">
                        <option>
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="mb-3">
                      <input type="text" class="form-control" inputmode="text" name="name"
                      placeholder="{{ __('inventory::inventory.name') }}" required
                      data-parsley-required
                      data-parsley-required-message="{{ __('main.please_enter_your_name') }}"
                      data-parsley-trigger="change focusout">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="mb-3">
                      <input type="email" class="form-control" inputmode="email" name="email"
                      placeholder="{{ __('inventory::inventory.email') }}">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="mb-3">
                      <input type="text" class="form-control phone-input" inputmode="tel" name="phone"
                      placeholder="{{ __('inventory::inventory.phone') }}" required
                      data-parsley-required
                      data-parsley-required-message="{{ __('main.please_enter_your_mobile_number') }}"
                      data-parsley-trigger="change focusout">
                    </div>
                  </div>
                </div>
    
                <div class="col-12">
                  <div class="mb-3">
                    <textarea class="form-control" inputmode="text" name="comments" id="" rows="4"
                    placeholder="{{ __('inventory::inventory.comments') }}"></textarea>
                  </div>
                </div>
    
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="site-btn submit-sell-request">{{ __('main.send') }}</button>
            </div>
          </div>
        </div>
      </div>
    @if (Route::currentRouteName() == 'front.home')

        <div class="modal fade filter-modal" id="filter-modal" tabindex="-1">
            <div class="dynamic-bg"></div>
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <svg width="25" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="search-box">
                        <h3 class="search-title">
                            <bdi>{{ __('main.compare') }} +
                                <span class="counter" data-min="1" data-max="{{ $units_count }}" data-delay="1"
                                    data-increment="1">{{ $units_count }}</span>
                                {{ __('main.homes_and') }} +
                                <span class="counter" data-min="1" data-max="{{ $projects_count }}"
                                    data-delay="1" data-increment="1">{{ $projects_count }}</span>
                                {{ __('main.projects') }}
                            </bdi>
                        </h3>

                        <ul class="nav nav-tabs">
                            @if (request('offering_types'))
                                @foreach ($offering_types as $offering_type)
                                    @if ($offering_type->is_searchable)
                                        @if (in_array($offering_type->id, request('offering_types')))
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#filter-form"
                                                    data-id="{{ $offering_type->id }}"
                                                    onclick="setOfferingType({{ $offering_type->id }},'filter-form')">{{ $offering_type->offering_type }}</a>
                                            </li>
                                        @else
                                            @if ($offering_type->is_searchable)
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#filter-form"
                                                        data-id="{{ $offering_type->id }}"
                                                        onclick="setOfferingType({{ $offering_type->id }},'filter-form')">{{ $offering_type->offering_type }}</a>
                                                </li>
                                            @endif
                                        @endif
                                    @endif
                                @endforeach
                            @else
                                @foreach ($offering_types as $offering_type)
                                    <li class="nav-item">
                                        <a class="nav-link @if ($loop->index == 0) active @endif"
                                            data-toggle="tab" href="#filter-form"
                                            data-id="{{ $offering_type->id }}"
                                            onclick="setOfferingType({{ $offering_type->id }},'filter-form')">{{ $offering_type->offering_type }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                        <div class="tab-content mt-3">
                            <div class="tab-pane fade show active" id="filter-form">
                                @include('front.components.search-box', [
                                    'url' => route('front.properties'),
                                    'form_id' => 'filter-form',
                                    'purposeDiv' => 'filter-purpose-div',
                                    'purpose_type' => 'filter-purpose-type-div',
                                    'regionDiv' => 'region-fiter-div',
                                    'city' => 'city-filter-div',
                                ])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endif
    <!-- CAREER FORM MODAL -->
    @if (Route::currentRouteName() == 'front.careers')
        <div class="modal fade" id="apply-career-modal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title job-title-header" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <svg width="25" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="career-form mt-4">
                            <form action="#" enctype="multipart/form-data" id="apply-form" data-parsley-validate>
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control career-id-hidden"
                                                name="career_id" value="" placeholder="Job Title">
                                            <input type="text" class="form-control job-title" disabled
                                                placeholder="Job Title">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="full_name"
                                                placeholder="{{ __('users.full_name') }}"
                                                data-parsley-trigger="change focusout" required data-parsley-required
                                                data-parsley-required-message="{{ __('main.please_enter_your_name') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="email"
                                                placeholder="{{ __('users.email') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="phone"
                                                placeholder="{{ __('users.mobile_number') }}"
                                                data-parsley-trigger="change focusout" required data-parsley-required
                                                data-parsley-required-message="{{ __('main.please_enter_your_mobile_number') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="address"
                                                placeholder="{{ __('inventory::inventory.address') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="years_of_experience"
                                                placeholder="{{ __('main.years_of_experience') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mt-2">
                                            <div class="d-inline-block mr-3">
                                                <input id='male' type="radio" name='gender'>
                                                <label for="male">{{ __('users.male') }}</label>
                                            </div>
                                            <div class="d-inline-block">
                                                <input id='female' type="radio" name='gender'>
                                                <label for="female">{{ __('users.female') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <textarea name="message" id="" rows="5" class="form-control"
                                            placeholder="{{ __('contactus::contact_us.message') }}"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mt-3">
                                            <label for="custom-file"
                                                class="upload">{{ __('main.cv_upload') }}</label>
                                            <input type="file" name="attachment" id='custom-file'
                                                data-parsley-trigger="change focusout" required data-parsley-required
                                                data-parsley-required-message="{{ __('main.please_upload_your_cv') }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="button" class="submit site-btn mt-0 apply-from">
                                            <span class="txt">{{ __('careers::career.apply') }}</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

      <!-- Contact Modal -->
  <div class="contact-modal modal fade" id="contact-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('contact_us.contact_us.store') }}" method="POST" class="form-contact"
            data-parsley-validate>
            @csrf
            <input type="hidden" name="link" value="{{ Request::url() }}">
            <input type="hidden" name="type" value="set_a_visit">
            <input type="hidden" name="position" value="{{ isset($position) ? $position : null }}">
            <input type="hidden" name="city_id" value="{{ isset($city_id) ? $city_id : null }}">
            <input type="hidden" name="model_name" value="{{ isset($model_name) ? $model_name : null }}">
            <div class="form-floating mb-1">
              <input type="text" class="form-control" inputmode="text" name="full_name" placeholder="{{ __('users.full_name') }}"
              data-parsley-trigger="change focusout" required
              data-parsley-required-message="{{ __('main.please_enter_your_name') }}">
              <label class="contact-label">{{ __('users.full_name') }}</label>
            </div>
            <div class="form-floating mb-1">
              <input type="email" class="form-control" inputmode="email" name="email" placeholder="{{ __('users.email') }}" required
              data-parsley-required-message="{{ __('main.please_enter_your_email') }}">
              <label class="contact-label">{{ __('users.email') }}</label>
            </div>
            <div class="form-floating mb-1">
              <input type="text" class="form-control" inputmode="tel" placeholder="{{ __('users.mobile_number') }}"
              name="phone" data-parsley-trigger="change focusout" required
              data-parsley-required-message="{{ __('main.please_enter_your_mobile_number') }}">
              <label class="contact-label">{{ __('users.mobile_number') }}</label>
            </div>
            <div class="form-floating">
              <textarea class="form-control" inputmode="text" placeholder="{{ __('contactus::contact_us.message') }}"
              name="message" data-parsley-trigger="change focusout"></textarea>
              <label class="contact-label">{{ __('contactus::contact_us.message') }}</label>
            </div>
            <div class="mt-2  modal-footer">
              <button type="submit" class="site-btn contact-from">{{ __('main.send') }}</button>
            </div>
          </form>
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="site-btn contact-from">{{ __('main.send') }}</button>
        </div> --}}
      </div>
    </div>
  </div>
    @include('front.components.footer-scripts')

</body>

</html>
