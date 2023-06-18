<?php

namespace Modules\Locations\Http\Controllers\Actions;

use Cache;
use Modules\Locations\Location;
use Modules\Locations\Http\Resources\LocationResource;
use App;

class GetRegionCitiesAction
{
    public function execute(array $data)
    {
        $region_id = $data['region_id'];
        if (is_array($region_id)) {
            $region_id = $region_id;
            $locations = Location::active()->whereIn('parent_id', $region_id)->with(
                'children',
                'parent'
            )->get();

            // Transform the locations
            $locations = LocationResource::collection($locations);

            return $locations;
        } else {
            // Check if region exists
            $region = Location::active()->where('id', $region_id)->with(
                'children',
                'parent'
            )->first();
            if ($region && $region->parent) {

                return Cache::rememberForever('locations_module_region_' . $region_id . '_cities_' . App::getLocale(), function () use ($region_id) {
                    $locations = Location::active()->where('parent_id', $region_id)->with(
                        'children',
                        'parent'
                    )->get();

                    // Transform the locations
                    $locations = LocationResource::collection($locations);

                    return $locations;
                });
            } else {

                return Cache::rememberForever('locations_module_region_' . $region_id . '_cities_' . App::getLocale(), function () use ($region_id) {

                    return null;
                });
            }
        }
    }
}
