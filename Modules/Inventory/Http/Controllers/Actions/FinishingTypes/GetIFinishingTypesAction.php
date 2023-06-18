<?php

namespace Modules\Inventory\Http\Controllers\Actions\FinishingTypes;

use Cache;
use Modules\Inventory\IFinishingType;
use Modules\Inventory\Http\Resources\IFinishingTypeResource;
use App;

class GetIFinishingTypesAction
{
    public function execute()
    {
        return Cache::rememberForever('inventory_module_finishing_types_'.App::getLocale(), function () {
            $i_finishing_types = IFinishingType::with('translations')->get();

            // Transform the i_finishing_types
            $i_finishing_types = IFinishingTypeResource::collection($i_finishing_types);

            return $i_finishing_types;
        });
    }
}
