@foreach($projects as $key => $project)
    @include('front.components.project', ['project' => $project])
@endforeach

@if($projects->hasPages())
    {{$projects->appends(request()->input())->links('front.components.pagination')}}
@endif
