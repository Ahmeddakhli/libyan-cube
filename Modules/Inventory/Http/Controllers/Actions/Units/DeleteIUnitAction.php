<?php

namespace Modules\Inventory\Http\Controllers\Actions\Units;

use Modules\Inventory\IUnit;

class DeleteIUnitAction
{
    public function execute($id)
    {
        // Get the i_unit
        $i_unit = IUnit::find($id);

        // Delete the i_unit
        $i_unit->delete();

        // Return the response
        return null;
    }
}
