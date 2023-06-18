@if(count($top_agents))
<!-- START TEAMS SECTION -->
<section class="our-team section">
    <div class="section-title text-center">
        <h2>الفريق</h2>
    </div>
    <div class="slider-section">
        <div class="slick_slider" data-arrows="false" data-rtl="true" data-autoplay="true" data-slides-to-show="5" data-speed="1500" data-slides-to-scroll="1" data-responsive="
          responsive: [
          {
            breakpoint: 1199,
            settings: {
              slidesToShow: 4,
            }
          },
          {
            breakpoint: 991,
            settings: {
              slidesToShow: 3,
            }
          },
          {
            breakpoint: 767,
            settings: {
              slidesToShow: 2,
            }
          },
          {
            breakpoint: 575,
            settings: {
              slidesToShow: 1,
            }
          }
        ]
      ">
            @foreach($top_agents as $top_agent)
            <div class="team">
                <div class="team-card">
                    <ul class="team-social">
                        @if(count($top_agent->socials) > 0)
                        @foreach($top_agent->socials as $top_social)
                        <li><a href="{{$top_social->link}}" target="_blank"><i class="{{$top_social->icon}}"></i></a></li>
                        @endforeach
                        @endif
                    </ul>
                    <div class="team-img">
                        <img class="avatar" src="{{$top_agent->user->image}}" />
                    </div>
                    <div class="team-content">
                        <h3 class="name">{{$top_agent->user->full_name}}</h3>
                        <span class="title">{{$top_agent->user->group}}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
<!-- END TEAMS SECTION -->