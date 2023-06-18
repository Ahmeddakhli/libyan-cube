<!-- hero-banner --->
<div class='hero-banner'>
    <div class="hero-banner__img">
        @foreach ($sliders as $slider)
            <img src="{{ URL::asset('storage/' . $slider->image) }}" alt="{{ $slider->title }}" />
            @break
        @endforeach
    </div>

    <!-- filter-holder --->
    {{-- <div class="filter-holder hero-banner__filter">
        @include('front.components.search-box')
    </div> --}}

</div>
