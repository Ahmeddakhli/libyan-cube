<!DOCTYPE html>
<html lang="en">

<!-- begin::Head -->

<head>
	<meta charset="utf-8" />
	<title>{{env('APP_NAME')}} | {{trans('auth.login')}}</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

	<!--begin::Web font -->
	<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
	<script>
		WebFont.load({
			google: {
				"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
			},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!--end::Web font -->
	<link rel="stylesheet" href="{{asset('8x/assets/css/addition.css')}}" />

	@if (App::getLocale() == 'ar')
	<!--RTL version:-->
	<link href="URL::asset('assets/vendors/base/vendors.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
	@else
	<!--begin::Global Theme Styles -->
	<link href="{{URL::asset('assets/vendors/base/vendors.bundle.css')}}" rel="stylesheet" type="text/css" />
	@endif


	@if (App::getLocale() == 'ar')
	<!--RTL version:-->
	<link href="{{URL::asset('assets/demo/default/base/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
	@else
	<link href="{{URL::asset('assets/demo/default/base/style.bundle.css')}}" rel="stylesheet" type="text/css" />
	@endif

	<!--end::Global Theme Styles -->
	<!-- <link rel="shortcut icon" href="{{asset('8x/assets/img/logo.svg')}}" type="image/x-icon" />
	<link rel="apple-touch-icon" href="{{asset('front/images/logo.png')}}">
	<link rel="apple-touch-icon" sizes="57x57" href="{{asset('front/images/logo.png')}}">
	<link rel="apple-touch-icon" sizes="60x60" href="{{asset('front/images/logo.png')}}">
	<link rel="apple-touch-icon" sizes="72x72" href="{{asset('front/images/logo.png')}}">
	<link rel="apple-touch-icon" sizes="76x76" href="{{asset('front/images/logo.png')}}">
	<link rel="apple-touch-icon" sizes="114x114" href="{{asset('front/images/logo.png')}}">
	<link rel="apple-touch-icon" sizes="120x120" href="{{asset('front/images/logo.png')}}">
	<link rel="apple-touch-icon" sizes="144x144" href="{{asset('front/images/logo.png')}}">
	<link rel="apple-touch-icon" sizes="152x152" href="{{asset('front/images/logo.png')}}">
	<link rel="apple-touch-icon" sizes="180x180" href="{{asset('front/images/logo.png')}}">
	<link rel="icon" type="image/png" sizes="192x192" href="{{asset('front/images/logo.png')}}')}}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{asset('front/images/logo.png')}}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{asset('front/images/logo.png')}}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{asset('front/images/logo.png')}}"> -->
	<style>
		/* width */
		::-webkit-scrollbar {
			width: 8px
		}

		/* Track */
		::-webkit-scrollbar-track {
			background: #d8d8d8
		}

		/* Handle */
		::-webkit-scrollbar-thumb {
			border-radius: 4px;
			background: #c1c1c1;
		}

		/* Handle on hover */
		::-webkit-scrollbar-thumb:hover {
			background: #a7a5a5;
		}
	</style>
	<link rel="icon" href="{{URL::asset('front/favicon.ico')}}">

	<!-- Favicon -->
	<!-- <link rel="shortcut icon" href="{{asset('8x/assets/img/favicon.ico')}}" type="image/x-icon" />
		<link rel="apple-touch-icon" href="{{asset('8x/assets/img/apple-icon-57x57.png')}}">
		<link rel="apple-touch-icon" sizes="57x57" href="{{asset('8x/assets/img/apple-icon-57x57.png')}}">
		<link rel="apple-touch-icon" sizes="60x60" href="{{asset('8x/assets/img/apple-icon-60x60.png')}}">
		<link rel="apple-touch-icon" sizes="72x72" href="{{asset('8x/assets/img/apple-icon-72x72.png')}}">
		<link rel="apple-touch-icon" sizes="76x76" href="{{asset('8x/assets/img/apple-icon-76x76.png')}}">
		<link rel="apple-touch-icon" sizes="114x114" href="{{asset('8x/assets/img/apple-icon-114x114.png')}}">
		<link rel="apple-touch-icon" sizes="120x120" href="{{asset('8x/assets/img/apple-icon-120x120.png')}}">
		<link rel="apple-touch-icon" sizes="144x144" href="{{asset('8x/assets/img/apple-icon-144x144.png')}}">
		<link rel="apple-touch-icon" sizes="152x152" href="{{asset('8x/assets/img/apple-icon-152x152.png')}}">
		<link rel="apple-touch-icon" sizes="180x180" href="{{asset('8x/assets/img/apple-icon-180x180.png')}}">
		<link rel="icon" type="image/png" sizes="192x192"  href="{{asset('8x/assets/img/android-icon-192x192.png')}}">
		<link rel="icon" type="image/png" sizes="32x32" href="{{asset('8x/assets/img/favicon-32x32.png')}}">
		<link rel="icon" type="image/png" sizes="96x96" href="{{asset('8x/assets/img/favicon-96x96.png')}}">
		<link rel="icon" type="image/png" sizes="16x16" href="{{asset('8x/assets/img/favicon-16x16.png')}}"> -->
	<!-- <link rel="manifest" href="{{asset('8x/assets/img/manifest.json')}}"> -->
	<meta name="msapplication-TileColor" content="#ffffff">
	<!-- <meta name="msapplication-TileImage" content="{{asset('8x/assets/img/ms-icon-144x144.png')}}"> -->
	<meta name="theme-color" content="#ffffff">
</head>

<!-- end::Head -->

<!-- begin::Body -->

<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

	<!-- begin:: Page -->
	<div class="m-grid m-grid--hor m-grid--root m-page">
		<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-2" id="m_login" style="background-color: #d2d2d2 ;">
			<div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
				<div class="m-login__container">
					<div class="m-login__logo" style="margin-bottom:2.5rem">
						<a href="#">
							<img src="{{URL::asset('front/images/logo.png')}}" style="width:60%">
						</a>
					</div>
					<div class="m-login__signin">
						<div class="m-login__head">
							<h3 class="m-login__title" style="color:white">{{trans('auth.sign_in')}}</h3>
						</div>
						<form class="m-login__form m-form" style="margin-top:2.5rem" method="POST" id="login_form" action="{{ route('login') }}">
							{{csrf_field()}}
							<input type="hidden" name="timezone" id="timezone">
							<div class="form-group m-form__group">
								<input class="form-control m-input" type="text" value="{{ old('email') }}" placeholder="{{trans('auth.email')}}" name="email" autocomplete="off" id="email">
								@if ($errors->has('email'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('email') }}</strong>
								</span>
								@endif
							</div>
							<div class="form-group m-form__group">
								<input class="form-control m-input m-login__form-input--last" type="password" placeholder="{{trans('auth.password')}}" name="password" id="password">
								@if ($errors->has('password'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('password') }}</strong>
								</span>
								@endif
							</div>
							<div class="row m-login__form-sub">
								<div class="col m--align-left m-login__form-left">
									<label style="color:white" class="m-checkbox  m-checkbox--light">
										<input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> {{trans('auth.remember_me')}}
										<span></span>
									</label>
								</div>
								<div class="col m--align-right m-login__form-right">
									<a href="javascript:;" style="color:white" id="m_login_forget_password" class="m-link">{{trans('auth.forget_password')}} ?</a>
								</div>
							</div>
							<div class="m-login__form-action" style="margin-top:1rem">
								<button id="m_login_signin_submit" class="btn btn-light m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn">{{trans('auth.sign_in')}}</button>
							</div>
						</form>
					</div>
					{{--
						<div class="m-login__signup">
							<div class="m-login__head">
								<h3 class="m-login__title">Sign Up</h3>
								<div class="m-login__desc">Enter your details to create your account:</div>
							</div>
							<form class="m-login__form m-form" action="">
								{{csrf_field()}}
					<div class="form-group m-form__group">
						<input class="form-control m-input" type="text" placeholder="Fullname" name="fullname">
					</div>
					<div class="form-group m-form__group">
						<input class="form-control m-input" type="text" placeholder="Email" name="email" autocomplete="off">
					</div>
					<div class="form-group m-form__group">
						<input class="form-control m-input" type="password" placeholder="Password" name="password">
					</div>
					<div class="form-group m-form__group">
						<input class="form-control m-input m-login__form-input--last" type="password" placeholder="Confirm Password" name="rpassword">
					</div>
					<div class="row form-group m-form__group m-login__form-sub">
						<div class="col m--align-left">
							<label class="m-checkbox m-checkbox--light">
								<input type="checkbox" name="agree">I Agree the <a href="#" class="m-link m-link--focus">terms and conditions</a>.
								<span></span>
							</label>
							<span class="m-form__help"></span>
						</div>
					</div>
					<div class="m-login__form-action">
						<button id="m_login_signup_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn">Sign Up</button>&nbsp;&nbsp;
						<button id="m_login_signup_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom m-login__btn">Cancel</button>
					</div>
					</form>
				</div>
				--}}
				<div class="m-login__forget-password">
					<div class="m-login__head">
						<h3 class="m-login__title" style="color:white">{{trans('auth.forgotten_password')}} ?</h3>
						<div class="m-login__desc" style="color:white">{{trans('auth.enter_your_email_to_reset_your_password')}}:</div>
					</div>
					<!-- <form class="m-login__form m-form" method="POST" action="{{ route('password.email') }}">
								@csrf
								<div class="form-group m-form__group">
									<input class="form-control m-input" type="text" placeholder="{{trans('auth.email')}}" name="email" type="email" id="m_email" value="{{ old('email') }}" required autocomplete="off">
								</div>
								<div class="m-login__form-action" style="margin-top:1rem">
									<button type="submit" id="m_login_forget_password_submit" class="btn btn-light m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">{{trans('auth.request')}}</button>&nbsp;&nbsp;
									<button id="m_login_forget_password_cancel" class="btn btn-outline-light m-btn m-btn--pill m-btn--custom  m-login__btn">{{trans('auth.cancel')}}</button>
								</div>
							</form> -->
				</div>
				{{--
						<div class="m-login__account">
							<span class="m-login__account-msg">
								Don't have an account yet ?
							</span>&nbsp;&nbsp;
							<a href="javascript:;" id="m_login_signup" class="m-link m-link--light m-login__account-link">Sign Up</a>
						</div>
						--}}
				<div style="color:white;margin-bottom:2rem" class="m-login__logo">
					Powered by <a href="https://www.8worx.com" style="color:white;font-weight:600" target="_blank">8WORX</a>
				</div>
			</div>
		</div>
	</div>
	</div>

	<!-- end:: Page -->

	<!--begin::Global Theme Bundle -->
	<script src="{{URL::asset('assets/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('assets/demo/default/base/scripts.bundle.js')}}" type="text/javascript"></script>

	<!--end::Global Theme Bundle -->

	<!-- Laravel Javascript Validation -->
	<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

	<!--begin::Page Scripts -->
	<script src="{{URL::asset('assets/snippets/custom/pages/user/login.js')}}" type="text/javascript"></script>
	@if (Request::routeIs('password.request'))
	<script>
		var login = $('#m_login');
		var displayForgetPasswordForm = function() {
			login.removeClass('m-login--signin');
			login.removeClass('m-login--signup');

			login.addClass('m-login--forget-password');
			//login.find('.m-login__forget-password').animateClass('flipInX animated');
			mUtil.animateClass(login.find('.m-login__forget-password')[0], 'flipInX animated');

		}
		$(document).ready(function() {
			displayForgetPasswordForm();
		});
	</script>
	@endif
	<!--end::Page Scripts -->

	<script>
		$(document).ready(function() {
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
		});
	</script>
	<script>
		window.Laravel = {
			!!json_encode([
				'csrfToken' => csrf_token(),
			]) !!
		};
	</script>
	<script src="{{asset('8x/assets/vendors/general/moment/min/moment.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('8x/assets/vendors/general/moment/min/moment-timezone.min.js')}}" type="text/javascript"></script>
	<script>
		$('#timezone').val(moment.tz.guess());
	</script>
</body>

<!-- end::Body -->

</html>