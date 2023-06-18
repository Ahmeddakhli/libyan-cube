

@extends('front.layouts.main')


@section('page_name')
    {{ $single_project->meta_title ? $single_project->meta_title : $single_project->project }}
@endsection
@php
$page_name = '';

$whatsapp = '';
foreach ($contacts as $key => $contact) {
    if ($key == 'whatsapp') {
        foreach ($contact as $whats) {
            $whatsapp = $whats->contact;
            break;
        }
    }
}
$phone_number = '';
foreach ($contacts as $key => $contact) {
    if ($key == 'phone') {
        foreach ($contact as $ph) {
            $phone_number = $ph->contact;
            break;
        }
    }
}

@endphp
@push('header-scripts')
@endpush
@push('meta')
    <meta name="title"
        content="{{ $single_project->meta_title ? $single_project->meta_title : $single_project->project }}" />
    <meta name="description"
        content="{{ strip_tags($single_project->meta_description ? $single_project->meta_description : substr($single_project->description, 0, 150)) }}" />
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name"
        content="{{ $single_project->meta_title ? $single_project->meta_title : $single_project->project }}" />
    <meta itemprop="image" content="{{ URL::asset('/front/images/logo.png') }}">
    <meta itemprop="description"
        content="{{ strip_tags($single_project->meta_description ? $single_project->meta_description : substr($single_project->description, 0, 150)) }}" />
    <!-- Twitter Card data -->
    <meta name='twitter:app:country' content='EG' />
    <meta name="twitter:site" content="@advisors" />
    <meta name="twitter:creator" content="@advisors" />
    <meta name="twitter:title"
        content="{{ $single_project->meta_title ? $single_project->meta_title : $single_project->project }}">
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:image" content="{{ URL::asset('/front/images/logo.png') }}">
    <meta name="twitter:description"
        content="{{ strip_tags($single_project->meta_description ? $single_project->meta_description : substr($single_project->description, 0, 150)) }}" />
    <!-- Open Graph data -->
    <meta property="og:type" content="article" />
    <meta property="og:site_name" content="Constguide">
    <meta property="og:url" content="{{ Request::url() }}" />
    <meta property="og:title"
        content="{{ $single_project->meta_title ? $single_project->meta_title : $single_project->project }}" />
        <meta property="og:image" content="{{$single_project->attachments[0]->url?$single_project->attachments[0]->url: URL::asset('/front/images/logo.png') }}">
    <meta property="og:description"
        content="{{ strip_tags($single_project->meta_description ? $single_project->meta_description : substr($single_project->description, 0, 150)) }}" />
@endpush

@section('content')


    <!-- START BREADCRUMB -->
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('front.home') }}">{{ __('main.home_title') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('front.projects') }}">{{ __('main.projects') }}</a></li>
                @if ($single_project->city)
                    <li class="breadcrumb-item" aria-current="page"><a
                            href="{{ route('front.areas.show', ['id' => $single_project->city->id, 'slug' => str_slug($single_project->city->default_value)]) }}">{{ $single_project->city->name }}</a>
                    </li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">{{ $single_project->project }}</li>
            </ol>
        </div>
    </nav>
@endsection
<!-- END BREADCRUMB -->

