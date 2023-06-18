    <!-- START ABOUT SECTION -->
    @if (count($footer_abouts))
        <section class="section about-holder">
            <div class="container">
                <div class="row">
                    @foreach ($footer_abouts as $about)
                        <div class="col-lg-3 col-sm-6 mb-3">
                            <div class="block">
                                <div class="block__count">
                                    <span>0{{ $loop->index + 1 }}</span>
                                    <div class="triangle">
                                        <svg width="120" height="140" viewBox="0 0 120 140" fill="none"
                                            xmlns="https://www.w3.org/2000/svg">
                                            <path d="M117.5 134.952L5 70L117.5 5.04808V134.952Z"
                                                stroke="url(#paint0_linear)" stroke-width="5" />
                                            <defs>
                                                <linearGradient id="paint0_linear" x1="9" y1="144" x2="134" y2="70"
                                                    gradientUnits="userSpaceOnUse">
                                                    <stop stop-color="#24212E" />
                                                    <stop offset="0.416667" stop-color="#345477" />
                                                    <stop offset="1" stop-color="#8EA0B3" />
                                                </linearGradient>
                                            </defs>
                                        </svg>
                                    </div>
                                </div>
                                <div class="block__title">
                                    <a href="{{route('front.about')}}#about{{$about->id}}">
                                        <h2>{{ $about->title }}</h2>
                                    </a>
                                </div>
                                <div class="block__desc">
                                    <p> {{ Str::limit(strip_tags($about->description), 50, '...') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!-- END ABOUT SECTION -->
