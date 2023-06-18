@foreach($compares as $compare)
    <div class="col-xl-12 col-lg-6 col-12">
        <li>
            <!-- Title -->
            <a href="{{route('front.singleUnit', ['id' => $compare->unit->id, 'title' => $compare->unit->default_title])}}">{{$compare->unit->title}}</a>
            <!-- Location -->
            <?php $locations_array = array(); ?>
            @if ($compare->unit->country)
                <?php array_push($locations_array, $compare->unit->country) ?>
            @endif
            @if ($compare->unit->region)
                <?php array_push($locations_array, $compare->unit->region) ?>
            @endif
            @if ($compare->unit->city)
                <?php array_push($locations_array, $compare->unit->city) ?>
            @endif
            @if ($compare->unit->area_place)
                <?php array_push($locations_array, $compare->unit->area_place) ?>
            @endif
            @if (count($locations_array))
                <a href="{{route('front.singleUnit', ['id' => $compare->unit->id, 'title' => $compare->unit->default_title])}}">{{ implode(', ', $locations_array) }}</a>
            @endif
        </li>
    </div>
@endforeach