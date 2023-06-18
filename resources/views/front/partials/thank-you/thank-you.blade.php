    <!-- START BREADCRUMB -->
    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('front.home') }}">{{ __('main.home_title') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('main.thank_you') }}</li>
            </ol>
        </div>
    </nav>
    <!-- END BREADCRUMB -->

    <!-- START blogs-page  -->
    <section class="thank-page pt-3 pb-5">
        <div class="container">
            <div class="check text-center mb-2">
                <img src="{{ URL::asset('front/images/check.png') }}" alt="right">
            </div>
            <div class="section-title">
                <h1 class="title">{{ __('main.thank_you') }} ({{ $name }})
                    {{ __('main.for_your_intrest') }} @if ($projects) {!! $model_name !!} @endif @if ($units) {!! $model_name !!} @endif</h1>
                <p class="w-md-50 w-100">
                    @if (App::getLocale() == 'en')
                        @if ($setting->thank_you_message_en)
                            {!! str_replace('$model_name', $model_name, preg_replace('#<a.*?>.*?</a>#i', '',$setting->thank_you_message_en)) !!}
                        @endif
                    @else
                        @if ($setting->thank_you_message_ar)
                            {!! str_replace('$model_name', $model_name, preg_replace('#<a.*?>.*?</a>#i', '', $setting->thank_you_message_ar)) !!}
                        @endif
                    @endif
                </p>

            </div>

            @if ($projects)
                @if (count($projects))
                    <div class="related-units mt-5">
                        <div class="section-title text-center">
                            <h2 class="title">{{ __('main.related_projects') }}</h2>
                        </div>
                        <div class="related-wrapper">
                            <div class="controllers">
                                <div class="line"></div>
                                <div class="swiper-button-next proj-next-btn">
                                    <svg viewBox="0 0 124 246" fill="none" xmlns="https://www.w3.org/2000/svg">
                                        <path
                                            d="M5.95119 240.464C4.0613 242.354 0.829872 241.015 0.829872 238.342V7.65768C0.829872 4.98497 4.0613 3.64647 5.9512 5.53636L121.294 120.879C122.465 122.05 122.465 123.95 121.294 125.121L5.95119 240.464Z"
                                            fill="#1D2033" />
                                    </svg>
                                </div>
                                <div class="swiper-button-prev proj-prev-btn">
                                    <svg viewBox="0 0 124 246" fill="none" xmlns="https://www.w3.org/2000/svg">
                                        <path
                                            d="M118.294 240.464C120.184 242.354 123.415 241.015 123.415 238.342V7.65768C123.415 4.98497 120.184 3.64647 118.294 5.53636L2.95122 120.879C1.77964 122.05 1.77964 123.95 2.95122 125.121L118.294 240.464Z"
                                            fill="#1D2033" />
                                    </svg>
                                </div>
                                <div class="line"></div>
                            </div>
                            <div class="swiper projects-slider">
                                <div class="swiper-wrapper">
                                    @foreach ($projects as $project)
                                        <div class="swiper-slide">
                                            @include('front.components.project',['project' =>$project ])
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
            {{-- @if ($units)
        @if (count($units))
        <div class="related-units mt-5">
          <div class="section-title text-center">
            <h2 class="title">{{__('main.related_units')}}</h2>
          </div>
          <div class="related-wrapper">
            <div class="controllers">
              <div class="line"></div>
              <div class="swiper-button-next units-next-btn">
                <svg viewBox="0 0 124 246" fill="none" xmlns="https://www.w3.org/2000/svg">
                  <path d="M5.95119 240.464C4.0613 242.354 0.829872 241.015 0.829872 238.342V7.65768C0.829872 4.98497 4.0613 3.64647 5.9512 5.53636L121.294 120.879C122.465 122.05 122.465 123.95 121.294 125.121L5.95119 240.464Z" fill="#1D2033" />
                </svg>
              </div>
              <div class="swiper-button-prev units-prev-btn">
                <svg viewBox="0 0 124 246" fill="none" xmlns="https://www.w3.org/2000/svg">
                  <path d="M118.294 240.464C120.184 242.354 123.415 241.015 123.415 238.342V7.65768C123.415 4.98497 120.184 3.64647 118.294 5.53636L2.95122 120.879C1.77964 122.05 1.77964 123.95 2.95122 125.121L118.294 240.464Z" fill="#1D2033" />
                </svg>
              </div>
              <div class="line"></div>
            </div>
            <div class="swiper units-slider">
              <div class="swiper-wrapper">
                @foreach ($units as $unit)
                <div class="swiper-slide">
                  @include('front.components.unit',['unit' =>$unit ])
                </div>
                @endforeach

              </div>
            </div>
          </div>
        </div>
        @endif
        @endif --}}
        </div>
    </section>
    <!-- END blogs-page  -->
