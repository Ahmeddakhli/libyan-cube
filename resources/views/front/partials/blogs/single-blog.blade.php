@push('scripts')
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0"
        nonce="BzrEAzdr"></script>
@endpush

<!-- START BREADCRUMB -->
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('front.home') }}">{{ __('main.home_title') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('front.blogs') }}">{{ __('blog::blog.blogs') }}</a></li>
                @if (!empty($blog->categories))
                    <li class="breadcrumb-item"><a
                            href="{{ route('front.blogs', ['category_slug' => $blog->categories[0]->slug]) }}">{{ $blog->categories[0]->title }}</a>
                    </li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">{{ $blog->title }}</li>
            </ol>
        </div>
    </nav>
@endsection


<section class="view-blog pb-5">

    <div class="container">

        <div class="mb-4">
            @foreach ($blog->attachments as $attachment)
                @if ($loop->index == 0)
                    {{-- <div class="carousel-item @if ($loop->index == 0) active @endif" data-interval="10000"> --}}
                    <img class='img-fluid'
                        src="{{ $attachment->url }}"
                        alt="{{ $attachment->file_name }}">
                @endif
                {{-- </div> --}}
            @endforeach
        </div>

        <div class="section-title">
            <h1 class='title h4'>
                {{ $blog->title }}
            </h1>
        </div>

        <p class='blog-notes mb-3'>
            <span class="icon-link me-3">
                <i class="ri-edit-2-line"></i>
                {{ $blog->creator->full_name }}
            </span>
            <span class="date">
                <i class="ri-calendar-line"></i>
                <span class="format-date">{{ date('d M Y', strtotime($blog->created_at)) }}</span>
            </span>
        </p>

        <div class="desc">
          {!! $blog->description !!}
        </div>
        <hr>

        <div class="share-post">
            <h4 class="text-capitalize">{{ __('main.share_with') }} : </h4>

            <div class="contacts__social my-4">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('front.single_blog', ['id' => $blog->id, 'slug' => $blog->slug]) }}"
                    class="contacts__social--link">
                    <i class="ri-facebook-line"></i>
                </a>
                <a href="https://twitter.com/intent/tweet?text=" class="contacts__social--link twitter">
                    <i class="ri-twitter-line"></i>
                </a>
                <a href="https://www.linkedin.com/shareArticle/?mini=true&url={{ route('front.single_blog', ['id' => $blog->id, 'slug' => $blog->slug]) }}"
                    class="contacts__social--link linkedin">
                    <i class="ri-linkedin-line"></i>
                </a>
                <a href="http://pinterest.com/pin/create/bookmarklet/?url={{ route('front.single_blog', ['id' => $blog->id, 'slug' => $blog->slug]) }}"
                    class="contacts__social--link pinterest">
                    <i class="ri-pinterest-line"></i>
                </a>
            </div>
        </div>
    </div>
</section>
