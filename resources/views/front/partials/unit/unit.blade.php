@php
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
<!-- START BREADCRUMB -->
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('front.home') }}">{{ __('main.home_title') }}</a></li>
                <li class="breadcrumb-item" aria-current="page"><a
                        href="{{ route('front.properties') }}">{{ __('main.properties') }}</a></li>
                @if ($single_unit->city)
                    <li class="breadcrumb-item" aria-current="page"><a
                            href="{{ route('front.areas.show', ['id' => $single_unit->city->id, 'slug' => str_slug($single_unit->city->default_value)]) }}">{{ $single_unit->city->name }}</a>
                    </li>
                @endif
                @if ($single_unit->project)
                    <li class="breadcrumb-item" aria-current="page"><a
                            href="{{ route('front.singleProject', ['id' => $single_unit->project->id, 'slug' => str_slug($single_unit->project->default_value)]) }}">{{ $single_unit->project->project ? $single_unit->project->project : $single_unit->project->default_value }}</a>
                    </li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">{{ $single_unit->title }}</li>

            </ol>
        </div>
    </nav>
@endsection

<section class="view-page pb-5" itemscope itemtype="http://schema.org/Product">
    <div class="container">

        <div class="row gx-2">
            <div class="col-lg-9">
                <div class="view-page__block">
                    <div class="sticky-holder sticky-top">
                        <nav class="navbar p-0">
                            <ul class="nav nav-pills spy-links">
                                @if (count($single_unit->attachments) || $single_unit->video || $single_unit->images)
                                    <li class="nav-item">
                                        <a class="nav-link spy-link d-inline-flex align-items-center gap-1"
                                            href="#" data-scroll="sec-1">
                                            <i class="ri-gallery-fill"></i> {{ __('main.gallary') }}
                                        </a>
                                    </li>
                                @endif
                                @if ($single_unit->description ||
                                    $single_unit->price ||
                                    $single_unit->area ||
                                    $single_unit->bedroom ||
                                    $single_unit->bathroom ||
                                    $single_unit->offering_type ||
                                    $single_unit->furnishing_status ||
                                    $single_unit->finishing_type ||
                                    $single_unit->city)
                                    <li class="nav-item">
                                        <a class="nav-link spy-link d-inline-flex align-items-center gap-1"
                                            href="#" data-scroll="sec-2">
                                            <i class="ri-information-line"></i> {{ __('main.unit_details') }}
                                        </a>
                                    </li>
                                @endif


                                @if (count($single_unit->floor_plans))
                                    <li class="nav-item">
                                        <a class="nav-link spy-link d-inline-flex align-items-center gap-1"
                                            href="#" data-scroll="sec-3">
                                            <i class="ri-layout-masonry-line"></i>
                                            {{ __('inventory::inventory.floor_plans') }}
                                        </a>
                                    </li>
                                @endif
                                @if (count($single_unit->master_plans))
                                    <li class="nav-item">
                                        <a class="nav-link spy-link d-inline-flex align-items-center gap-1"
                                            href="#" data-scroll="sec-master">
                                            <i class="ri-layout-masonry-line"></i>
                                            {{ __('inventory::inventory.master_plans') }}
                                        </a>
                                    </li>
                                @endif

                                @if ($single_unit->latitude && $single_unit->longitude)
                                    <li class="nav-item">
                                        <a class="nav-link spy-link d-inline-flex align-items-center gap-1"
                                            href="#" data-scroll="sec-4">
                                            <i class="ri-map-pin-line"></i> {{ __('main.location') }}
                                        </a>
                                    </li>
                                @endif
                                @if ($single_unit->amenities || $single_unit->facilities)
                                    <li class="nav-item">
                                        <a class="nav-link spy-link d-inline-flex align-items-center gap-1"
                                            href="#" data-scroll="sec-5">
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
                                <h1 class="title h5" itemprop="name">{{ $single_unit->title }}</h1>
                            </div>
                        </div>
                        @if ($single_unit->price)
                            <div class="col-md-6 text-md-end mt-2 mt-md-0">
                                <div class="item-price">
                                    <p>
                                        <span class="label">{{ __('main.price') }}:</span>
                                        <strong>{{ $single_unit->price }}</strong>
                                        <small>EGP</small>
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>

                    @if ($single_unit->tags)
                        <div class="item-labels">
                            @foreach ($single_unit->tags as $tag)
                                <a href="{{ route('front.properties', ['tag_id' => $tag->id]) }}"
                                    class="tag type">{{ $tag->tag }}</a>
                            @endforeach
                        </div>
                    @endif
                    @if ($single_unit->city)
                        <div class="item-address">
                            <address itemscope itemtype="https://schema.org/Place">
                                <i class="ri-map-pin-line"></i>
                                <span itemprop="name"><?php $locations_array = []; ?>
                                    @if ($single_unit->country)
                                        <?php array_push($locations_array, $single_unit->country->name); ?>
                                    @endif
                                    @if ($single_unit->region)
                                        <?php array_push($locations_array, $single_unit->region->name); ?>
                                    @endif
                                    @if ($single_unit->city)
                                        <?php array_push($locations_array, $single_unit->city->name); ?>
                                    @endif
                                    @if ($single_unit->area_place)
                                        <?php array_push($locations_array, $single_unit->area_place->name); ?>
                                    @endif
                                    @if (count($locations_array))
                                        <h6 class="text-capitalize">
                                            {{ implode(', ', $locations_array) }}
                                        </h6>
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
                            @if ($single_unit->video)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link d-inline-flex align-items-center gap-1"
                                        data-bs-toggle="pill" data-bs-target="#tab-3" type="button" role="tab"
                                        aria-selected="false">
                                        <i class="ri-live-line"></i> {{ __('main.video') }}
                                    </button>
                                </li>
                            @endif
                            @if ($single_unit->images)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link d-inline-flex align-items-center gap-1"
                                        data-bs-toggle="pill" data-bs-target="#tab-4" type="button" role="tab"
                                        aria-selected="false">
                                        <i class="ri-image-2-line"></i> 360&#176;
                                    </button>
                                </li>
                            @endif
                            <li class="nav-indicator"></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-1" role="tabpanel">
                                <div class="gallery-large-holder position-relative">
                                    @if ($single_unit->project)
                                        <div class="dev-logo">
                                            @if ($single_unit->project->developer)
                                                @forelse($single_unit->project->developer->attachments as $attachment)
                                                    @if ($loop->index == 0)
                                                        <img class="img-thumbnail" onerror="this.remove()"
                                                            src="{{ file_exists(public_path('/storage/dimensions/uploads/' . $attachment->file_name_without_extension . '_125x125' . '.' . $attachment->extension)) ? asset('storage/dimensions/uploads/' . $attachment->file_name_without_extension . '_125x125' . '.' . $attachment->extension) : $attachment->url }}"
                                                            alt="{{ $attachment->file_name }}" itemprop="logo">
                                                    @break
                                                @endif
                                            @empty
                                                <img class="img-thumbnail" onerror="this.remove()"
                                                    src="{{ URL::asset('front/images/placeholder.png') }}"
                                                    alt="{{ $single_unit->project->developer->developer_name }}"
                                                    itemprop="logo">
                                            @endforelse
                                        @endif
                                    </div>
                                @endif
                                <div class="user-actions">

                                    <div>
                                        <nav class="position-relative">
                                            <input type="checkbox" class="visually-hidden toggle-action-input"
                                                id="share-input">

                                            <label class="toggle-action-label toggle-share-label"
                                                for="share-input" title='Share this property'></label>

                                            <div class="social-links share-links">
                                                <a target="_blank"
                                                    href="https://www.facebook.com/sharer/sharer.php?u={{ route('front.singleUnit', ['id' => $single_unit->id, 'title' => str_slug($single_unit->default_title)]) }}"
                                                    class="social-link facebook-link" title='Messenger'
                                                    style="--delay: 0.1s">
                                                    <i class="ri-messenger-fill"></i>
                                                </a>

                                                <a target="_blank"
                                                    href="https://api.whatsapp.com/send?text={{ route('front.singleUnit', ['id' => $single_unit->id, 'title' => str_slug($single_unit->default_title)]) }}"
                                                    class="social-link whatsapp-link" title='WhatsApp'
                                                    style="--delay: 0.15s">
                                                    <i class="ri-whatsapp-fill"></i>
                                                </a>

                                                <a target="_blank"
                                                    href="https://twitter.com/intent/tweet?text={{ route('front.singleUnit', ['id' => $single_unit->id, 'title' => str_slug($single_unit->default_title)]) }}"
                                                    class="social-link twitter-link" title='Twitter'
                                                    style="--delay: 0.2s">
                                                    <i class="ri-twitter-fill"></i>
                                                </a>

                                                <a target="_blank"
                                                    href="http://pinterest.com/pin/create/bookmarklet/?url={{ route('front.singleUnit', ['id' => $single_unit->id, 'title' => str_slug($single_unit->default_title)]) }}"
                                                    class="social-link pinterest-link" title='Pinterest'
                                                    style="--delay: 0.25s">
                                                    <i class="ri-pinterest-fill"></i>
                                                </a>

                                                <a target="_blank"
                                                    href="https://www.linkedin.com/shareArticle/?mini=true&url={{ route('front.singleUnit', ['id' => $single_unit->id, 'title' => str_slug($single_unit->default_title)]) }}"
                                                    class="social-link linkedin-link" title='Linkedin'
                                                    style="--delay: 0.3s">
                                                    <i class="ri-linkedin-fill"></i>
                                                </a>

                                                <a href="{{ route('front.singleUnit', ['id' => $single_unit->id, 'title' => str_slug($single_unit->default_title)]) }}"
                                                    class="social-link copy-page-link"
                                                    title='Copy link to your clipboard' style="--delay: 0.35s">
                                                    <i class="ri-link"></i>
                                                    <span class="page-url">Page link copied!</span>
                                                </a>
                                            </div>
                                        </nav>
                                    </div>

                                </div>

                                @if (count($single_unit->attachments))
                                    <div class="swiper gallery-large" style="">
                                        <div class="swiper-wrapper gallery-holder">
                                            @foreach ($single_unit->attachments as $attachment)
                                                <div class="swiper-slide">
                                                    <div class="item">

                                                        <meta itemprop="{{ $single_unit->title }}"
                                                            content="{{ $attachment->url }}" />
                                                        <a href="{{ $attachment->url }}" class="mgf-link">
                                                            <img src="{{ $attachment->url }}"
                                                                alt="{{ $attachment->alt }}">
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
                            @if (count($single_unit->attachments))
                                <div class="swiper gallery-thumbs">

                                    <div class="swiper-wrapper">
                                        @foreach ($single_unit->attachments as $attachment)
                                            <div class="swiper-slide">
                                                <div class="item">
                                                    <img src="{{ $attachment->url }}"
                                                        itemprop="{{ $single_unit->title }}"
                                                        alt="{{ $single_unit->title }}">
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>

                                </div>
                            @endif

                        </div>
                        @if ($single_unit->video)
                            <div class="tab-pane fade" id="tab-3" role="tabpanel">
                                <div class="video tab-block">
                                    <div class="ratio ratio-21x9">
                                        {!! $single_unit->video !!}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($single_unit->images)
                            <div class="tab-pane fade" id="tab-4" role="tabpanel">
                                <div class="panorama tab-block">
                                    <div class="swiper panorama-slider">
                                        <div class="swiper-wrapper mb-5">
                                            @foreach ($single_unit->images as $image)
                                                <div class="swiper-slide">
                                                    <div class="item">
                                                        <div class="ratio ratio-21x9">
                                                            <iframe src="{{ $image->link }}"
                                                                allowfullscreen="allowfullscreen"></iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="swiper-button-next panorama-next-btn"></div>
                                        <div class="swiper-button-prev panorama-prev-btn"></div>
                                        <div class="swiper-pagination"></div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>

                <div id="sec-2" class="spy-section mt-5 py-3">

                    <div class="item-description">
                        <div class="section-title">
                            <h4 class="title">{{ __('main.details') }}</h4>
                        </div>
                        <p itemprop="description">
                            {!! $single_unit->description !!}
                        </p>

                        <div class="details mt-4">
                            <ul class="details__list">

                                @if ($single_unit->price)
                                    <li class="details__list--item" itemscope itemtype="https://schema.org/Offer">
                                        <span class="label">
                                            {{ __('main.price') }}:
                                        </span>
                                        <strong itemprop="price">
                                            {{ $single_unit->price }}
                                            <small itemprop="priceCurrency" content="EGP">EGP</small>
                                        </strong>
                                    </li>
                                @endif
                                @if ($single_unit->area)
                                    <li class="details__list--item">
                                        <span class="label">
                                            {{ __('main.area') }}:
                                        </span>
                                        <strong>
                                            <bdi>
                                                <span>{{ $single_unit->area }}</span>
                                            </bdi>
                                        </strong>
                                    </li>
                                @endif
                                @if ($single_unit->bedroom)
                                    <li class="details__list--item">
                                        <span class="label">
                                            {{ __('inventory::inventory.bedrooms') }}:
                                        </span>
                                        <strong>{{ $single_unit->bedroom }}</strong>
                                    </li>
                                @endif
                                @if ($single_unit->bathroom)
                                    <li class="details__list--item">
                                        <span class="label">
                                            {{ __('inventory::inventory.bathrooms') }}:
                                        </span>
                                        <strong>{{ $single_unit->bathroom }}</strong>
                                    </li>
                                @endif
                                @if ($single_unit->offering_type)
                                    <li class="details__list--item">
                                        <span class="label">
                                            {{ __('inventory::inventory.offering_type') }}:
                                        </span>
                                        <strong>{{ $single_unit->offering_type }}</strong>
                                    </li>
                                @endif

                                {{-- <li class="details__list--item">
                                    <span class="label">
                                        {{Status}}:
                                    </span>
                                    <strong>Only 2 left</strong>
                                </li> --}}
                                @if ($single_unit->furnishing_status)
                                    <li class="details__list--item">
                                        <span class="label">
                                            {{ __('inventory::inventory.furnishing_status') }}:
                                        </span>
                                        <strong>{{ $single_unit->furnishing_status }}</strong>
                                    </li>
                                @endif


                                @if ($single_unit->finishing_type)
                                    <li class="details__list--item">
                                        <span class="label">
                                            {{ __('inventory::inventory.finished_status') }}:
                                        </span>
                                        <strong>{{ $single_unit->finishing_type }}</strong>
                                    </li>
                                @endif
                                @if ($single_unit->city)
                                    <li class="details__list--item">
                                        <span class="label">
                                            {{ __('main.location') }}:
                                        </span>
                                        <strong>
                                            <?php $locations_array = []; ?>
                                            @if ($single_unit->country)
                                                <?php array_push($locations_array, $single_unit->country->name); ?>
                                            @endif
                                            @if ($single_unit->region)
                                                <?php array_push($locations_array, $single_unit->region->name); ?>
                                            @endif
                                            @if ($single_unit->city)
                                                <?php array_push($locations_array, $single_unit->city->name); ?>
                                            @endif
                                            @if ($single_unit->area_place)
                                                <?php array_push($locations_array, $single_unit->area_place->name); ?>
                                            @endif
                                            @if (count($locations_array))
                                                {{ implode(', ', $locations_array) }}
                                            @endif
                                        </strong>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>

                </div>

                @if ($single_unit->floor_plans)
                    <div id="sec-3" class="spy-section py-3">
                        <div class="item-plans tab-block">
                            <div class="section-title">
                                <h4 class="title">{{ __('inventory::inventory.floor_plans') }}</h4>
                            </div>
                            <div class="swiper gallery-plans-slider">
                                <div class="swiper-wrapper mb-5 gallery-holder">
                                    @foreach ($single_unit->floor_plans as $floor_plan)
                                        <div class="swiper-slide">
                                            <div class="item">
                                                <a href="{{ $floor_plan->url }}" class="popup-link">
                                                    <img src="{{ $floor_plan->url }}"
                                                        alt="{{ $floor_plan->file_name }}">
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                    </div>
                @endif
                @if ($single_unit->master_plans)
                    <div id="sec-master" class="spy-section py-3">
                        <div class="item-plans tab-block">
                            <div class="section-title">
                                <h4 class="title">{{ __('inventory::inventory.master_plans') }}</h4>
                            </div>
                            <div class="swiper gallery-plans-slider">
                                <div class="swiper-wrapper mb-5 gallery-holder">
                                    @foreach ($single_unit->master_plans as $master_plan)
                                        <div class="swiper-slide">
                                            <div class="item">
                                                <a href="{{ $master_plan->url }}" class="popup-link">
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
                @endif

                <div id="sec-4" class="spy-section py-3">
                    <div class="map-loc tab-block">
                        <div class="section-title">
                            <h4 class="title">{{ __('main.location') }}</h4>
                        </div>
                        <div class="ratio ratio-21x9" id="map">
                        </div>
                    </div>
                </div>

                @if ($single_unit->amenities || $single_unit->facilities)
                    <div id="sec-5" class="spy-section py-3">
                        <div class="section-title">
                            <h4 class="title">{{ __('inventory::inventory.facilities_and_amenities') }}</h4>
                        </div>
                        <div class="accordion item-features">
                            <div class="row g-3">
                                @if ($single_unit->amenities)
                                    <div class="col-md-6">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#acc-1"
                                                    aria-expanded="true">
                                                    {{ __('inventory::inventory.amenities') }}
                                                </button>
                                            </h2>

                                            <div id="acc-1" class="accordion-collapse collapse show">
                                                <div class="accordion-body">
                                                    <ul class="grid-container">
                                                        @foreach ($single_unit->amenities as $amenity)
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
                                @if ($single_unit->facilities)
                                    <div class="col-md-6">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#acc-2"
                                                    aria-expanded="true">
                                                    {{ __('inventory::inventory.facilities') }}
                                                </button>
                                            </h2>
                                            <div id="acc-2" class="accordion-collapse collapse show">
                                                <div class="accordion-body">
                                                    <ul class="grid-container">
                                                        @foreach ($single_unit->facilities as $facility)
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
                    {{-- @if (count($single_unit->payment_plans))
                        <div class="payment-plans">
                            <div class="swiper payments-slider">
                                <div class="swiper-wrapper mb-5">
                                    @foreach ($single_unit->payment_plans as $payment_plan)
                                        <div class="swiper-slide">
                                            <div class="plan">
                                                <ul class="plan__list">
                                                    <li class="plan__list--item">
                                                        <span>
                                                            {{ __('inventory::inventory.down_payment') }}
                                                        </span>
                                                        <strong>{{ $payment_plan->down_payment }}%</strong>
                                                    </li>
                                                    <li class="plan__list--item">
                                                        <span>
                                                            {{ __('inventory::inventory.installments_years') }}
                                                        </span>
                                                        <strong>{{ $payment_plan->years_of_installments }}</strong>
                                                    </li>
                                                    <li class="plan__list--item">
                                                        <span>
                                                            {{ __('inventory::inventory.discount') }}
                                                        </span>
                                                        <strong
                                                            class="text-danger">{{ $payment_plan->discount }}%</strong>
                                                    </li>
                                                    <li class="plan__list--item">
                                                        <span>
                                                            {{ __('inventory::inventory.delivery_date') }}
                                                        </span>
                                                        <strong>{{ $payment_plan->delivery_date }}</strong>
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
                            <a href="tel:+{{ $phone_number }}" class="call" title="Call">
                                <i class="ri-phone-line"></i>
                                <span class="d-none d-sm-block">{{ __('main.call_now') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://api.whatsapp.com/send?phone={{ $whatsapp }}" class="whatsapp"
                                title="Chat">
                                <i class="ri-whatsapp-line"></i>
                                <span class="d-none d-sm-block">{{ __('main.chat') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="#contact-modal" class="open-contact-modal visit" data-bs-toggle="modal"
                                data-bs-whatever="visit" title="Visit">
                                <i class="ri-building-4-line"></i>
                                <span class="d-none d-sm-block" data-title="Request A visit!"> {{__('inventory::inventory.request_visit')}}</span>
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
                <h4 class="title">{{ __('main.related_units') }}</h4>
            </div>
            <div class="swiper units-slider">
                <div class="swiper-pagination"></div>

                <div class="swiper-wrapper py-3 mt-5">
                    @foreach ($relates as $unit)
                        <div class="swiper-slide">
                            @include('front.components.unit', ['unit' => $unit])
                        </div>
                    @endforeach
                </div>

                <div class="swiper-button-next units-next-btn"></div>
                <div class="swiper-button-prev units-prev-btn"></div>
            </div>
        </div>
    @endif
</div>
</section>

@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_KEY') }}&callback=initMap&&libraries=places"
    defer></script>
<script>
    //  GOOGLE MAPS API

    function initMap() {
        var latLng;
        @if ($single_unit->latitude && $single_unit->longitude)
            latLng = {
                lat: @json($single_unit->latitude),
                lng: @json($single_unit->longitude)
            }; // latitude and longitude
        @endif

        var map;

        var options = {
            zoom: 9,
            center: latLng,
            mapTypeId: 'roadmap', // hybrid , satellite , roadmap ,
        };

        map = new google.maps.Map(document.getElementById("map"), options);

        var marker = new google.maps.Marker({
            position: latLng,
            map: map,
            icon: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png',
            animation: google.maps.Animation.BOUNCE,
            title: '{{ $single_unit->title }}'
        });


        var infoWindow = new google.maps.InfoWindow({
            content: '<p>{{ $single_unit->title }}</p>'
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
