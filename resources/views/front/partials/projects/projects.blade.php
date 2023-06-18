@section('page_name', trans('main.projects'))
@section('breadcrumb')
    <!-- START BREADCRUMB -->
    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('front.home') }}">{{ __('main.home_title') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('main.projects') }}</li>
            </ol>
        </div>
    </nav>
    <!-- END BREADCRUMB -->
@endsection

<section class="index-items index-projects pb-5">

    <div class="container">
        <!-- Search links -->
        <div class="search-links mb-3">
          <ul class="list-group">
              @foreach ($purpose_types_values as $purpose_type_value)
                  <li class="list-group-item">
                      <a
                          href="{{ route('front.properties', ['purpose_type_ids[]' => $purpose_type_value->id]) }}">{{ $purpose_type_value->value }}</a>
                      <span class="badge ">({{ $purpose_type_value->units_count }})</span>
                  </li>
              @endforeach

          </ul>
      </div> 

      <div class="row mb-3"></div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="view-btns-holder">
                    <div class="nav nav-pills nav-with-indicator">
                        <button class="nav-link grid-view-btn active" data-bs-toggle="pill" data-bs-target="#card-view">
                            <i class="ri-layout-grid-line"></i>
                            <span class="d-none d-sm-inline-block">{{ __('main.gallary') }}</span>
                        </button>
                        <button class="nav-link list-view-btn" data-bs-toggle="pill" data-bs-target="#card-view">
                            <i class="ri-list-unordered"></i>
                            <span class="d-none d-sm-inline-block">{{ __('main.list_view') }}</span>
                        </button>
                        <span class="nav-indicator"></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3 text-md-end">
                <div class="sort-filter">
                    <label>{{ __('main.order_by') }}: </label>
                    <select id="sort-select" class="form-select dd-select w-50" onchange="sortProjects($(this).val())">
                        <option value="featured" @if (request('sort') == 'featured') selected @endif>
                            {{ __('main.featured') }}</option>
                        <option value="desc_price" @if (request('sort') == 'desc_price') selected @endif>
                            {{ __('main.most_expensive') }}
                        </option>
                        <option value="asc_price" @if (request('sort') == 'asc_price') selected @endif>
                            {{ __('main.lowest_price') }}</option>
                        <option value="desc_date" @if (request('sort') == 'desc_date') selected @endif>
                            {{ __('main.latest') }}
                            {{ __('main.projects') }}</option>
                        <option value="asc_date" @if (request('sort') == 'asc_date') selected @endif>
                            {{ __('main.the_oldest') }}
                            {{ __('main.projects') }}</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="tab-content">
            <div class="tab-pane show active" id="card-view">
                <div class="grid-wrapper">
                    @if (isset($projects) && count($projects))
                        @foreach ($projects as $project)
                            @include('front.components.project', ['project' => $project])
                        @endforeach
                    @endif
                </div>
            </div>

        </div>

        @if ($projects->hasPages())
            {{ $projects->appends(request()->input())->links('front.partials.primary.pagination') }}
        @endif

        {{-- <div class="related-results mt-5">
        <div class="section-title">
          <h4 class="title">
            MORE PROJECTS WITHIN THE SAME DISTRICT
          </h4>
        </div>

        <div class="swiper devs-slider">

          <div class="swiper-wrapper my-5">

            <div class='swiper-slide'>
              <dev-card img="assets/developers/logo-1.png" data-title="palm hills"></dev-card>
            </div>

            <div class='swiper-slide'>
              <dev-card img="assets/developers/logo-2.png" data-title="tatweer misr"></dev-card>
            </div>

            <div class='swiper-slide'>
              <dev-card img="assets/developers/logo-3.png" data-title="orascom development"></dev-card>
            </div>

            <div class='swiper-slide'>
              <dev-card img="assets/developers/logo-4.png" data-title="mabany edris"></dev-card>
            </div>

            <div class='swiper-slide'>
              <dev-card img="assets/developers/logo-5.png" data-title="nile developments"></dev-card>
            </div>

            <div class='swiper-slide'>
              <dev-card img="assets/developers/logo-6.png" data-title="sodic"></dev-card>
            </div>
          </div>
          
        </div>
      </div> --}}

    </div>
</section>
<!-- END index-page  -->
@push('scripts')
    <script>
        function sortProjects(sort) {
            var url = "{{ route('front.projects', request()->input()) }}";
            @if (!empty(request()->input()))
                url = url + '&sort=' + sort
            @else
                url = url + '?sort=' + sort
            @endif
            url = url.replaceAll('&amp;', '&')

            window.location = url;
        }
    </script>
@endpush
