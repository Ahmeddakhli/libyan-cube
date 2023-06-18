<!-- START SEARCH BOX -->
    <section class="main-search">
        <div class="search-box">
        <h1 class="slogan-title text-center">
          @if(App::getLocale() == 'ar')
            {{$setting->slogan_ar}}  
          @else
            {{$setting->slogan_en}}  
          @endif
        </h1>
          <h3 class="search-title">
            <bdi>{{__('main.compare')}} +
              <span class="counter" data-min="1" data-max="{{$units_count}}" data-delay="1" data-increment="1">{{$units_count}}</span>
              {{__('main.homes_and')}} +
              <span class="counter" data-min="1" data-max="{{$projects_count}}" data-delay="1" data-increment="1">{{$projects_count}}</span>
              {{__('main.projects')}}
            </bdi>
          </h3>

          <ul class="nav nav-tabs">
            @if(request('offering_types'))
              @foreach($offering_types as $offering_type)  
              @if($offering_type->is_searchable)
                @if(in_array($offering_type->id,request('offering_types')))
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#search-form" data-id="{{$offering_type->id}}" onclick="setOfferingType({{$offering_type->id}},'search-form')">{{$offering_type->offering_type}}</a>
                  </li>
                @else
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#search-form" data-id="{{$offering_type->id}}" onclick="setOfferingType({{$offering_type->id}},'search-form')">{{$offering_type->offering_type}}</a>
                  </li>
                @endif   
              @endif
              @endforeach
            @else 
              @foreach($offering_types as $offering_type) 
              @if($offering_type->is_searchable) 
                <li class="nav-item">
                  <a class="nav-link @if($loop->index == 0) active @endif" data-toggle="tab" href="#search-form" data-id="{{$offering_type->id}}" onclick="setOfferingType({{$offering_type->id}},'search-form')">{{$offering_type->offering_type}}</a>
                </li>
              @endif
              @endforeach
            @endif
          </ul>
          <div class="tab-content mt-3">
            <div class="tab-pane fade show active" id="search-form">
              @include('front.components.search-box',['url' => route('front.properties'),'form_id' => 'search-form','purposeDiv' => 'filter-purpose-div','purpose_type' => 'search-purpose-type-div','regionDiv' => 'region-search-div','city' => 'city-search-div'])
            </div>

          </div>
        </div>
    </section>