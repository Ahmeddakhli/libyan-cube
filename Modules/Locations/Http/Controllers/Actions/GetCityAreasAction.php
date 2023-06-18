<?php

namespace Modules\Locations\Http\Controllers\Actions;

use Cache;
use Modules\Locations\Location;
use Modules\Locations\Http\Resources\LocationResource;
use App;

class GetCityAreasAction
{
    public function execute(array $data)
    {
        $city_id = $data['city_id'];
        if (is_array($city_id)) {
            $city_id = $city_id[0];
        }
        // Check if city exists
        $city = Location::active()->where('id',$city_id)->with('children',
        'parent')->first();

        if ($city && $city->parent) {

            return Cache::rememberForever('locations_module_city_' . $city_id . '_areas_'.App::getLocale(), function () use ($city_id) {
                $locations = Location::active()->where('parent_id', $city_id)->with('children',
                'parent')->get();

                // Transform the locations
                $locations = LocationResource::collection($locations);

                return $locations;
            });
        } else {
            return Cache::rememberForever('locations_module_city_' . $city_id . '_areas_'.App::getLocale(), function () use ($city_id) {
                return null;
            });
        }
    }
}
