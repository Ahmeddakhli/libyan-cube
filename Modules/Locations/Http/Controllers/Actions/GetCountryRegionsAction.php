<?php

namespace Modules\Locations\Http\Controllers\Actions;

use Cache;
use Modules\Locations\Location;
use Modules\Locations\Http\Resources\LocationResource;
use App;

class GetCountryRegionsAction
{
    public function execute(array $data)
    {
        $country_id = $data['country_id'];
        if (is_array($country_id)) {
            $country_id = $country_id[0];
        }
        // Get country
        $country = Location::active()->where('id',$country_id)->with('children',
        'parent')->first();

        if ($country && $country->parent_id == Location::where('parent_id', null)->first()->id) {

            return Cache::rememberForever('locations_module_country_' . $country_id . '_regions_'.App::getLocale(), function () use ($country_id) {
                $locations = Location::active()->where('parent_id', $country_id)->get();

                // Transform the locations
                $locations = LocationResource::collection($locations);

                return $locations;
            });
        } else {

            return Cache::rememberForever('locations_module_country_' . $country_id . '_regions_'.App::getLocale(), function () use ($country_id) {

                return null;
            });
        }
    }
}
