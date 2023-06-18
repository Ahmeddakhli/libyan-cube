<?php

namespace Modules\Locations\Http\Controllers\Actions;

use Modules\Locations\Location;
use Modules\Locations\LocationTranslation;

class UpdateLocationAction
{
    public function execute($id, $data, $translations)
    {
        // Get location 
        $location = Location::find($id);
        
        // Set is active 
        $data['is_active'] = isset($data['is_active']) ? $data['is_active'] : "off";
        $data['in_discover_by'] = isset($data['in_discover_by']) ? $data['in_discover_by'] : "off";

        $slug = "";

        // update transaltion 
        foreach ($translations as  $value) {
            $value['location_id'] = $location->id;
            $slug = $value['language_id'] == 1 ? str_slug($value['name']) : null;
            if (LocationTranslation::where('location_id', $location->id)->where('language_id', $value['language_id'])->first()) {
                LocationTranslation::where('location_id', $location->id)->where('language_id', $value['language_id'])->update($value);
            } else {
                LocationTranslation::insert($value);
            }
        }
        $data['slug'] = $slug;
        $location->update($data);

        return $location;
    }
}
