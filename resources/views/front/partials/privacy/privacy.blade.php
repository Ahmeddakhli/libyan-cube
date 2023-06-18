<!-- START BREADCRUMB -->
<nav aria-label="breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('front.home') }}">{{ __('main.home_title') }}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{ __('cms::cms.privacies') }}
            </li>
        </ol>
    </div>
</nav>
<!-- END BREADCRUMB -->

<div class="container mb-3">
    <div class="section-title">
        <h1 class="title mb-2 text-center">{{ __('cms::cms.privacies') }}</h1>
    </div>
</div>

<!-- START privacy-page  -->
<section class="privacy-page py-5">
    <div class="container">
        @foreach ($privacies as $privacy)
            <div class="block">
                <h2>{{ $privacy->title }}</h2>
                {!! $privacy->description !!}

            </div>
        @endforeach
    </div>
</section>
<!-- END privacy-page  -->
