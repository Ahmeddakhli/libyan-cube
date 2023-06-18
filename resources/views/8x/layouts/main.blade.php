<!DOCTYPE html>

@if(LaravelLocalization::getCurrentLocale() == 'ar')
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" direction="rtl" dir="rtl" style="direction: rtl" >
@else
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endif
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>@yield('title') | {{env('APP_NAME')}}</title>
		<meta name="description" content="@yield('page_description')">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		@include('8x.inc.header-scripts')
		@stack('header-scripts')
	</head>
	<!-- end::Head -->


	<!-- begin::Body -->
	<body class="kt-page--loading-enabled kt-page--loading kt-page--fixed kt-header--fixed-off kt-header--minimize-topbar kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading">

		<!-- begin::Page loader -->

		<!-- end::Page Loader -->

		<!-- begin:: Page -->

		<!-- begin:: Header Mobile -->
	<!-- begin:: Header Mobile -->
	<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
			<div class="kt-header-mobile__logo">
				<a href="{{route('home')}}" style="width:100px;">
					<img alt="Logo" class="w-100" src="{{asset('/front/images/logo.png')}}" />
				</a>
			</div>
			<div class="kt-header-mobile__toolbar">
				<button class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
				<!-- <button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button> -->
				<button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
			</div>
		</div>

		<!-- end:: Header Mobile -->
		<!-- end:: Header Mobile -->
		<div class="kt-grid kt-grid--hor kt-grid--root">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
					<!-- begin:: Header -->
					<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed" data-ktheader-minimize="on">
						<div class="kt-header__top">
							<div class="kt-container">

								<!-- begin:: Brand -->
								<div class="kt-header__brand kt-grid__item" id="kt_header_brand">
									@include('8x.inc.header-brand-logo')
									@include('8x.inc.header-brand-menu')
									@include('8x.inc.header-menu')
								</div>
								<!-- end:: Brand -->

								<!-- begin:: Header Topbar -->
								<div class="kt-header__topbar">
									@stack('header-user-actions-first')
									@include('8x.inc.header-search')
									@include('8x.inc.header-quick-actions')
									@stack('header-user-actions-last')
                                    <div id="app" class="kt-margin-r-5">
										@include('8x.inc.header-notifications')
									</div>
									@include('8x.inc.header-duplicate')
									@include('8x.inc.header-settings-link')

									@include('8x.inc.header-language-switcher')
									{{--
										@include('8x.inc.header-mobile-search')
										@include('8x.inc.header-quick-panel')
									--}}
									@include('8x.inc.header-user-bar')
								</div>

								<!-- end:: Header Topbar -->
							</div>
						</div>
					</div>

					<!-- end:: Header -->

                    @yield('contents')
					<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-grid--stretch">
					@include('8x.inc.header-left-bar')

						<div class="kt-container kt-body  kt-grid kt-grid--ver" id="kt_body">
							@yield('content')
						</div>
					</div>

					@include('8x.inc.footer')
				</div>
			</div>
		</div>
		<!-- end:: Page -->
		@include('8x.inc.quick-panel')

		<!-- begin::Scrolltop -->
		<div id="kt_scrolltop" class="kt-scrolltop"><i class="fa fa-arrow-up"></i></div>
		<!-- end::Scrolltop -->

		<!-- begin::Demo Panel -->
		<div id="kt_demo_panel" class="kt-demo-panel">
			<div class="kt-demo-panel__head">
				<h3 class="kt-demo-panel__title">
					Select A Demo

					<!--<small>5</small>-->
				</h3>
				<a href="#" class="kt-demo-panel__close" id="kt_demo_panel_close"><i class="flaticon2-delete"></i></a>
			</div>

		</div>
		<!-- end::Demo Panel -->

		@include('8x.inc.footer-scripts')
		@include('8x.inc.global-modals')
		@stack('footer-scripts')

        <script src="{{ asset('js/app.js?ver='.env('FILES_VER')) }}" defer></script>
	</body>

	<!-- end::Body -->
</html>
