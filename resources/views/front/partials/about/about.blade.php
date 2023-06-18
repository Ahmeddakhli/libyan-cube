<!-- START BREADCRUMB -->
<nav aria-label="breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('front.home') }}">{{ __('main.home_title') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('about::about.about') }}</li>
        </ol>
    </div>
</nav>
<!-- END BREADCRUMB -->

<div class="container mb-3">
    <div class="section-title mb-2">
        <h1 class="title text-center">{{ __('about::about.about') }}</h1>
    </div>
    @foreach ($seo as $seo_about)
        @if ($seo_about->page == 'about')
            @if ($seo_about->show_short_description)
                @include('front.components.breif',['short_description' => $seo_about->short_description])
            @endif
        @endif
    @endforeach
</div>


<!-- START about-page  -->
<section class="about-page py-5">
    <div class="container mt-5">

        @foreach ($abouts as $about)

            @if (!empty($about->title))
                <div class="section-title text-center" id="about{{$about->id}}">
                    <h2 class="title">{{ $about->title }}</h2>
                </div>
            @endif
            @if ($about->image)
                <div class="row">
                    @if ($loop->index % 2)
                        <div class="col-md-6 mb-5">
                            <div class="media">
                                <img src="{{ $about->image }}" alt="{{ $about->title }}" />
                            </div>
                        </div>
                        <div class="col-md-6 mb-5">
                            <div class="text">
                                <div class="desc">
                                    @if (!empty($about->description))
                                        <div class="desc">
                                            {!! $about->description !!}
                                        </div>
                                    @endif
                                </div>
                                <!-- /.desc -->
                            </div>
                        </div>
                    @else
                        <div class="col-md-6 mb-5">
                            <div class="text">
                                <div class="desc">
                                    @if (!empty($about->description))
                                        <div class="desc">
                                            {!! $about->description !!}
                                        </div>
                                    @endif
                                </div>
                                <!-- /.desc -->
                            </div>
                        </div>
                        <div class="col-md-6 mb-5">
                            <div class="media">
                                <img src="{{ $about->image }}" alt="{{ $about->title }}" />
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <div class="text">
                    <div class="desc">
                        @if (!empty($about->description))
                            <div class="desc">
                                {!! $about->description !!}
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</section>
<!-- END about-page  -->
