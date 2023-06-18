{{--
@push('header-menu-hidden-first')
    @if (auth()->user()->hasPermission('index-tags') || auth()->user()->hasPermission('create-tag'))
        <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="fa fa-tags kt-menu__link-bullet"><span></span></i><span class="kt-menu__link-text">{{trans('left_aside.manage_tags')}}</span><i class="kt-menu__hor-arrow la la-angle-right"></i></a>
            <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                <ul class="kt-menu__subnav">
                    @haspermission('index-tags')
                        <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('tags.index')}}" data-8xload class="kt-menu__link "><span class="kt-menu__link-text">{{trans('left_aside.tags_list')}}</span></a></li>
                    @endhaspermission
                    @haspermission('create-tag')
                        <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('tags.create')}}" data-8xload class="kt-menu__link "><span class="kt-menu__link-text">{{trans('left_aside.create_tag')}}</span></a></li>
                    @endhaspermission
                </ul>
            </div>
        </li>
    @endif
@endpush
--}}