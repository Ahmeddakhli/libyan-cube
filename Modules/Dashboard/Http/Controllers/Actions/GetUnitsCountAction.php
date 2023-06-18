<?php

namespace Modules\Dashboard\Http\Controllers\Actions;

use Modules\Inventory\IUnit;

class GetUnitsCountAction
{
    public function execute()
    {
        // Get Count Units
        $units = IUnit::count();

        return $units;
    }
}
