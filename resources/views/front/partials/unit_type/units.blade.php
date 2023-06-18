<div class="col-xl-8 data-div">
    @foreach($units as $unit)
        @include('front.components.unit')
    @endforeach
    @if($units->hasPages())
        {{$units->appends($_GET)->links('front.components.pagination')}}
    @endif
</div>
