<?php

namespace Modules\Inventory\Http\Controllers\Actions\Units;

use Modules\Inventory\IUnit;

class IUnitsTagsInputAction
{
    public function execute(array $data)
    {
        $needle = $data['needle'];

        if ($needle) {
            $i_units = IUnit::where('unit_number', 'LIKE', '%' . $needle . '%')->take(50)->get();
        } else {
            $i_units = IUnit::take(50)->get();
        }

        foreach ($i_units as $unit) {
            $unit->name = $unit->unit_number;
        }

        return $i_units;
    }
}
