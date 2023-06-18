<?php

namespace Modules\Inventory\Http\Controllers\Actions\PurposeTypes;

use Cache;
use Modules\Inventory\IPurposeType;
use Modules\Inventory\Http\Resources\IPurposeTypeResource;
use App;

class GetIPurposeTypesAction
{
    public function execute()
    {
        return Cache::rememberForever('inventory_module_purpose_types_'.App::getLocale(), function () {
            $i_purpose_types = IPurposeType::with('purpose','translations')->get();

            // Transform the i_purpose_types
            // N+1 Problem
            // $i_purpose_types = IPurposeTypeResource::collection($i_purpose_types);
            foreach ($i_purpose_types as $purpose_type) {
                $purpose_type->purpose_type = $purpose_type->value;
                $purpose_type->purpose = $purpose_type->purpose ? $purpose_type->purpose->value : null;
            }

            return $i_purpose_types;
        });
    }
}
