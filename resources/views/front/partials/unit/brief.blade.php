<div class="brief">
    <div class="row mb-3 align-items-center">
        <div class="col-sm-6 sp_title">
            <!-- Title -->
            <h4 class="text-capitalize"><strong>{{$single_unit->title}}</strong></h4>

            <!-- Location -->
            <?php $locations_array = array(); ?>
            @if ($single_unit->country)
                <?php array_push($locations_array, $single_unit->country->name) ?>
            @endif
            @if ($single_unit->region)
                <?php array_push($locations_array, $single_unit->region->name) ?>
            @endif
            @if ($single_unit->city)
                <?php array_push($locations_array, $single_unit->city->name) ?>
            @endif
            @if ($single_unit->area_place)
                <?php array_push($locations_array, $single_unit->area_place->name) ?>
            @endif
            @if (count($locations_array))
                <h6 class="text-capitalize">
                    {{ implode(', ', $locations_array) }}
                </h6>
            @endif
        </div>

        <!-- Full Price -->
        @if($single_unit->price)
            <div class="col-sm-6 mt-3 mt-sm-0 sp_price text-sm-right">
                    <p>{{__('main.guide_price')}}</p><strong>{{$single_unit->price}} {{$single_unit->currency_code}}</strong>
            </div>
        @endif
    </div> <!-- ./ row mb-3 align-items-center-->
</div>