<?php

namespace Modules\Inventory\Http\Controllers\Actions\Facilities;

use Cache;
use Modules\Inventory\IFacility;
use Modules\Inventory\Http\Resources\IFacilityResource;
use App;

class GetIFacilitiesAction
{
    public function execute()
    {
        return Cache::rememberForever('inventory_module_facilities_'.App::getLocale(), function() {
            $i_facilities = IFacility::with('translations')->get();

            // Transform the i_facilities
            $i_facilities = IFacilityResource::collection($i_facilities);

            return $i_facilities;
        });
    }
}