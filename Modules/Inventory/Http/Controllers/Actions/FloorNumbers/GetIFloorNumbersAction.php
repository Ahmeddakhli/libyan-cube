<?php

namespace Modules\Inventory\Http\Controllers\Actions\FloorNumbers;

use Cache;
use Modules\Inventory\IFloorNumber;
use Modules\Inventory\Http\Resources\IFloorNumberResource;
use App;

class GetIFloorNumbersAction
{
    public function execute()
    {
        return Cache::rememberForever('inventory_module_floor_numbers_'.App::getLocale(), function () {
            $i_floor_numbers = IFloorNumber::all();

            // Transform the i_floor_numbers
            $i_floor_numbers = IFloorNumberResource::collection($i_floor_numbers);

            return $i_floor_numbers;
        });
    }
}
