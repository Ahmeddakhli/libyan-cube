

  <script src="{{ URL::asset('front/js/jquery-3.6.0.min.js')}}?ver={{ env('FILES_VER')}}"></script>
  <script src="{{ URL::asset('front/js/bootstrap.bundle.min.js')}}?ver={{env('FILES_VER')}}"></script>
  <script src="{{ URL::asset('front/js/multiple-select.min.js')}}?ver={{env('FILES_VER')}}"></script>
  <script src="{{ URL::asset('front/js/swiper-bundle.min.js')}}?ver={{ env('FILES_VER')}}"></script>
  <script src="{{ URL::asset('front/js/intlTelInput.min.js')}}?ver={{ env('FILES_VER')}}"></script>
  <script src="{{ URL::asset('front/js/bootstrap-datetimepicker.min.js')}}?ver={{ env('FILES_VER')}}"></script>
  <script src="{{ URL::asset('front/js/bootstrap-datetimepicker.ar.js')}}?ver={{ env('FILES_VER')}}"></script>
  <script src="{{ URL::asset('front/js/magnific-popup.js')}}?ver={{ env('FILES_VER')}}"></script>
  <script src="{{ URL::asset('front/js/bootstrap-tokenfield.min.js')}}?ver={{env('FILES_VER')}}"></script>
  <script src="{{ URL::asset('front/js/typeahead.bundle.min.js')}}?ver={{env('FILES_VER')}}"></script>
  <script src="{{ URL::asset('front/js/aos.js')}}?ver={{env('FILES_VER')}}"></script>
  <script src="{{ URL::asset('front/js/numscroller.js')}}?ver={{env('FILES_VER')}}"></script>
  <script src="{{ URL::asset('front/js/jquery.nicescroll.min.js')}}?ver={{env('FILES_VER')}}"></script>
  <script src="{{ URL::asset('front/js/intlTelInput-jquery.min.js') }}?ver={{ env('FILES_VER') }}"></script>
  <script src="{{ URL::asset('front/js/app.js')}}?ver={{ env('FILES_VER')}}"></script>
  <script src="{{ URL::asset('front/js/init-plugin.js')}}?ver={{ env('FILES_VER')}}"></script>

  <!-- Aos Init -->
  <script>
    AOS.init({
      disable: "mobile",
      duration: 800,
      once: true
    });
  </script>

@if (Route::currentRouteName() == 'front.home')
<script>
    const splashScreen = document.querySelector(".splash-screen");
    const splashLogo = document.querySelector(".splash-screen img");

    setTimeout(() => {
      splashLogo.classList.add("show");
      splashScreen.classList.add("hide");
    }, 1000);
  </script> 
@endif
<script src="{{ URL::asset('8x/assets/js/parsley.min.js') }}?ver={{ env('FILES_VER') }}" type="text/javascript">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js" type="text/javascript">
</script>
<script src="{{ URL::asset('front/js/bootstrap-flash-alert.min.js') }}?ver={{ env('FILES_VER') }}"
type="text/javascript"></script>

<script>
    // var ddSelect2;
    var rtl = false;
    @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
        rtl =true;
    @endif

    var darkMood = "{{ __('main.dark_mode') }}";
    var lightMood = "{{ __('main.light_mode') }}";
</script>


@include('front.components.custom-scripts')

@if (App::environment('local'))
@else
    @include('front.components.custom-scripts-min')
@endif

@php
$contact_phones = [];
foreach ($contacts as $key => $contact) {
    if ($key == 'phone') {
        foreach ($contact as $phone) {
            array_push($contact_phones, $phone->contact);
        }
    }
}
$contact_phones = implode(', ', $contact_phones);

$contact_emails = [];
foreach ($contacts as $key => $contact) {
    if ($key == 'email') {
        foreach ($contact as $email) {
            array_push($contact_emails, $email->contact);
        }
    }
}
$contact_emails = implode(', ', $contact_emails);

$contact_address = [];
foreach ($contacts as $key => $contact) {
    if ($key == 'address') {
        foreach ($contact as $address) {
            array_push($contact_address, $address->contact);
        }
    }
}
$contact_address = implode(', ', $contact_address);

$social_urls = [];
foreach ($socials as $social) {
    array_push($social_urls, $social->link);
}
@endphp
<!-- SCHEMA JSON-LD -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "advisors Properties",
            "image":"{{ URL::asset('/front/images/logo.png') }}",
            "url": "{{ env('APP_URL_FULL') }}",
            "address": {
                "@type": "PostalAddress",
                "addressLocality": "{{ $contact_address }}",
                "postalCode": "",
                "streetAddress": ""
            },
            "telephone": "{{ $contact_phones }}",
            "faxNumber": "",
            "email": "{{ $contact_emails }}",
            "sameAs": @json($social_urls),
            "member": [{
                    "@type": "Organization"
                },
                {
                    "@type": "Organization"
                }
            ]
        }
    </script>



@stack('scripts')
