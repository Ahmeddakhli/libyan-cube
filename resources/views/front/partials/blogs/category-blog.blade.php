@if(count($blogs))
<div class="grid-container">
    @foreach ($blogs as $blog)
        @include('front.components.blog')
    @endforeach
    
</div>
    <div class="blogs-paginate">
        @if ($blogs->hasPages())
            {{ $blogs->appends(request()->input())->links('front.partials.primary.pagination') }}
        @endif
    </div>


@else
 <p> No Results found</p>
@endif