<!-- START BREADCRUMB -->
<nav aria-label="breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('front.home') }}">{{ __('main.home_title') }}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{ __('cms::cms.terms') }}
            </li>
        </ol>
    </div>
</nav>
<!-- END BREADCRUMB -->

<div class="container mb-3">
    <div class="section-title">
        <h1 class="title mb-2 text-center">{{ __('cms::cms.terms') }}</h1>
    </div>
    @foreach ($seo as $seo_term)
        @if ($seo_term->page == 'terms')
            @if ($seo_term->show_short_description)
                @include('front.components.breif',['short_description' => $seo_term->short_description])
            @endif
        @endif
    @endforeach

</div>


<!-- START privacy-page  -->
<section class="privacy-page py-5">
    <div class="container">
        @foreach ($terms as $term)
            <div class="block">
                <h2>{{ $term->title }}</h2>
                <p>
                    {!! $term->description !!}
                </p>
            </div>
        @endforeach
    </div>
</section>
<!-- END privacy-page  -->
