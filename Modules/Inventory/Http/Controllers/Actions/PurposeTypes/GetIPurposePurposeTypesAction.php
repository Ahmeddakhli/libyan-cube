<?php

namespace Modules\Inventory\Http\Controllers\Actions\PurposeTypes;

use Cache;
use Modules\Inventory\IPurposeType;
use Modules\Inventory\Http\Resources\IPurposeTypeResource;

class GetIPurposePurposeTypesAction
{
    public function execute($inputs)
    {
        $i_purpose_ids = $inputs['i_purpose_id'];

        $i_purpose_types = IPurposeType::with('purpose')->whereIn('i_purpose_id', $i_purpose_ids)->get();

        // Transform the i_purpose_types
        // N+1 Problem
        // $i_purpose_types = IPurposeTypeResource::collection($i_purpose_types);
        foreach ($i_purpose_types as $purpose_type) {
            $purpose_type->purpose_type = $purpose_type->value ?? $purpose_type->default_value;
            $purpose_type->purpose = $purpose_type->purpose ? $purpose_type->purpose->value : null;
        }

        return $i_purpose_types;
    }
}
