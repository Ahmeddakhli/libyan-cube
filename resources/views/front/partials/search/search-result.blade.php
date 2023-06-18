@foreach($results as $result)
    @if($result->class == 'Modules\Inventory\IProject')
        @include('front.components.project', ['project' => $result->object])
    @endif

    @if($result->class =='Modules\Inventory\IUnit')
        @include('front.components.unit', ['unit' => $result->object])
    @endif
@endforeach

@if($results->hasPages())
    {{$results->appends(request()->input())->links('front.partials.primary.pagination')}}
@endif
