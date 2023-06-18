
<!-- begin: Header Menu -->
<button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
<div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
    <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile ">
        <ul class="kt-menu__nav">
            <li id="header_logo_menu" class="hidden kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text"><i class="fas fa-ellipsis-v"></i></span></a>
                <div class="kt-menu__submenu  kt-menu__submenu--fixed kt-menu__submenu--left" style="width:1000px">
                    <div class="kt-menu__subnav">
                        <ul class="kt-menu__content" data-if-content-not-empty-show="#header_logo_menu">
                            @stack('header-menu-main-first')
                            @stack('header-menu-main-last')
                        </ul>
                    </div>
                </div>
            </li>
            @stack('header-menu-first')

            @stack('header-menu-last')
            <li id="header_menu_last" class="hidden kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text"><i class="fas fa-ellipsis-h"></i></span></a>
                <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
                    <ul class="kt-menu__subnav" data-if-content-not-empty-show="#header_menu_last">
                        @stack('header-menu-hidden-first')
                        @stack('header-menu-hidden-last')
                    </ul>
                </div>
            </li>
        </ul>
    </div>
    <div id="clock" class="kt-menu__link-text kt-hide">...</div>
</div>
<!-- end: Header Menu -->