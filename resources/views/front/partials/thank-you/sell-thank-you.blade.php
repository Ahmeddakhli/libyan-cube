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
                <p class="w-md-50 w-100">
                    <bdi>
                        @if (App::getLocale() == 'en')
                            Thank you "{{ $name }}" for trusting advisors Properties Group, One of our resale
                            department will contact you very soon to complete your property information.
                        @else
                            شكرًا لك "{{ $name }}" على ثقتك في انلاند بروبيرتز، سيتصل بك أحد مستشارينا لقسم
                            إعادة البيع قريبًا ، لاستكمال معلومات الوحدة المعروضة للبيع.
                        @endif
                    </bdi>
                </p>

            </div>
        </div>
    </section>
    <!-- END blogs-page  -->
