<?php

namespace Modules\Inventory\Http\Controllers\Actions\Units;

use Cache;
use Modules\Inventory\IUnit;
use Modules\Inventory\Http\Resources\IUnitHomeResource;

class GetFeaturedUnitsAction
{
    public function execute()
    {
        // get i_unit
        $i_units = IUnit::active()->featured()->orderBy('id', 'DESC')->with('translations','project',
        'bedroom',
        'bathroom',
        'floorNumber',
        'purpose',
        'purposeType',
        'country',
        'region',
        'city',
        'areaPlace',
        'buyer',
        'facilities',
        'amenities',
        'attachmentables',
        'attachments',
        'floorPlans',
        'masterPlans',
        'images')->get();

        // Transform the i_units
        $i_units = IUnitHomeResource::collection($i_units);

        return $i_units;
    }
}
