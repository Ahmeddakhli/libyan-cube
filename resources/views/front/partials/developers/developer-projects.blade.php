<div class="row mt-5">
    <div class="col-lg-9 m-auto">
        <h2 class="title-dev mb-4 text-capitalize">{{__('main.developer_projects')}}</h2>
        @foreach($developer['projects'] as $project)
	        @include('front.components.project', ['project' => $project])
        @endforeach

        @if($developer['projects']->hasPages())
	        {{$developer['projects']->links('front.components.pagination')}}
        @endif
    </div>
</div>