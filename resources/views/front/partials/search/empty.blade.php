<nav id="breadcrumb" class='mb-3'>
    <ul>
        <li><a href="{{route('front.home')}}">
                <ion-icon name="home-outline"></ion-icon>
            </a></li>
        <li class="active"><a>{{__('main.search')}}</a></li>
    </ul>
</nav> <!-- #/ breadcrumb-->

<h3 class="text-capitalize mb-4">{{__('main.no_search_result')}}</h3>
<div class="row">
	<div class="col-lg-6 mb-5">
	    @include('front.components.contact_form',['type'=>'contact'])
	</div>
</div>
