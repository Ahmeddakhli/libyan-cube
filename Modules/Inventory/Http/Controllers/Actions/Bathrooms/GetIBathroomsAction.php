<?php

namespace Modules\Inventory\Http\Controllers\Actions\Bathrooms;

use Cache;
use Modules\Inventory\IBathroom;
use Modules\Inventory\Http\Resources\IBathroomResource;
use App;

class GetIBathroomsAction
{
    public function execute()
    {
        return Cache::rememberForever('inventory_module_bathrooms_'.App::getLocale(), function() {
            $i_bathrooms = IBathroom::with('translations')->get();

            // Transform the i_bathrooms
            $i_bathrooms = IBathroomResource::collection($i_bathrooms);

            // Retrun response
            return $i_bathrooms;
        });
    }
}