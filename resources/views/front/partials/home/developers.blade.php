<section class="section devs-holder">
    <div class="container">
        <div class="swiper devs-slider">
            <div class="swiper-wrapper my-5">
                @foreach ($developers as $developer)
                    <div class="swiper-slide">
                        @include('front.components.developer',['developer' => $developer])

                </div>
            @endforeach
        </div>
    </div>
</div>
</section>
