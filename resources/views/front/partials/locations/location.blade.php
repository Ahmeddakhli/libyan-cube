
<!-- START BREADCRUMB -->
<nav aria-label="breadcrumb">
  <div class="container">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('front.home')}}">{{__('main.home_title')}}</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{$location['location']->name}}</li>
    </ol>
  </div>
</nav>
<!-- END BREADCRUMB -->

<div class="container py-3">
  <div class="search-box">
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
        @include('front.components.search-box',['url' => route('front.areas.show',['id' => $location['location']->id,'slug' => str_slug($location['location']->default_value)])])
      </div>

    </div>
  </div>
</div>

<!-- START index-page  -->
<section class="index-page py-5">
  <div class="container">
    <div class="dev-info">
      <div class="row no-gutter">
        <div class="col-lg-3">
          <!-- <div class="dev-img">

          </div> -->
          <h1 class="dev-title">
            {{$location['location']->default_value}}
            <!-- <span><bdi>(10 وحدات متاحه)</bdi></span> -->
            <span> <a href="{{route('front.properties',['city_id[]'=>$location['location']->id])}}"><bdi>({{$location['location']->units_count}} {{__('main.properties')}})</bdi></a></span>
            <span><a href="{{route('front.projects',['city_id[]'=>$location['location']->id])}}"><bdi>({{$location['location']->projects_count}} {{__('main.projects')}})</bdi></a></span>

          </h1>
        </div>
        <div class="col-lg-1 p-0 d-none d-lg-block">
          <span class="strike"></span>
        </div>
        <div class="col-lg-8 mt-4 mt-lg-0">
          <div class="dev-txt">
          {!! Str::limit(strip_tags($location['location']->description),300) !!}
          <a
                  class="read-more-btn text-primary"
                  data-toggle="collapse"
                  href="#more-block"
                  role="button"
                  aria-expanded="false"
                >
                  {{__('main.read_more')}}
              </a>
          </div>
          <nav class="menu-share-media">
            <label>{{__('main.share_with')}} :</label>
            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{route('front.areas.show',['id' =>$location['location']->id,'slug' => str_slug($location['location']->default_value)])}}" class="facebook"><i class="fab fa-facebook-f"></i> </a>
            <a target="_blank" href="https://twitter.com/intent/tweet?text={{route('front.areas.show',['id' =>$location['location']->id,'slug' => str_slug($location['location']->default_value)])}}" class="twitter twitter-share-button"><i class="fab fa-twitter"></i></a>
            <a target="_blank" href="https://www.linkedin.com/shareArticle/?mini=true&url={{route('front.areas.show',['id' =>$location['location']->id,'slug' => str_slug($location['location']->default_value)])}}" class="linkedin">
              <i class="fab fa-linkedin-in"></i>
            </a>
            <a target="_blank" href="http://pinterest.com/pin/create/bookmarklet/?url={{route('front.areas.show',['id' =>$location['location']->id,'slug' => str_slug($location['location']->default_value)])}}" class="pinterest">
              <i class="fab fa-pinterest-p"></i>
            </a>
          </nav>
        </div>
      </div>
    </div>
    <div class="more-block-wrapper py-3">
            <div class="collapse" id="more-block">
              <div class="holder">
                {!! $location['location']->description !!}
              </div>
            </div>
          </div>
    <div class="row no-gutter">
      <div class="col-xl-9 col-lg-8">
        <div class="control-view">
          <div class="view-sort">
            <label for="sort-select" class="m-0">{{__('main.order_by')}}:</label>
            <select id="sort-select" class="dd-select sort-select" onchange="sortProjects($(this).val())">
              <option value="featured" @if(request('sort') == "featured") selected @endif>{{__('main.featured')}}</option>
              <option value="desc_price" @if(request('sort') == "desc_price") selected @endif>{{__('main.most_expensive')}}</option>
              <option value="asc_price" @if(request('sort') == "asc_price") selected @endif>{{__('main.lowest_price')}}</option>
              <option value="desc_date" @if(request('sort') == "desc_date") selected @endif>{{__('main.latest')}}</option>
              <option value="asc_date" @if(request('sort') == "asc_date") selected @endif>{{__('main.the_oldest')}}</option>
            </select>
          </div>
          <div class="view-filters">
            <button data-view="grid-view" class="view active">
              <i class="fa fa-th-large"></i>
            </button>
            <button data-view="list-view" class="view">
              <i class="fas fa-bars"></i>
            </button>
          </div>
        </div>
        <div class="grid-view" data-container="cards-wrapper">
          @if(isset($location['results']) && count($location['results']))
          @foreach($location['results'] as $result)
            @if($type == 'project')
              @include('front.components.project',['project' =>$result ])
            @endif
            @if($type == 'unit')
              @include('front.components.unit',['unit' =>$result ])
            @endif
          @endforeach
          @endif
        </div>
        @if($location['results']->hasPages())
        {{$location['results']->appends(request()->input())->links('front.partials.primary.pagination')}}
        @endif
      </div>
      <div class="col-xl-3 col-lg-4 mb-5 mb-lg-0 order-first order-lg-last">
        <aside class="sidebar">
          <button class="show-contact-us">
            تواصل معنا
          </button>

          @include('front.components.contact_form',['type'=>'contact'])
        </aside>
      </div>
    </div>
  </div>
</section>
<!-- END index-page  -->
@push('scripts')
<script>
  function sortProjects(sort) {
    var url = "{{route('front.areas.show',array_merge(['id' => $location['location']->id,'slug' => str_slug($location['location']->default_value),'type'=>$type],request()->input()))}}";
    @if(!empty(request()->input()))
      url = url+'&sort='+sort
    @else
      url = url+'?sort='+sort
    @endif
    url = url.replaceAll('&amp;','&')

    window.location = url;
  }
</script>
@endpush
