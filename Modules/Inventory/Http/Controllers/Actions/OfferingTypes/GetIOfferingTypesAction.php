<?php

namespace Modules\Inventory\Http\Controllers\Actions\OfferingTypes;

use Cache;
use Modules\Inventory\IOfferingType;
use Modules\Inventory\Http\Resources\IOfferingTypeResource;
use App;

class GetIOfferingTypesAction
{
    public function execute()
    {
        return Cache::rememberForever('inventory_module_offering_types_'.App::getLocale(), function () {
            $i_offering_types = IOfferingType::orderBy('created_at', 'desc')->with('translations')->get();

            // Transform the i_offering_types
            $i_offering_types = IOfferingTypeResource::collection($i_offering_types);

            return $i_offering_types;
        });
    }
}
