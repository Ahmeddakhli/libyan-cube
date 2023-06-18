<div class="col-xl-4 mb-5 mb-xl-0 order-first order-xl-last">
    <div class="sidebar position-sticky">
        <div class="row">
            <div class="col-xl-12 col-sm-6">
                <div class="user-info">
                    <div class="user-img"><img src="{{URL::asset(auth()->user()->image)}}" alt="{{auth()->user()->full_name}}"></div>
                    <div class="user-name">
                        <h4 class="text-capitalize">{{auth()->user()->full_name}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-sm-6 mt-3 mt-xl-3 mt-lg-0 mt-md-0 mt-sm-0">
                <ul class="user-navigation text-capitalize">
                    <li>
                        <a href="{{route('front.profile.myunits')}}" class="{{ Route::currentRouteName() == 'front.profile.myunits' ? 'active' : '' }}">
                            <ion-icon name="grid-outline"></ion-icon>
                            {{__('main.my_units')}}
                        </a>
                    </li>
                    <li>
                        <a href="{{route('front.profile.addunit')}}" class="{{ Route::currentRouteName() == 'front.profile.addunit' ? 'active' : '' }}">
                            <ion-icon name="add-circle-outline"></ion-icon>
                            {{__('inventory::inventory.create_unit')}}
                        </a>
                    </li>
                    <li>
                        <a href="{{route('front.profile.favorites')}}" class="{{ Route::currentRouteName() == 'front.profile.favorites' ? 'active' : '' }}">
                            <ion-icon name="bookmark-outline"></ion-icon>
                            {{__('main.fav_units')}}
                        </a>
                    </li>
                    <li>
                        <a href="{{route('front.profile.info')}}" class="{{ Route::currentRouteName() == 'front.profile.info' ? 'active' : '' }}">
                            <ion-icon name="create-outline"></ion-icon>
                            {{__('users.user_info')}}
                        </a>
                    </li>
                </ul>
            </div>
        </div> <!-- ./ row -->
    </div> <!-- ./ sidebar -->
</div>