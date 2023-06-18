<?php

namespace Modules\Inventory\Http\Controllers\Actions\DesignTypes;

use Cache;
use Modules\Inventory\IDesignType;
use Modules\Inventory\Http\Resources\IDesignTypeResource;
use App;

class GetIDesignTypesAction
{
    public function execute()
    {
        return Cache::rememberForever('inventory_module_design_types_'.App::getLocale(), function() {
            $i_design_types = IDesignType::all();

            // Transform the i_design_types
            $i_design_types = IDesignTypeResource::collection($i_design_types);

            return $i_design_types;
        });
    }
}