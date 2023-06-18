<div class="view-slider mb-3">
    <div class="swiper gallery-top">
        <div class="swiper-wrapper">
            @foreach($single_unit->attachments as $attachment)
                <div class="swiper-slide">
                    <meta itemprop="{{$single_unit->title}}" content="{{$attachment->url}}" />
                    <img src="{{$attachment->url}}" alt="{{$attachment->alt}}">
                </div>
            @endforeach
        </div>
    </div>
    <div class="swiper gallery-thumbs">
        <div class="swiper-wrapper">
            @foreach($single_unit->attachments as $attachment)
                <div class="swiper-slide">
                    <img src="{{$attachment->url}}" itemprop="{{$single_unit->title}}" alt="{{$single_unit->title}}">
                </div>
            @endforeach

        </div>
    </div>
</div>