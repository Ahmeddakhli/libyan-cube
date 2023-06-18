<?php

namespace Modules\Inventory\Http\Controllers\Actions\Positions;

use Cache;
use Modules\Inventory\IPosition;
use Modules\Inventory\Http\Resources\IPositionResource;
use App;

class GetIPositionsAction
{
    public function execute()
    {
        return Cache::rememberForever('inventory_module_positions_'.App::getLocale(), function () {
            $i_positions = IPosition::all();

            // Transform the i_positions
            $i_positions = IPositionResource::collection($i_positions);

            return $i_positions;
        });
    }
}