<section class="view-page pb-5" itemscope itemtype="http://schema.org/Product">
    <div class="container">

        <div class="row gx-2">
            <div class="col-lg-9">
                <div class="view-page__block">

                    <div class="sticky-holder sticky-top">
                        <nav class="navbar p-0">
                            <ul class="nav nav-pills spy-links">
                                <li class="nav-item">
                                    <a class="nav-link spy-link d-inline-flex align-items-center gap-1" href="#"
                                        data-scroll="sec-1">
                                        <i class="ri-gallery-fill"></i> {{ __('main.gallary') }}
                                    </a>
                                </li>
                                @if($single_project->developer || $single_project->description)
                                <li class="nav-item">
                                    <a class="nav-link spy-link d-inline-flex align-items-center gap-1" href="#"
                                        data-scroll="sec-2">
                                        <i class="ri-information-line"></i> {{ __('main.details') }}
                                    </a>
                                </li>
                                @endif
                                @if (count($single_project->unit_types))
                                <li class="nav-item">
                                    <a class="nav-link spy-link d-inline-flex align-items-center gap-1" href="#"
                                        data-scroll="sec-3">
                                        <i class="ri-home-3-line"></i> {{ __('main.unit_types') }}
                                    </a>
                                </li>
                                @endif
                                {{-- <li class="nav-item">
                                    <a class="nav-link spy-link d-inline-flex align-items-center gap-1" href="#"
                                        data-scroll="sec-4">
                                        <i class="ri-layout-masonry-line"></i> {{ __('main.master_plan') }}
                                    </a>
                                </li> --}}
                                @if ($single_project->latitude || $single_project->longitude)
                                <li class="nav-item">
                                    <a class="nav-link spy-link d-inline-flex align-items-center gap-1" href="#"
                                        data-scroll="sec-5">
                                        <i class="ri-map-pin-line"></i> {{ __('main.location') }}
                                    </a>
                                </li>
                                @endif
                                @if ($single_project->amenities || $single_project->facilities)
                                <li class="nav-item">
                                    <a class="nav-link spy-link d-inline-flex align-items-center gap-1" href="#"
                                        data-scroll="sec-6">
                                        <i class="ri-file-list-2-line"></i>
                                        {{ __('inventory::inventory.facilities_and_amenities') }}
                                    </a>
                                </li>
                                @endif

                            </ul>
                        </nav>
                    </div>

                    <div class="row align-items-center justify-content-between mb-2">
                        <div class="col-md-6">
                            <div class="section-title mb-0">
                                <h1 class="title h5" itemprop="name">{{ $single_project->project }}</h1>
                            </div>
                        </div>
                        <div class="col-md-6 text-md-end mt-2 mt-md-0">
                            <div class="item-price">
                                <p>
                                    <span class="label">{{ __('main.starting_price') }}:</span>
                                    <strong>{{ $single_project->price_from }}</strong>
                                    <small>EGP</small>
                                </p>
                            </div>
                        </div>
                    </div>

                    @if ($single_project->tags)
                        <div class="item-labels">
                            @foreach ($single_project->tags as $tag)
                                <a href="{{ route('front.projects', ['tag_id' => $tag->id]) }}"
                                    class="label type-label">{{ $tag->tag }}</a>
                            @endforeach
                        </div>
                    @endif

                    @if ($single_project->city)
                        <div class="item-address">
                            <address itemscope itemtype="https://schema.org/Place">
                                <i class="ri-map-pin-line"></i>
                                <span itemprop="name">
                                    @if ($single_project->city)
                                        <?php $locations_array = []; ?>
                                        @if ($single_project->country)
                                            <?php array_push($locations_array, $single_project->country->name); ?>
                                        @endif
                                        @if ($single_project->region)
                                            <?php array_push($locations_array, $single_project->region->name); ?>
                                        @endif
                                        @if ($single_project->city)
                                            <?php array_push($locations_array, $single_project->city->name); ?>
                                        @endif
                                        @if ($single_project->area)
                                            <?php array_push($locations_array, $single_project->area->name); ?>
                                        @endif
                                        @if (count($locations_array))
                                            {{ implode(', ', $locations_array) }}
                                        @endif
                                    @endif
                                </span>
                            </address>
                        </div>
                    @endif

                    <div id="sec-1" class="spy-section view-item-slider">
                        <ul class="nav nav-pills nav-with-indicator mb-3" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link d-inline-flex align-items-center gap-1 active"
                                    data-bs-toggle="pill" data-bs-target="#tab-1" type="button" role="tab"
                                    aria-selected="true">
                                    <i class="ri-camera-line"></i> {{ __('main.photos') }}
                                </button>
                            </li>
                            @if ($single_project->video)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link d-inline-flex align-items-center gap-1" data-bs-toggle="pill"
                                    data-bs-target="#tab-3" type="button" role="tab" aria-selected="false">
                                    <i class="ri-live-line"></i> {{ __('main.video') }}
                                </button>
                            </li>
                            @endif
                            {{-- <li class="nav-item" role="presentation">
                                <button class="nav-link d-inline-flex align-items-center gap-1" data-bs-toggle="pill"
                                    data-bs-target="#tab-4" type="button" role="tab" aria-selected="false">
                                    <i class="ri-image-2-line"></i> 360&#176;
                                </button>
                            </li> --}}
                            <li class="nav-indicator"></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-1" role="tabpanel">
                                <div class="gallery-large-holder position-relative">

                                    @if ($single_project->developer)
                                        <div class="dev-logo">
                                            @forelse($single_project->developer->attachments as $attachment)
                                                @if ($loop->index == 0)
                                                    <img class="img-thumbnail" src="{{ $attachment->url }}"
                                                        alt="{{ $attachment->file_name }}">
                                                @else
                                                @break
                                            @endif
                                        @empty
                                            <img class="img-thumbnail"
                                                src="{{ URL::asset('front/images/placeholder.png') }}"
                                                alt="{{ $single_project->developer->developer_name }}">
                                        @endforelse
                                    </div>
                                @endif

                                <div class="user-actions">

                                    <div>
                                        <nav class="position-relative">
                                            <input type="checkbox" class="visually-hidden toggle-action-input"
                                                id="share-input">

                                            <label class="toggle-action-label toggle-share-label"
                                                for="share-input" title='Share this project'></label>

                                            <div class="social-links share-links">
                                                <a target="_blank"
                                                    href="https://www.facebook.com/sharer/sharer.php?u={{ route('front.singleProject', ['id' => $single_project->id, 'slug' => str_slug($single_project->default_value)]) }}"
                                                    class="social-link facebook-link" title='Messenger'
                                                    style="--delay: 0.1s">
                                                    <i class="ri-messenger-fill"></i>
                                                </a>

                                                <a target="_blank"
                                                    href="https://api.whatsapp.com/send?text={{ route('front.singleProject', ['id' => $single_project->id, 'slug' => str_slug($single_project->default_value)]) }}"
                                                    class="social-link whatsapp-link" title='WhatsApp'
                                                    style="--delay: 0.15s">
                                                    <i class="ri-whatsapp-fill"></i>
                                                </a>

                                                <a target="_blank"
                                                    href="https://twitter.com/intent/tweet?text={{ route('front.singleProject', ['id' => $single_project->id, 'slug' => str_slug($single_project->default_value)]) }}"
                                                    class="social-link twitter-link" title='Twitter'
                                                    style="--delay: 0.2s">
                                                    <i class="ri-twitter-fill"></i>
                                                </a>

                                                <a target="_blank"
                                                    href="http://pinterest.com/pin/create/bookmarklet/?url={{ route('front.singleProject', ['id' => $single_project->id, 'slug' => str_slug($single_project->default_value)]) }}"
                                                    class="social-link pinterest-link" title='Pinterest'
                                                    style="--delay: 0.25s">
                                                    <i class="ri-pinterest-fill"></i>
                                                </a>

                                                <a target="_blank"
                                                    href="https://www.linkedin.com/shareArticle/?mini=true&url={{ route('front.singleProject', ['id' => $single_project->id, 'slug' => str_slug($single_project->default_value)]) }}"
                                                    class="social-link linkedin-link" title='Linkedin'
                                                    style="--delay: 0.3s">
                                                    <i class="ri-linkedin-fill"></i>
                                                </a>

                                                <a href="{{ route('front.singleProject', ['id' => $single_project->id, 'slug' => str_slug($single_project->default_value)]) }}"
                                                    class="social-link copy-page-link"
                                                    title='Copy link to your clipboard' style="--delay: 0.35s">
                                                    <i class="ri-link"></i>
                                                    <span class="page-url">Page link copied!</span>
                                                </a>
                                            </div>
                                        </nav>
                                    </div>

                                </div>

                                @if (count($single_project->attachments))
                                    <div class="swiper gallery-large"style="">
                                        <div class="swiper-wrapper gallery-holder">
                                            @foreach ($single_project->attachments as $attachment)
                                                <div class="swiper-slide">
                                                    <div class="item">
                                                        <meta itemprop="{{ $single_project->project }}"
                                                            content="{{ $attachment->url }}" />
                                                        <a href="{{ $attachment->url }}" class="mgf-link">
                                                            <img src="{{ $attachment->url }}"
                                                                alt="{{ $attachment->alt }}" itemprop="image">
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                        <div class="swiper-button-next gall-unit-next-btn"></div>
                                        <div class="swiper-button-prev gall-unit-prev-btn"></div>
                                    </div>
                                @endif
                            </div>
                            @if (count($single_project->attachments))
                                <div class="swiper gallery-thumbs">

                                    <div class="swiper-wrapper">
                                        @foreach ($single_project->attachments as $attachment)
                                            <div class="swiper-slide">
                                                <div class="item">
                                                    <img src="{{ $attachment->url }}"
                                                        alt="{{ $attachment->alt }}" itemprop="image">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            @endif
                        </div>
                        @if ($single_project->video)
                            <div class="tab-pane fade" id="tab-3" role="tabpanel">
                                <div class="video tab-block">
                                    <div class="ratio ratio-21x9">
                                        {{ $single_project->video }}
                                    </div>
                                </div>
                            </div>
                        @endif


                        {{-- <div class="tab-pane fade" id="tab-4" role="tabpanel">
                            <div class="panorama tab-block">
                                <div class="swiper panorama-slider">
                                    <div class="swiper-wrapper mb-5">
                                        <div class="swiper-slide">
                                            <div class="item">
                                                <div class="ratio ratio-21x9">
                                                    <iframe src="https://www.optiview360.com/cityfurniture.html"
                                                        allowfullscreen="allowfullscreen"></iframe>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="item">
                                                <div class="ratio ratio-21x9">
                                                    <iframe src="https://optiview360.com/hrp.html"
                                                        allowfullscreen="allowfullscreen"></iframe>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="item">
                                                <div class="ratio ratio-21x9">
                                                    <iframe src="https://optiview360.com/hotelalba.html"
                                                        allowfullscreen="allowfullscreen"></iframe>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="item">
                                                <div class="ratio ratio-21x9">
                                                    <iframe src="https://optiview360.com/nova.html"
                                                        allowfullscreen="allowfullscreen"></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-button-next panorama-next-btn"></div>
                                    <div class="swiper-button-prev panorama-prev-btn"></div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div> --}}

                    </div>

                </div>

                <div id="sec-2" class="spy-section mt-5 py-3">
                    <div class="item-description">
                        <div class="section-title">
                            <h4 class="title">{{ __('main.description') }}</h4>
                        </div>
                        <div class="row">
                            <div class="col-lg-2 col-md-3">
                                <div class="thumbnail-holder">
                                    @if ($single_project->developer)
                                        @forelse($single_project->developer->attachments as $attachment)
                                            @if ($loop->index == 0)
                                                <img class="img-thumbnail" src="{{ $attachment->url }}"
                                                    alt="{{ $attachment->file_name }}">
                                            @else
                                            @break
                                        @endif
                                    @empty
                                        <img class="img-thumbnail"
                                            src="{{ URL::asset('front/images/placeholder.png') }}"
                                            alt="{{ $single_project->developer->developer_name }}">
                                    @endforelse
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-10 col-md-9 mt-md-0 mt-3">
                            <div class="desc-head">
                                <div class="collapse" id="collapseTxt">
                                    {!! $single_project->description !!}
                                </div>

                                <a role="button"
                                    class="read-more collapsed mt-2 d-inline-block text-decoration-none"
                                    data-bs-toggle="collapse" href="#collapseTxt" aria-expanded="false"></a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @if (count($single_project->unit_types))
                <div id="sec-3" class="spy-section py-3">
                    <div class="unit-types">
                        <div class="section-title">
                            <h4 class="title">{{ __('main.unit_types') }}</h4>
                        </div>
                        <div class="nav nav-pills nav-with-indicator mb-4">
                            @foreach ($single_project->unit_types as $unit_type)
                                <button data-bs-target="#tab-1-{{ $unit_type->id }}" data-bs-toggle="pill"
                                    class="nav-link active">
                                    {{ $unit_type->unit_type }}</button>
                            @endforeach

                            <span class="nav-indicator"></span>
                        </div>

                        <div class="tab-content">
                            @foreach ($single_project->unit_types as $unit_type)
                                <div class="tab-pane fade show active" id="tab-1-{{ $unit_type->id }}">
                                    <div class="swiper unit-types-slider">
                                        <div class="swiper-wrapper py-3">
                                            @foreach ($unit_type->units as $unit)
                                                <div class="swiper-slide">
                                                    @include('front.components.unit', ['unit' => $unit])
                                                </div>
                                            @endforeach


                                        </div>
                                        <div class="swiper-button-next u-types-next-btn"></div>
                                        <div class="swiper-button-prev u-types-prev-btn"></div>
                                    </div>
                                    <div class="text-center">
                                        <a href="{{ route('front.properties', ['unit_type_id' => $unit_type->id]) }}"
                                            class="site-btn mt-3">
                                            {{ __('main.all_properties') }}
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            {{-- @if ($single_project->master_plans)
                <div id="sec-4" class="spy-section py-3">
                    <div class="item-plans tab-block">
                        <div class="section-title">
                            <h4 class="title">{{ __('main.master_plan') }}</h4>
                        </div>
                        <div class="swiper gallery-plans-slider">
                            <div class="swiper-wrapper mb-5 gallery-holder">
                                @foreach ($single_project->master_plans as $master_plan)
                                    <div class="swiper-slide">
                                        <div class="item">
                                            <a href="{{ $master_plan->url }}" class="mgf-link">
                                                <img src="{{ $master_plan->url }}"
                                                    alt="{{ $master_plan->file_name }}">
                                            </a>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            @endif --}}
            @if ($single_project->latitude || $single_project->longitude)
                <div id="sec-5" class="spy-section py-3">
                    <div class="map-loc tab-block">
                        <div class="section-title">
                            <h4 class="title">{{ __('main.location') }}</h4>
                        </div>
                        <div class="ratio ratio-21x9" id="map">
                        </div>
                    </div>
                </div>
            @endif
            @if ($single_project->amenities || $single_project->facilities)
                <div id="sec-6" class="spy-section py-3">
                    <div class="section-title">
                        <h4 class="title">{{ __('inventory::inventory.facilities_and_amenities') }}</h4>
                    </div>
                    <div class="accordion item-features">
                        <div class="row g-3">
                            @if ($single_project->amenities)
                                <div class="col-md-6">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#acc-1-1"
                                                aria-expanded="true">
                                                {{ __('inventory::inventory.amenities') }}
                                            </button>
                                        </h2>

                                        <div id="acc-1-1" class="accordion-collapse collapse show">
                                            <div class="accordion-body">
                                                <ul class="grid-container">
                                                    @foreach ($single_project->amenities as $amenity)
                                                        <li class="d-flex gap-1 align-items-center">
                                                            <i class="ri-checkbox-circle-fill"></i>
                                                            <span>{{ $amenity->amenity }}</span>
                                                        </li>
                                                    @endforeach

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($single_project->facilities)
                                <div class="col-md-6">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#acc-1-2"
                                                aria-expanded="true">
                                                {{ __('inventory::inventory.facilities') }}
                                            </button>
                                        </h2>
                                        <div id="acc-1-2" class="accordion-collapse collapse show">
                                            <div class="accordion-body">
                                                <ul class="grid-container">
                                                    @foreach ($single_project->facilities as $facility)
                                                        <li class="d-flex gap-1 align-items-center">
                                                            <i class="ri-checkbox-circle-fill"></i>
                                                            <span>{{ $facility->facility }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>

    </div>

    <div class="col-lg-3 mt-3 mt-lg-0">
        <div class="view-page__block ">
            <aside class="sidebar">
                {{-- @if(count($single_project->payment_plans))
                <div class="payment-plans">
                    <div class="swiper payments-slider">
                        <div class="swiper-wrapper mb-5">
                            @foreach($single_project->payment_plans as $payment_plan)

                            <div class="swiper-slide">
                                <div class="plan">
                                    <ul class="plan__list">
                                        <li class="plan__list--item">
                                            <span>
                                                {{__('inventory::inventory.down_payment')}}
                                            </span>
                                            <strong>{{$payment_plan->down_payment}}%</strong>
                                        </li>
                                        <li class="plan__list--item">
                                            <span>
                                                {{__('inventory::inventory.installments_years')}}
                                            </span>
                                            <strong>{{$payment_plan->years_of_installments}}</strong>
                                        </li>
                                        <li class="plan__list--item">
                                            <span>
                                                {{__('inventory::inventory.discount')}}
                                            </span>
                                            <strong class="text-danger">{{$payment_plan->discount}}%</strong>
                                        </li>
                                        <li class="plan__list--item">
                                            <span>
                                                {{__('inventory::inventory.delivery_date')}}
                                            </span>
                                            <strong>{{$payment_plan->delivery_date}}</strong>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            @endforeach


                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                @endif --}}
                <ul class="item-contacts justify-content-md-end">
                    <li>
                        <a href="tel:+{{$phone_number}}" class="call" title="Call">
                            <i class="ri-phone-line"></i>
                            <span class="d-none d-sm-block">{{__('main.call_now')}}</span>
                        </a>
                    </li>
                    <li>
                        <a href="https://api.whatsapp.com/send?phone={{ $whatsapp }}" class="whatsapp" title="Chat">
                            <i class="ri-whatsapp-line"></i>
                            <span class="d-none d-sm-block">{{__('main.chat')}}</span>
                        </a>
                    </li>
                    <li>
                        <a href="#contact-modal" class="open-contact-modal visit" data-bs-toggle="modal"
                            data-bs-whatever="visit" title="Visit">
                            <i class="ri-building-4-line"></i>
                            <span class="d-none d-sm-block" data-title="Request A visit!">{{__('inventory::inventory.request_visit')}}</span>
                        </a>
                    </li>
                </ul>
            </aside>
        </div>
    </div>
</div>

@if (count($relates))
    <div class="mt-5">
        <div class="section-title">
            <h4 class="title">{{__('main.related_projects')}}</h4>
        </div>
        <div class="swiper projects-slider">
            <div class="swiper-pagination"></div>

            <div class="swiper-wrapper py-3 mt-5">
              @foreach ($relates as $project)
                <div class="swiper-slide">
                  @include('front.components.project',['project' => $project])
                </div>
              @endforeach


            </div>

            <div class="swiper-button-next proj-next-btn"></div>
            <div class="swiper-button-prev proj-prev-btn"></div>
        </div>
    </div>
@endif
</div>
</section>





@endsection

@php
$images = [];
if ($single_project->attachments) {
foreach ($single_project->attachments as $attch) {
array_push($images, $attch->url);
}
}
@endphp
@push('scripts')
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Product",
        "name": "{{ $single_project->project }}",
        "image": @json($images),
        "description": "{{ $single_project->meta_description }}",
        "sku": "{{ $single_project->id }}",
        "mpn": "{{ $single_project->id }}",
        "brand": {
            "@type": "Brand",
            "name": "{{ $single_project->developer ? $single_project->developer->developer : 'advisors Properties' }}"
        },
        "review": {
            "@type": "Review",
            "reviewRating": {
                "@type": "Rating",
                "ratingValue": "4",
                "bestRating": "5"
            },
            "author": {
                "@type": "Organization",
                "name": "advisors Properties"
            }
        },
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.4",
            "reviewCount": "89"
        },
        "offers": {
            "@type": "Offer",
            "url": "{{ Request::fullUrl() }}",
            "priceCurrency": "EGP",
            "price": "{{ $single_project->price_from_for_schema }}",
            "priceValidUntil": "{{ $single_project->delivery_date_for_schema }}",
            "itemCondition": "https://schema.org/UsedCondition",
            "availability": "https://schema.org/InStock"
        }
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_KEY') }}&callback=initMapProduct&&libraries=places"
                defer></script>
        <script>
            function initMapProduct() {
                var latLng = {
                    lat: {{ $single_project->latitude }},
                    lng: {{ $single_project->longitude }}
                }; // latitude and longitude

                var map;

                var options = {
                    zoom: 15,
                    center: latLng,
                    mapTypeId: 'roadmap', // hybrid , satellite , roadmap ,
                    // panControl: true,
                    // zoomControl: true,
                    // disableDefaultUI: true,
                    // mapTypeControl: true,
                    // scaleControl: true,
                    // streetViewControl: true,
                    // overviewMapControl: true,
                    // rotateControl: true,
                };

                map = new google.maps.Map(document.getElementById("map"), options);

                var marker = new google.maps.Marker({
                    position: latLng,
                    map: map,
                    icon: `http://maps.google.com/mapfiles/ms/icons/red-dot.png`,
                    animation: google.maps.Animation.BOUNCE,
                    title: '{{ $single_project->project }}'
                });

                var infoWindow = new google.maps.InfoWindow({
                    content: '<p>{{ $single_project->project }}</p>'
                })

                var infoWindowAccordion = new google.maps.InfoWindow({
                    content: '<p>{{ $single_project->project }}</p>'
                })

                marker.addListener('click', function() {
                    infoWindow.open(map, marker);
                });

                google.maps.event.addListener(marker, 'click', function() {
                    var pos = map.getZoom();
                    map.setZoom(12);
                    map.setCenter(marker.getPosition());
                    window.setTimeout(function() {
                        map.setZoom(pos);
                    }, 3000);
                });

            }
        </script>
@endpush
