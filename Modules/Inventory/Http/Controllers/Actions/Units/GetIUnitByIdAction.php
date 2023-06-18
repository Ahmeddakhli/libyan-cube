<?php

namespace Modules\Inventory\Http\Controllers\Actions\Units;

use Modules\Inventory\IUnit;
use App\User;
use Modules\Inventory\Http\Resources\IUnitResource;

class GetIUnitByIdAction
{
    public function execute($id)
    {
        // Get the i_unit
        $i_unit = IUnit::find($id);

        if ($i_unit) {
            
            $i_unit  =  new IUnitResource($i_unit);
        } else {
            return null;
        }

        return $i_unit;
    }
}
