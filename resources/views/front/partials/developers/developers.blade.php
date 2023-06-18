<nav aria-label="breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('front.home') }}">{{ __('main.home_title') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('inventory::inventory.developers') }}</li>
        </ol>
    </div>
</nav>
<section class="devs-page pt-3 pb-5">
    <div class="container">

        <div class="dev-search">
            <form action="{{ route('front.developers') }}" method="GET">
                <div class="row mb-4">
                    <div class="col-lg-4 col-md-5 mb-3">
                        <div class="form-group">
                            <input class="form-control" value="{{ request('keyword') }}" type="text" name="keyword"
                                placeholder="Developer">
                        </div>
                    </div>
                    {{-- <div class="col-lg-4 col-md-5 mb-3">
                  <select class="form-select dd-select" data-filter="true" placeholder="Location">
                    <option></option>
                    <option>cairo</option>
                    <option>Giza</option>
                    <option>North coast</option>
                  </select>
                </div> --}}
                    <div class="col-lg-4 col-md-5 mb-3">
                        <button type="submit" class="site-btn h-100">
                            <i class="ri-search-line"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="grid-container">
            @foreach ($developers as $developer)
                @include('front.components.developer', ['developer' => $developer])
            @endforeach
        </div>

        @if($developers->hasPages())
          {{$developers->links('front.partials.primary.pagination')}}
        @endif

    </div>
</section>

@push('scripts')
@endpush
