<?php

namespace Modules\Inventory\Http\Controllers\Actions\Projects;

use Cache;
use Modules\Inventory\IUnit;
use Modules\Inventory\Http\Resources\IDesignTypeResource;

class GetProjectUnitsPurposeTypesAction
{
    public function execute($id)
    {
        // Init data array
        $data = [];
        
        // Get project primary active units that has purpose type and design type
        $units = IUnit::active()->where('i_project_id', $id)->whereHas('offeringType', function($offering_type) {
            $offering_type->whereHas('translations', function($translation) {
                $translation->where('offering_type', 'Primary');
            });
        })->whereNotNull('i_purpose_type_id')->whereNotNull('i_design_type_id')->select('id','i_purpose_type_id','i_design_type_id','i_bedroom_id','price','area')->with(['purposeType', 'designType', 'bedroom'])->get();

        // Structure data as purpose type -> design type -> details
        foreach ($units as $unit) {
            $unit_purpose_type = $unit->purposeType->value;
            $unit_design_type = $unit->designType->value;

            $data[$unit_purpose_type][$unit_design_type]['purpose_type'] = $unit->purposeType;
            $data[$unit_purpose_type][$unit_design_type]['design_type'] = $unit->designType;

            $data[$unit_purpose_type][$unit_design_type]['bedrooms'][] = $unit->bedroom ? $unit->bedroom->count : 0;
            $data[$unit_purpose_type][$unit_design_type]['area'][] = $unit->area;
            $data[$unit_purpose_type][$unit_design_type]['price'][] = $unit->price;
        }

        // Calculate min and max bedrooms, area and price
        // Transform design type
        foreach ($data as $purpose_type => $prupose_type_design_types_array) {
            foreach ($prupose_type_design_types_array as $design_type => $data_array) {
                $data[$purpose_type][$design_type]['bedrooms'] = ['max' => max($data_array['bedrooms']), 'min' => min($data_array['bedrooms'])];
                $data[$purpose_type][$design_type]['area'] = ['max' => max($data_array['area']), 'min' => min($data_array['area'])];
                $data[$purpose_type][$design_type]['price'] = ['max' => max($data_array['price']), 'min' => min($data_array['price'])];
                $data[$purpose_type][$design_type]['design_type'] = json_decode(json_encode(new IDesignTypeResource($data_array['design_type'])));
            }
        }

        // Return data array
        return $data;
    }
}
