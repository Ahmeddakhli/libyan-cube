<?php

namespace Modules\Inventory\Http\Controllers\Actions\Bedrooms;

use Cache;
use Modules\Inventory\IBedroom;
use Modules\Inventory\Http\Resources\IBedroomResource;
use App;

class GetIBedroomsAction
{
    public function execute()
    {
        return Cache::rememberForever('inventory_module_bedrooms_'.App::getLocale(), function () {
            $i_bedrooms = IBedroom::with('translations')->get();

            // Transform the i_bedrooms
            $i_bedrooms = IBedroomResource::collection($i_bedrooms);

            return $i_bedrooms;
        });
    }
}
