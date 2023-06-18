<nav aria-label="Page navigation" class="mt-5">
    <ul class="pagination justify-content-center">
        @if ($paginator->onFirstPage())
        <li class="page-item">
            <a href="#" class="page-link disabled">
                {{__('main.sPrevious')}}
            </a>
        </li>
        @else
        <li class="page-item">
            <a href="{{ $paginator->previousPageUrl() }}" class="page-link disabled">
                {{__('main.sPrevious')}}
            </a>
        </li>
        @endif
        @php
        $linksOnEachSlide     = ($paginator->lastPage() < 5) ? $paginator->lastPage() : 5; // Must be an odd number
        $halfLinksOnEachSlide = ($linksOnEachSlide - 1) / 2;
        $startPage            = $paginator->currentPage() - $halfLinksOnEachSlide < 1 ? 1 : ($paginator->currentPage() - $halfLinksOnEachSlide);
        $endPage              = ($paginator->currentPage() + $halfLinksOnEachSlide) > $paginator->lastPage() ? $paginator->lastPage() : ($paginator->currentPage() + $halfLinksOnEachSlide);
        $endPage              = $endPage < $linksOnEachSlide ? $linksOnEachSlide : $endPage;
        $startPage            = $endPage - $linksOnEachSlide < $startPage ? $endPage - ($halfLinksOnEachSlide * 2) : $startPage;
        @endphp
        
        @foreach(range($startPage, $endPage) as $page)
            @if ($page == $paginator->currentPage())
            <li class="page-item">
            <a href="#" class="page-link active">{{ $page }}</a>
        </li>
        @else
        <li class="page-item">
            <a href="{{ $paginator->url($page) }}" class="page-link">{{ $page }}</a>
        </li>
        @endif
        @endforeach

        @if ($paginator->hasMorePages())
        <li class="page-item">
            <a href="{{ $paginator->nextPageUrl() }}" class="page-link">
                {{__('main.next')}} </a>
        </li>
        @else
        <li class="page-item">
            <a href="#" class="page-link disabled">
                {{__('main.next')}} </a>
        </li>
        @endif
    </ul>
</nav>

@push('meta')
@if ($paginator->hasMorePages())
    <link rel="next" href="{{ $paginator->nextPageUrl() }}" />
@endif
@if (!$paginator->onFirstPage())
    <link rel="prev" href="{{ $paginator->previousPageUrl() }}" />
@endif
@endpush
