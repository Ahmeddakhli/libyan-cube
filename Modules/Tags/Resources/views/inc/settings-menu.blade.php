@if (auth()->user()->hasPermission('index-tags'))
    <li class="kt-nav__item">
        <a href="{{route('tags.index')}}" data-8xload-it-in-href="#loadBISettingsContent" class="kt-nav__link">
            <i class="kt-nav__link-icon fa fa-tags"></i>
            <span class="kt-nav__link-text">{{trans('left_aside.manage_tags')}}</span>
        </a>
    </li>
@endif