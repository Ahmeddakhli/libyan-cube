<!-- START discover -->
<div class="discover">
    <div class="container">
        <div class="row no-gutter align-items-baseline mt-3">
            @if(count($discover['areas']))
                <div class="col-md-4 mb-4">
                    <div class="block area-block">
                        <button class="title first-el" data-toggle="collapse" data-target="#where__list" aria-expanded="false">
                            {{__('main.where_do_we_work')}}
                            <i class="fas fa-caret-down fa-lg"></i>
                        </button>
                        <div id="where__list" class="collapse">
                            <ul class="list__items first-el">
                                @foreach($discover['areas'] as $area)
                                    <li>
                                        <i class="fas fa-angle-double-right"></i>
                                        <a href="{{route('front.areas.show',['id' => $area->id,'slug' => str_slug($area->default_value)])}}">{{$area->second_title ? $area->second_title : $area->default_second_title }} <span>({{$area->projects_count}} {{__('main.projects')}})</span></a>
                                    </li>
                                @endforeach
                                <li class="more">
                                    <a href="{{route('front.projects')}}" data-text="{{__('main.discover_more_properites')}}">{{__('main.discover_more_properities')}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
            @if(count($discover['developers']))
                <div class="col-md-4 mb-4">
                    <div class="block dev-block">
                        <button class="title" data-toggle="collapse" data-target="#devs__list" aria-expanded="false">
                            {{__('main.who_do_we_work_with')}}
                            <i class="fas fa-caret-down fa-lg"></i>
                        </button>
                        <div id="devs__list" class="collapse">
                            <ul class="list__items">
                                @foreach($discover['developers'] as $developer)
                                    <li>
                                        <i class="fas fa-angle-double-right"></i>
                                        <a href="{{route('front.developers.show',['id' => $developer->id,'slug' => str_slug($developer->default_value)])}}">{{$developer->value ? $developer->value : $developer->default_value}} <span>({{$developer->projects_count}} {{__('main.projects')}})</span></a>
                                    </li>
                                @endforeach
                                <li class="more">
                                    <a href="{{route('front.developers')}}" data-text="{{__('main.discover_more_developers')}}">{{__('main.discover_more_developers')}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
            @if(count($discover['projects']))
                <div class="col-md-4 mb-4">
                    <div class="block projects-block">
                        <button class="title last-el" data-toggle="collapse" data-target="#projects__list" aria-expanded="false">
                            {{__('main.what_do_we_offer')}}
                            <i class="fas fa-caret-down fa-lg"></i>
                        </button>
                        <div id="projects__list" class="collapse">
                            <ul class="list__items last-el">
                                @foreach($discover['projects'] as $project)
                                <li>
                                    <i class="fas fa-angle-double-right"></i>
                                    <a href="{{route('front.project.properties',['project_id' => $project->id,'title' =>$project->slug])}}">{{$project->second_title ? $project->second_title : $project->default_second_title}} <span>({{$project->units_count}} {{__('main.properties')}})</span></a>
                                </li>
                                @endforeach
                                <li class="more"><a href="{{route('front.properties')}}" data-text="{{__('main.discover_more_projects')}}">{{__('main.discover_more_projects')}}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<!-- END discover -->