@section('breadcrumb')
    <nav aria-label="">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('front.home') }}">{{ __('main.home_title') }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('blog::blog.blogs') }}</li>
            </ol>
        </div>
    </nav>
@endsection
<section class="blogs-page pt-3 pb-5">

    <div class="container">
        <div class="row">

            <div class="col-md-6 mb-3">

                <div class="nav nav-pills nav-with-indicator">
                    <button class="nav-link {{ !request('category_id') ? 'active' : '' }}" data-bs-target="#all-cats"
                        data-bs-toggle="pill" aria-selected="true" type="button">{{ __('main.all') }}</button>
                    @foreach ($blog_categories as $blog_category)
                        <button class="nav-link {{(request('category_id') == $blog_category->id ) ? 'active' : '' }}" data-bs-target="#cat-{{ $blog_category->id }}" data-bs-toggle="pill"
                            aria-selected="false"
                            onclick="getCategoryBlogs('cat-{{ $blog_category->id }}','{{ route('front.blogs', ['category_id' => $blog_category->id]) }}')">{{ $blog_category->title }}</button>
                    @endforeach

                    <span class="nav-indicator"></span>
                </div>
            </div>

            <div class="col-md-6 mb-3 text-md-end">
                <form action="">
                    <label>Sort :</label>
                    <select class='form-select dd-select w-50'>
                        <option>Newest</option>
                        <option>Oldest</option>
                    </select>
                </form>
            </div>
        </div>

        <div class="tab-content mt-4">
            <div class="tab-pane fade {{ !request('category_id') ? 'show active' : '' }}" id="all-cats">
                <div class="grid-container">
                    @foreach ($blogs as $blog)
                        @include('front.components.blog', ['blog' => $blog])
                    @endforeach

                </div>
                @if ($blogs->hasPages())
                    {{ $blogs->appends(request()->input())->links('front.partials.primary.pagination') }}
                @endif
            </div>

            @foreach ($blog_categories as $blog_category)
            <div class="tab-pane fade {{ (request('category_id') == $blog_category->id ) ? 'show active' : '' }}" id="cat-{{$blog_category->id}}">
            </div>
            @endforeach

        </div>
    </div>
</section>

@push('scripts')
    <script>
        function getCategoryBlogs(section , url){
            $(`#${section}`).block({
            overlayColor: "#000000",
            type: "loader",
            state: "success",
            message: "<img src='{{ URL::asset('front/images/loader.gif') }}'/>"
        });
        // Send Sell Request 
        $.ajax({
            url: url,
            method: 'GET',
        }).done(function(response) {
            // Un Block UI
            $(`#${section}`).empty().html(response);

            $(`#${section}`).unblock();

        }).fail(function(xhr, error_text, statusText) {
            // Un Block UI
            $(`#${section}`).unblock();
        });
        }

    </script>
    <script>
        $(document).on('click','.page-link',function(e){
            e.preventDefault();
            var url= $(this).attr('href');
            var section= $(this).closest('.tab-pane').attr('id');
            getCategoryBlogs(section,url);
        });
    </script>
    
@endpush
