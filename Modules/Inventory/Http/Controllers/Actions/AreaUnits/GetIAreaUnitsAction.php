<?php

namespace Modules\Inventory\Http\Controllers\Actions\AreaUnits;

use Cache;
use Modules\Inventory\IAreaUnit;
use Modules\Inventory\Http\Resources\IAreaUnitResource;
use App;

class GetIAreaUnitsAction
{
    public function execute()
    {
        return Cache::rememberForever('inventory_module_area_units_'.App::getLocale(), function() {
            $i_area_units = IAreaUnit::all();

            // Transform the i_area_units
            $i_area_units = IAreaUnitResource::collection($i_area_units);

            return $i_area_units;
        });
    }
}