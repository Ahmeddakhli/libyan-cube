@if (count($relates))
    <div class="related-units mt-5">
        <div class="section-title text-center">
            <h2 class="title">{{ __('main.recommended_projects') }}</h2>
        </div>

        <div class="related-wrapper">
            <div class="controllers">
                <div class="line"></div>
                <div class="swiper-button-next units-next-btn">
                    <svg viewBox="0 0 124 246" fill="none" xmlns="https://www.w3.org/2000/svg">
                        <path
                            d="M5.95119 240.464C4.0613 242.354 0.829872 241.015 0.829872 238.342V7.65768C0.829872 4.98497 4.0613 3.64647 5.9512 5.53636L121.294 120.879C122.465 122.05 122.465 123.95 121.294 125.121L5.95119 240.464Z"
                            fill="#1D2033" />
                    </svg>
                </div>
                <div class="swiper-button-prev units-prev-btn">
                    <svg viewBox="0 0 124 246" fill="none" xmlns="https://www.w3.org/2000/svg">
                        <path
                            d="M118.294 240.464C120.184 242.354 123.415 241.015 123.415 238.342V7.65768C123.415 4.98497 120.184 3.64647 118.294 5.53636L2.95122 120.879C1.77964 122.05 1.77964 123.95 2.95122 125.121L118.294 240.464Z"
                            fill="#1D2033" />
                    </svg>
                </div>
                <div class="line"></div>
            </div>
            <div class="swiper units-slider">
                <div class="swiper-wrapper">
                    @foreach ($relates as $project)
                        <div class="swiper-slide">
                            @include('front.components.project',['project' => $project])
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
