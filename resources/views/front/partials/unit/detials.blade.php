<div class="wrapper__block">
    <h2 class="wrapper__block--title" itemprop="{{ $single_unit->title }}">{{ $single_unit->title }}
        @if ($single_unit->project)
            @if ($single_unit->project->developer)
                {{ __('main.by') }} {{ $single_unit->project->developer->developer_name }}
            @endif
        @endif
        <span>{{ $single_unit->purpose_type }}</span>
    </h2>
    <p class="wrapper__block--loc" itemscope itemtype="https://schema.org/Place">
        @if ($single_unit->city)
            <a class="d-block"
                href="{{ route('front.areas.show', ['id' => $single_unit->city->id,'slug' => str_slug($single_unit->city->default_value)]) }}">
                <i class="fas fa-map-marker-alt"></i>
                <span itemprop="{{ $single_unit->title }}">
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
                </span>
            </a>
        @endif
    </p>
</div>

<div class="wrapper__block">
    <nav class="menu-share-media">
        <!-- <label>
            {{ __('main.share_with') }} :
        </label> -->
        <a target="_blank"
            href="https://www.facebook.com/sharer/sharer.php?u={{ route('front.singleUnit', ['id' => $single_unit->id, 'title' => str_slug($single_unit->default_title)]) }}"
            class="facebook"><i class="fab fa-facebook-f"></i> </a>
        <a target="_blank"
            href="https://twitter.com/intent/tweet?text={{ route('front.singleUnit', ['id' => $single_unit->id, 'title' => str_slug($single_unit->default_title)]) }}"
            class="twitter twitter-share-button"><i class="fab fa-twitter"></i></a>
        <!-- <a href="#" class="instagram">
                <i class="fab fa-instagram"></i>
                instagram

            </a> -->
        <a target="_blank"
            href="https://www.linkedin.com/shareArticle/?mini=true&url={{ route('front.singleUnit', ['id' => $single_unit->id, 'title' => str_slug($single_unit->default_title)]) }}"
            class="linkedin">
            <i class="fab fa-linkedin-in"></i>
        </a>

        <a target="_blank"
            href="http://pinterest.com/pin/create/bookmarklet/?url={{ route('front.singleUnit', ['id' => $single_unit->id, 'title' => str_slug($single_unit->default_title)]) }}"
            class="pinterest">
            <i class="fab fa-pinterest-p"></i>
        </a>

    </nav>
</div>

<div class="unit-details">
    <ul>
        @if ($single_unit->project)
            <li itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                <span>{{ __('inventory::inventory.price') }}: </span>
                <label itemprop="price"
                    content=" {{ $single_unit->project->price_from }} ~ {{ $single_unit->project->price_to }}  {{ $single_unit->project->currency_code }}">
                    {{ $single_unit->price }}
                    <bdi><small itemprop="priceCurrency"
                            content="{{ $single_unit->currency_code }}">{{ $single_unit->currency_code }}</small></bdi>
                </label>
            </li>
            <li>
                <span>{{ __('inventory::inventory.area') }}: </span>
                <label>{{ $single_unit->area }} {{ $single_unit->area_unit }}</label>
            </li>
        @else
            <li itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                <span>{{ __('inventory::inventory.price') }}: </span>
                <label itemprop="price" content=" {{ $single_unit->price }} {{ $single_unit->currency_code }}">
                    {{ $single_unit->price }} {{ $single_unit->currency_code }}
                    <bdi><small itemprop="priceCurrency"
                            content="{{ $single_unit->currency_code }}">{{ $single_unit->currency_code }}</small></bdi>
                </label>
            </li>
            <li>
                <span>{{ __('inventory::inventory.area') }}: </span>
                <label>{{ $single_unit->area }} {{ $single_unit->area_unit }}</label>
            </li>

        @endif
        <li>
            <span>{{ __('inventory::inventory.bedrooms') }}: </span>
            <label>{{ $single_unit->bedroom }}</label>
        </li>
        <li>
            <span>{{ __('inventory::inventory.bathrooms') }}: </span>
            <label>{{ $single_unit->bathroom }}</label>
        </li>
        <li>
            <span>{{ __('inventory::inventory.offering_type') }}: </span>
            <label>{{ $single_unit->offering_type }}</label>
        </li>
        <li>
            <span>{{ __('inventory::inventory.payment_method') }}: </span>
            <label>{{ $single_unit->payment_method }}</label>
        </li>
        <li>
            <span>{{ __('inventory::inventory.finishing_type') }}: </span>
            <label>{{ $single_unit->finishing_type }}</label>
        </li>
        <li>
            <span>{{ __('inventory::inventory.furnishing_status') }}: </span>
            <label>{{ $single_unit->furnishing_status }}</label>
        </li>
        <li>
            <span>{{ __('locations::location.location') }}: </span>
            <label> <?php $locations_array = []; ?>
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
            </label>
        </li>
    </ul>
</div>
@if ($single_unit->tags)
    <div class="wrapper__block">
        <div class="wrapper__block--tags">
            <!-- <h3 class="wrapper__block--title">{{ __('main.tags') }}</h3> -->
            <div class="tags-sec mt-3">
                @foreach ($single_unit->tags as $tag)
                    <span class="tag">{{ $tag->tag }}</span>
                @endforeach
            </div>
        </div>
    </div>
@endif

@if ($single_unit->description)
    <div class="wrapper__block">
        <h3 class="wrapper__block--title">{{ __('main.description') }}</h3>
        <div class="wrapper__block--desc">
            <p itemprop="description" itemprop="description">
                {!! $single_unit->description !!}
            </p>

        </div>
    </div>
@endif

@if ($single_unit->amenities || $single_unit->facilities)

    <div class="wrapper__block">
        <h3 class="wrapper__block--title">{{ __('inventory::inventory.facilities_and_amenities') }}</h3>
        <div class="wrapper__block--list">
            <ul>
                <div class="row">
                    @foreach ($single_unit->amenities as $amenity)
                        <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6">
                            <li>
                                <svg width="20" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $amenity->amenity }}
                            </li>
                        </div>
                    @endforeach
                    @foreach ($single_unit->facilities as $facility)
                        <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6">
                            <li>
                                <svg width="20" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $facility->facility }}
                            </li>
                        </div>
                    @endforeach
                </div>
            </ul>
        </div>
    </div>
@endif

@include('front.partials.unit.accordion')
