@if (count($projects))

    <!-- END PROJECTS  -->

    <section class="section projects-holder">
        <div class="container">
            <div class="section-title" data-aos="fade">
                <h2 class="title">{{ __('main.featured_projects') }}</h2>
            </div>
            <div class="swiper projects-slider">
                <div class="swiper-pagination" data-aos="fade" data-aos-delay="100"></div>

                <div class="swiper-wrapper py-3 mt-5">
                    @foreach ($projects as $project)
                        <div class='swiper-slide'>
                            <div class="h-100" data-aos="fade" data-aos-delay="0">
                                @include('front.components.project', ['project' => $project])
                            </div>
                        </div>
                    @endforeach

                </div>

                <div class="swiper-button-next proj-next-btn"></div>
                <div class="swiper-button-prev proj-prev-btn"></div>
            </div>
        </div>
    </section>

@endif

@push('scripts')
@endpush
