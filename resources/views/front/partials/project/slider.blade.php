
<div class="view-slider mb-3">
            <div class="swiper gallery-top">
              <div class="swiper-wrapper">
                @if(count($single_project->attachments))
                    @foreach($single_project->attachments as $attachment)
                        <div class="swiper-slide">
                            <meta itemprop="{{$single_project->project}}" content="{{$attachment->url}}" />
                            <img src="{{$attachment->url}}" alt="{{$attachment->alt}}" itemprop="image">
                        </div>
                    @endforeach
                @else
                <div class="swiper-slide">
                    <meta itemprop="image" content="{{asset('front/images/placeholder.png')}}" />
                    <img src="{{asset('front/images/placeholder.png')}}" alt="Product No Image" itemprop="image">
                </div>
                @endif
              </div>
            </div>
            @if(count($single_project->attachments))
            <div class="swiper gallery-thumbs">
              <div class="swiper-wrapper">
              @foreach($single_project->attachments as $attachment)
                    <div class="swiper-slide">
                        <img src="{{$attachment->url}}" alt="{{$attachment->alt}}" itemprop="image">
                    </div>
                @endforeach
              </div>
            </div>
            @endif
          </div>