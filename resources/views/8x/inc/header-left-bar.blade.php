<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">
	<!-- begin:: Aside Menu -->
	<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
		<div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1">
			<ul class="kt-menu__nav ">
				<li class="kt-menu__section kt-menu__section--first">
					<h4 class="kt-menu__section-text"></h4>
					<i class="kt-menu__section-icon flaticon-more-v2"></i>
				</li>
				<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-layers"></i><span class="kt-menu__link-text">{{__('left_aside.core')}}</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
					<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
						<ul class="kt-menu__subnav">
							<li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Core</span></span></li>
							@haspermission('index-users')
								<li class="kt-menu__item" aria-haspopup="true"><a href="{{route('users.index')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{__('users.users')}}</span></a></li>
							@endhaspermission
							@haspermission('index-groups')
								<li class="kt-menu__item" aria-haspopup="true"><a href="{{route('groups.index')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{__('groups.groups')}}</span></a></li>
							@endhaspermission
						</ul>
					</div>
				</li>
				<!-- <li class="kt-menu__item " aria-haspopup="true"><a href="#" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-suitcase"></i><span class="kt-menu__link-text">Finance</span></a></li> -->
				@haspermission('index-inventory-developers')
				<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-grids"></i><span class="kt-menu__link-text">{{__('inventory::inventory.inventory')}}</span><span class="kt-menu__link-badge"></span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
					@endhaspermission

					<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
						<ul class="kt-menu__subnav">
							<li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Inventory</span><span class="kt-menu__link-badge"></span></span></li>
							@haspermission('index-inventory-developers')
							<li class="kt-menu__item " aria-haspopup="true" data-ktmenu-link-redirect="1"><a href="{{route('inventory.settings')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{__('inventory::inventory.inventory_settings')}}</span></a></li>
							@endhaspermission
							@haspermission('index-inventory-units')
							<li class="kt-menu__item " aria-haspopup="true" data-ktmenu-link-redirect="1"><a href="{{route('inventory.units.index')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{__('inventory::inventory.units')}}</span></a></li>
							@endhaspermission
							@haspermission('index-inventory-projects')
							<li class="kt-menu__item " aria-haspopup="true" data-ktmenu-link-redirect="1"><a href="{{route('inventory.projects.index')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{__('inventory::inventory.projects')}}</span></a></li>
							@endhaspermission
							@haspermission('index-inventory-sell-requests')
							<li class="kt-menu__item " aria-haspopup="true" data-ktmenu-link-redirect="1"><a href="{{route('inventory.sell_requests.index')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{__('inventory::inventory.sell_requests')}}</span></a></li>
							@endhaspermission 
							@haspermission('index-inventory-developers')
							<li class="kt-menu__item " aria-haspopup="true" data-ktmenu-link-redirect="1"><a href="{{route('inventory.developers.index')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{__('inventory::inventory.developers')}}</span></a></li>
							@endhaspermission

						</ul>
					</div>
				</li>
				@haspermission('index-blogs')
				<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-image-file"></i><span class="kt-menu__link-text">{{__('blog::blog.blogs')}}</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
					<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
						<ul class="kt-menu__subnav">
							<li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">{{__('blog::blog.blogs')}}</span></span></li>
							@haspermission('index-blogs')
							<li class="kt-menu__item " aria-haspopup="true"><a href="{{route('blogs.index')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{__('blog::blog.blogs')}}</span></a></li>
							@endhaspermission
							@haspermission('index-blog-categories')
							<li class="kt-menu__item " aria-haspopup="true"><a href="{{route('blog.categories.index')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{__('blog::blog.blog_categories')}}</span></a></li>
							@endhaspermission
						</ul>
					</div>
				</li>
				@endhaspermission
				@haspermission('index-contact-us')
				<li class="kt-menu__item " aria-haspopup="true" data-ktmenu-link-redirect="1"><a href="{{route('contact_us.contact_us.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-email-black-circular-button"></i><span class="kt-menu__link-text">{{__('contactus::contact_us.contact')}}</span></a></li>
				@endhaspermission
				{{--@haspermission('index-subscribe-mails')
				<li class="kt-menu__item " aria-haspopup="true" data-ktmenu-link-redirect="1"><a href="{{route('contact_us.subscribes.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-email-black-circular-button"></i><span class="kt-menu__link-text">{{__('contactus::contact_us.subscribes')}}</span></a></li>
				@endhaspermission--}}
				{{--@haspermission('index-events')
				<li class="kt-menu__item " aria-haspopup="true" data-ktmenu-link-redirect="1"><a href="{{route('events.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-presentation"></i><span class="kt-menu__link-text">{{__('events::event.events')}}</span></a></li>
				@endhaspermission--}}
				@haspermission('index-careers')
				<li class="kt-menu__item " aria-haspopup="true" data-ktmenu-link-redirect="1"><a href="{{route('careers.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-soft-icons-1"></i><span class="kt-menu__link-text">{{__('careers::career.careers')}}</span></a></li>
				@endhaspermission
				{{--@haspermission('index-meetings')
				<li class="kt-menu__item " aria-haspopup="true" data-ktmenu-link-redirect="1"><a href="{{route('meetings.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-layers"></i><span class="kt-menu__link-text">{{__('meetings::meeting.meeting')}}</span></a></li>
				@endhaspermission--}}
				{{--@haspermission('index-testimonials')
				<li class="kt-menu__item " aria-haspopup="true" data-ktmenu-link-redirect="1"><a href="{{route('testimonials.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-medal"></i><span class="kt-menu__link-text">{{__('testimonials::testimonial.testimonials')}}</span></a></li>
				@endhaspermission--}}
				@haspermission('index-settings-contacts')
				<li class="kt-menu__item " aria-haspopup="true" data-ktmenu-link-redirect="1"><a href="{{route('settings.settings')}}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-interface-1"></i><span class="kt-menu__link-text">{{__('settings::settings.settings')}}</span></a></li>
				@endhaspermission
				@haspermission('index-locations')
				<li class="kt-menu__item " aria-haspopup="true" data-ktmenu-link-redirect="1"><a href="{{route('locations.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-pin"></i><span class="kt-menu__link-text">{{__('locations::location.locations')}}</span></a></li>
				@endhaspermission
				@haspermission('index-tags')
				<li class="kt-menu__item " aria-haspopup="true" data-ktmenu-link-redirect="1"><a href="{{route('tags.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-add-label-button"></i><span class="kt-menu__link-text">{{__('tags::tags.tags')}}</span></a></li>
				@endhaspermission
				{{--@haspermission('index-welcome-messages')
				<li class="kt-menu__item " aria-haspopup="true" data-ktmenu-link-redirect="1"><a href="{{route('welcome_messages.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-add-label-button"></i><span class="kt-menu__link-text">{{__('welcome_messages::welcome_messages.welcome_messages')}}</span></a></li>
				@endhaspermission--}}
				{{--@haspermission('index-key-words')
				<li class="kt-menu__item " aria-haspopup="true" data-ktmenu-link-redirect="1"><a href="{{route('key_words.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-add-label-button"></i><span class="kt-menu__link-text">{{__('key_words::key_words.key_words')}}</span></a></li>
				@endhaspermission--}}
				@haspermission('index-services')
				<li class="kt-menu__item" aria-haspopup="true" data-ktmenu-link-redirect="1"><a href="{{route('services.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-add-label-button"></i><span class="kt-menu__link-text">{{__('services::services.services')}}</span></a></li>
				@endhaspermission
				<!-- <li class="kt-menu__item " aria-haspopup="true" data-ktmenu-link-redirect="1"><a href="{{route('messages.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-add-label-button"></i><span class="kt-menu__link-text">{{__('messages::message.messages')}}</span></a></li> -->
				@haspermission('index-about-sections')
				<li class="kt-menu__item " aria-haspopup="true" data-ktmenu-link-redirect="1"><a href="{{route('about.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-add-label-button"></i><span class="kt-menu__link-text">{{__('about::about.about')}}</span></a></li>
				@endhaspermission
				@haspermission('index-seo')
				<li class="kt-menu__item " aria-haspopup="true" data-ktmenu-link-redirect="1"><a href="{{route('seo.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-add-label-button"></i><span class="kt-menu__link-text">{{__('seo::seo.seo')}}</span></a></li>
				@endhaspermission
				<li class="kt-menu__item " aria-haspopup="true" data-ktmenu-link-redirect="1"><a href="{{route('attachments.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-add-label-button"></i><span class="kt-menu__link-text">{{__('seo::seo.attachments')}}</span></a></li>
			</ul>
		</div>
	</div>

	<!-- end:: Aside Menu -->
</div>

<!-- end:: Aside -->