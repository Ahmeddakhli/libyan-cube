<!--begin::Fonts -->
<script src="{{asset('https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js')}}"></script>
<script>
    WebFont.load({
        google: {
            "families": ["Poppins:300,400,500,600,700"]
        },
        active: function() {
            sessionStorage.fonts = true;
        }
    });
</script>
<!--end::Fonts -->

<script>
    window.Laravel = {!! json_encode([
        'user' => Auth::user(),
        'csrfToken' => csrf_token(),
        'notification_base' => '/advisors',
        'vapidPublicKey' => config('webpush.vapid.public_key'),
        'pusher' => [
            'key' => config('broadcasting.connections.pusher.key'),
            'cluster' => config('broadcasting.connections.pusher.options.cluster'),
        ],
        'baseUrl' => url('/'),
        'host' => request()->getHttpHost()
    ]) !!};
</script>

<!--begin::Page Vendors Styles(used by this page) -->
<link href="{{asset('8x/assets/vendors/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
<!--end::Page Vendors Styles -->

<!--begin:: Global Mandatory Vendors -->
<link href="{{asset('8x/assets/vendors/general/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" type="text/css" />
<!--end:: Global Mandatory Vendors -->

<!--begin:: Global Optional Vendors -->
<link href="{{asset('8x/assets/vendors/general/tether/dist/css/tether.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('8x/assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('8x/assets/vendors/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('8x/assets/vendors/general/bootstrap-timepicker/css/bootstrap-timepicker.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('8x/assets/vendors/general/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('8x/assets/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('8x/assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('8x/assets/vendors/general/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('8x/assets/vendors/general/select2/dist/css/select2.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('8x/assets/vendors/general/ion-rangeslider/css/ion.rangeSlider.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('8x/assets/vendors/general/nouislider/distribute/nouislider.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('8x/assets/vendors/general/owl.carousel/dist/assets/owl.carousel.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('8x/assets/vendors/general/owl.carousel/dist/assets/owl.theme.default.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('8x/assets/vendors/general/dropzone/dist/dropzone.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('8x/assets/vendors/general/summernote/dist/summernote.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('8x/assets/vendors/general/bootstrap-markdown/css/bootstrap-markdown.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('8x/assets/vendors/general/animate.css/animate.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('8x/assets/vendors/general/toastr/build/toastr.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('8x/assets/vendors/general/morris.js/morris.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('8x/assets/vendors/general/sweetalert2/dist/sweetalert2.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('8x/assets/vendors/general/socicon/css/socicon.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('8x/assets/vendors/custom/vendors/line-awesome/css/line-awesome.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('8x/assets/vendors/custom/vendors/flaticon/flaticon.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('8x/assets/vendors/custom/vendors/flaticon2/flaticon.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('8x/assets/vendors/custom/vendors/fontawesome5/css/all.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('8x/assets/vendors/general/jquery.8x-editable/css/jquery.8x-editable.css')}}" rel="stylesheet" type="text/css" />
<!--end:: Global Optional Vendors -->

<link href="{{asset('8x/assets/vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />

<!--begin::8WORX Styles(used by all pages) -->
<link rel="stylesheet" href="{{asset('8x/assets/css/addition.css')}}" />
<link rel="stylesheet" href="{{asset('8x/assets/css/parsley.css')}}" />
<link rel="stylesheet" href="{{asset('8x/assets/css/8worx.css?ver='.env('FILES_VER'))}}" />
<link rel="stylesheet" href="{{asset('8x/assets/css/jstree.min.css')}}" />
<link rel="stylesheet" href="{{asset('8x/assets/css/animate.min.css')}}" />
<!--end::8WORX Styles(used by all pages)-->

<link rel="stylesheet" href="{{asset('8x/assets/css/bootstrap-tagsinput.css')}}" />
<link rel="stylesheet" href="{{asset('8x/assets/packages/bootstrapValidator/css/bootstrapValidator.css')}}" />
<link rel="stylesheet" href="{{asset('8x/assets/css/upload_button.css')}}" />
<link rel="stylesheet" href="{{asset('8x/assets/css/html5lightbox.css')}}" />

<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">

<style>
    .bootstrap-tagsinput {
      width: 100% !important;
    }
</style>

<!--begin::Global Theme Styles(used by all pages) -->
<link href="{{asset('8x/assets/demo/demo2/base/style.bundle.css')}}" rel="stylesheet" type="text/css" />
<!--end::Global Theme Styles -->

@if(LaravelLocalization::getCurrentLocale() == 'ar')
setLocale(LC_TIME, 'ar');
<!--begin::Global RTL) -->
<link href="{{asset('8x/assets/demo/default/base/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('8x/assets/css/8worx-rtl.css?ver='.env('FILES_VER'))}}" rel="stylesheet" type="text/css" />
<link href="{{asset('8x/assets/vendors/custom/datatables/datatables.bundle.rtl.min.css')}}" rel="stylesheet" type="text/css" />
<!--end::Global RTL) -->
@endif

<!--begin::Layout Skins(used by all pages) -->

<!--end::Layout Skins -->

<!-- Favicon -->
<link rel="icon" href="{{URL::asset('front/favicon.ico')}}">

<!-- TOKEN -->
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/3.2.0/css/fontawesome-iconpicker.min.css">
<!-- Hotjar Tracking Code for www.8worxcrm.com -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:1578042,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>

<script>
    var globalForceGet = false;
    var app_name = "{!! env('APP_NAME') !!}";
</script>

<link href="{{asset('8x/assets/packages/summernote-0.8.18-dist/summernote.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://webobook.com/css/evovr.css">
<link rel="stylesheet" href="https://webobook.com/css/evovr-preview.css">
@include('8x.inc.js-trans')
@include('8x.inc.js-objects')
