<!-- START CLIENTS SECTION -->
@if (count($testimonials))
    <section class="our-clients section">
        <div class="container">
            <div class="section-title text-center">
                <h2>قالوا إيه عنا ؟</h2>
            </div>
            <div class="row ">
                <div class="col-md-6 order-2">
                    <div class="slider-section">
                        <div class="slick_slider client-txt-slider" data-arrows="true" data-rtl="true" data-speed="1200"
                            data-as-nav-for=".client-img-slider" data-dots="true">
                            @foreach ($testimonials as $testimonial)
                                <div class="client-txt">
                                    <h2>{{ $testimonial->name }}</h2>
                                    <blockquote>
                                        <p>{{ $testimonial->description }}</p>
                                    </blockquote>
                                </div>
                            @endforeach
                        </div>
                        <i class="fas fa-quote-left"></i>
                        <i class="fas fa-quote-right"></i>
                        <div class="controllers">
                            <button class="prev">
                                <span class="material-icons">east</span>
                            </button>
                            <button class="next">
                                <span class="material-icons">west</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-md-0 mb-4 order-1">
                    <div class="slider-section">
                        <div class="slick_slider client-img-slider" data-rtl="true" data-speed="1200"
                            data-as-nav-for=".client-txt-slider" data-arrows="false">
                            @foreach ($testimonials as $testimonial)

                                <figure class="client-img">
                                    @if ($testimonial->attachments && count($testimonial->attachments))
                                        <img src="{{ $testimonial->attachments[0]->url }}" alt="placeholder">
                                    @else
                                        <img src="{{ URL::asset('front/images/placeholder.png') }}" alt="placeholder">
                                    @endif
                                </figure>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
<!-- END CLIENTS SECTION -->
