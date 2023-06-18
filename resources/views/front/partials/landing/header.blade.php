<header class='header'>
	<div class="fancy-mask"></div>
	<div class="banner-wrapper">
		<div class="container">
			<div class="row align-items-center m-0">
				<div class="col-lg-6 p-0">
					<div class="banner text-center">
						<h1 class='title text-uppercase'>
							{{-- <span class="headline" data-splitting>{{__('main.your_new_home_is')}} <strong>{{__('main.here')}}</strong></span> --}}
							<span class="headline" data-splitting>{{__('main.your_new_home_is')}} <strong>{{__('main.here')}}</strong></span>
						</h1>
						<h3 class='subtitle text-capitalize'>
							{{-- <span class='desc__inner' data-splitting>{{__('landing.join_our_special_offers_hurry_up_limited_time_offer')}}</span> --}}
							<span class='desc__inner' data-splitting>{{__('landing.join_our_special_offers_hurry_up_limited_time_offer')}}</span>
						</h3>
					</div>
				</div>
				<div class="col-lg-6 p-0">
					<div class="form-contact-wrapper">
						<div class="form-contact">
							<h2 class="text-uppercase">{{__('main.contact_us')}}</h2>
							<form action="" class="form-contact-header" data-parsley-validate>
								@csrf
								<input type="hidden" name="link" value="{{Request::url()}}">
								<div class="field hover-target">
									<input type="text" id="name" name="full_name" placeholder="{{__('contactus::contact_us.name')}}" autofocus data-parsley-trigger="change focusout" required data-parsley-required data-parsley-required-message="{{__('main.please_enter_your_name')}}" data-parsley-errors-container="#name_error_container"/>
									<label for="name">{{__('contactus::contact_us.name')}}</label>
								</div>
								<div id="name_error_container" class="error_container"></div>
								<div class="field hover-target">
									<input type="text" id="email" name="email" placeholder="{{__('contactus::contact_us.email')}}" />
									<label for="email">{{__('contactus::contact_us.email')}}</label>
								</div>
								<div class="field hover-target">
									<input type="text" id="mob" name="phone" placeholder="{{__('contactus::contact_us.phone')}}" data-parsley-trigger="change focusout" required data-parsley-required data-parsley-required-message="{{__('main.please_enter_your_mobile_number')}}" data-parsley-errors-container="#mobile_error_container" />
									<label for="email">{{__('contactus::contact_us.phone')}}</label>
								</div>
								<div id="mobile_error_container" class="error_container"></div>
								<div class="field hover-target">
									<textarea id="msg" name="message" placeholder="{{__('contactus::contact_us.message')}}" data-parsley-trigger="change focusout"></textarea>
									<label for="msg">{{__('contactus::contact_us.message')}}</label>
								</div>
								<div id="message_error_container" class="error_container"></div>
								<input class="hover-target submit" type="button" value="{{__('main.send')}}" />
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>