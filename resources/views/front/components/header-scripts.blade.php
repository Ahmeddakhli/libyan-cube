<!-- scripts -->

<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="author" content="advisors">
<meta name="publisher" content="advisors">
<meta name="yandex-verification" content="" />
<meta name="google-site-verification" content="" />
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<link rel="canonical" href="{{ Request::fullUrl() }}">
@stack('meta')

<title>@yield('page_name')</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" />
{{--
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css"> --}}

<link rel="shortcut icon" href="{{ URL::asset('front/favicon.ico') }}">
<link rel="stylesheet" href="{{ URL::asset('front/css/bootstrap.min.css') }}?ver={{ env('FILES_VER') }}">
<link rel="stylesheet" href="{{ URL::asset('front/css/index.css') }}?ver={{ env('FILES_VER') }}">
<link rel="stylesheet" href="{{ URL::asset('front/css/addition.css') }}?ver={{ env('FILES_VER') }}">

<!-- Remix icon (LIBRARY OF ICONS) -->
<link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

<script>
  // avoid FART (Flash of inAccurate coloR Theme)
  const HtmlClass = localStorage.getItem('dark-mode') === "true" ? "dark-mode" : null;

  document.documentElement.classList.add(HtmlClass);
</script>

@if ($setting->pixel_code)
    {!! $setting->pixel_code !!}
@endif

@if ($setting->tags_manager)
    {!! $setting->tags_manager !!}
@endif
<!-- CSS Style -->
@stack('header-scripts')
