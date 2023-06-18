@section('title', trans('main.favourite_units'))

<nav id="breadcrumb" class='mb-3'>
    <ul>
        <li><a href="{{route('front.home')}}">
                <ion-icon name="home-outline"></ion-icon>
            </a></li>
        <li class="active"><a>{{__('main.fav_units')}}</a></li>
    </ul>
</nav> <!-- #/ breadcrumb-->

<div class="user-wrapper my-fav-props-wrapper">
    <div class="row">
        <div class="col-xl-8">
            @foreach($favorites as $unit)
                @include('front.components.unit', ['unit' => $unit])
            @endforeach

            @if($favorites->hasPages())
                {{$favorites->links('front.components.pagination')}}
            @endif
        </div> <!-- ./ col-xl-8 -->

        @include('front.partials.profile.side-bar')
        <!-- ./ col-xl-4 mt-5 mt-xl-0 -->
    </div> <!-- ./ row -->
</div>