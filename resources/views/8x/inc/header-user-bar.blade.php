
<!--begin: User bar -->
<div class="kt-header__topbar-item kt-header__topbar-item--user pr-4">
    <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,10px" aria-expanded="false">
        {{--
        <span class="kt-header__topbar-welcome">{{__('main.hi')}}</span>
        <span class="kt-header__topbar-username">{{strtok(Auth::user()->full_name, ' ')}}</span>
        --}}
        <img alt="{{Auth::user()->full_name}}" src="{{asset('front/images/avatar.png')}}">

        <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
        <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold kt-hidden">8X</span>
    </div>
    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">

        <!--begin: Head -->
        <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url({{asset('8x/assets/media/misc/bg-1.jpg')}})">
            <div class="kt-user-card__avatar">
                <img alt="{{Auth::user()->full_name}}" src="{{asset('front/images/avatar.png')}}" />

                <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success kt-hidden">8X</span>
            </div>
            <div class="kt-user-card__name">
                {{Auth::user()->full_name}}
            </div>
            <div class="kt-user-card__badge kt-hidden">
                <span class="btn btn-success btn-sm btn-bold btn-font-md">23 messages</span>
            </div>
        </div>

        <!--end: Head -->

        <!--begin: Navigation -->
        <div class="kt-notification">
            <a href="{{route('users.my-profile')}}" class="kt-notification__item">
                <div class="kt-notification__item-icon">
                    <i class="fa fa-id-badge kt-font-success"></i>
                </div>
                <div class="kt-notification__item-details">
                    <div class="kt-notification__item-title kt-font-bold">{{__('users.my_profile')}}</div>
                    <div class="kt-notification__item-time">{{__('users.account_settings_and_more')}}</div>
                </div>
            </a>
            @haspermission('index-google-accounts')
            <a href="{{route('integrations.google.index')}}" data-8xload class="kt-notification__item">
                <div class="kt-notification__item-icon">
                    <i class="fab fa-google kt-font-warning"></i>
                </div>
                <div class="kt-notification__item-details">
                    <div class="kt-notification__item-title kt-font-bold">
                        {{trans('left_aside.manage_google_accounts')}}
                    </div>
                    <div class="kt-notification__item-time">
                        {{trans('left_aside.sync_google_accounts')}}
                    </div>
                </div>
            </a>
            @endhaspermission    
            {{--
            <a href="#" class="kt-notification__item">
                <div class="kt-notification__item-icon">
                    <i class="flaticon2-rocket-1 kt-font-danger"></i>
                </div>
                <div class="kt-notification__item-details">
                    <div class="kt-notification__item-title kt-font-bold">
                        My Activities
                    </div>
                    <div class="kt-notification__item-time">
                        Logs and notifications
                    </div>
                </div>
            </a>
            <a href="#" class="kt-notification__item">
                <div class="kt-notification__item-icon">
                    <i class="flaticon2-hourglass kt-font-brand"></i>
                </div>
                <div class="kt-notification__item-details">
                    <div class="kt-notification__item-title kt-font-bold">
                        My Tasks
                    </div>
                    <div class="kt-notification__item-time">
                        latest tasks and projects
                    </div>
                </div>
            </a>
            --}}
            <div class="kt-notification__custom">
                <a href="#" class="btn btn-label-brand btn-sm btn-bold" onclick="event.preventDefault(); logout();">{{__('users.logout')}}</a>
            </div>
        </div>

        <!--end: Navigation -->
    </div>
</div>
<!--end: User bar -->
<form id="logout-form" action="{{ route('logoutGetRequest') }}" method="GET" style="display: none;">
    @csrf
</form>