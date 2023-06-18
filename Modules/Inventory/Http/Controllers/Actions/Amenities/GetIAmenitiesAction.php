<?php

namespace Modules\Inventory\Http\Controllers\Actions\Amenities;

use Cache;
use Modules\Inventory\IAmenity;
use Modules\Inventory\Http\Resources\IAmenityResource;
use App;

class GetIAmenitiesAction
{
    public function execute()
    {
        return Cache::rememberForever('inventory_module_amenities_'.App::getLocale(), function() {
            $i_amenities = IAmenity::with('translations')->get();

            // Transform the i_amenities
            $i_amenities = IAmenityResource::collection($i_amenities);

            return $i_amenities;
        });
    }
}