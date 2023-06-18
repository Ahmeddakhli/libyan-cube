<?php

namespace Modules\Inventory\Http\Controllers\Actions\Units;

use Cache;
use Modules\Inventory\Http\Resources\FooterIUnitMinimalResource;
use Modules\Inventory\IUnit;

class GetFooterIUnitsAction
{
    public function execute()
    {
        // get i_unit
        $i_units = IUnit::active()->select('id', 'price', 'currency_code', 'number_of_installments', 'i_project_id', 'i_purpose_type_id', 'i_area_unit_id', 'i_offering_type_id')->orderBy('id', 'DESC')->take(5)->get();
        $i_units = FooterIUnitMinimalResource::collection($i_units);

        return $i_units;
    }
}
