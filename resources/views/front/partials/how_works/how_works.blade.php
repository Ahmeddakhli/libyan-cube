    <!-- START BREADCRUMB -->
    <nav aria-label="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('front.home')}}">{{__('main.home_title')}}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{__('main.how_it_works')}}</li>
        </ol>
      </div>
    </nav>
    <!-- END BREADCRUMB -->

    <!-- START how-work-page  -->
    <section class="how-work-page py-5">
      <div class="container">
        <div class="section-title text-center mb-5">
          <h1 class="title">{{__('main.how_it_works')}}</h1>
          <!-- <p>Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet consectetur, elit. Possimus sed officia aut
            repudiandae odit porro?</p> -->
        </div>
        <div class="tabs-block" id="tabs-block">
            @foreach($how_works as $how_work)
            <div class="block">
              <div class="block__header">
                <h5 class="block__title">
                  <button class="btn-block text-left" type="button" data-toggle="collapse" data-target="#block-{{$how_work->id}}"
                    aria-expanded="true">
                    {{$how_work->title}}
                  </button>
                </h5>
              </div>
              <div id="block-{{$how_work->id}}" class="collapse panel-collapse @if($loop->index == 0) show @endif" data-parent="#tabs-block">
                <div class="block__body py-5 px-4">
                  <div class="block__img">
                    <img src="{{URL::asset('/storage/'.$how_work->image)}}" alt="{{$how_work->title}}">
                  </div>
                  <div class="block__txt">
                    <p>
                      {{$how_work->description}}
                    </p>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
      </div>
    </section>
    <!-- END how-work-page  -->