<?php

namespace Modules\Inventory\Http\Controllers\Actions\Units;

use Cache;
use Modules\Inventory\IUnit;
use Modules\Inventory\Http\Resources\IUnitResource;

class GetIUnitsAction
{
    public function execute()
    {
        // get i_unit
        $i_units = IUnit::active()->orderBy('price', 'Asc')->get();

        // Transform the i_units
        $i_units = IUnitResource::collection($i_units);

        return $i_units;
    }
}
