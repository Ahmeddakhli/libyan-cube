<?php

namespace Modules\Locations\Http\Controllers\Actions;

use Cache;
use Modules\Locations\Location;
use Modules\Locations\Http\Resources\LocationResource;
use App;

class GetCountriesAction
{
    public function execute()
    {
        return Cache::rememberForever('locations_module_countries_'.App::getLocale(), function () {
            $locations = Location::active()->where('parent_id', Location::where('parent_id', null)->with('children',
            'parent')->first()->id)->get();
            // Transform the locations
            $locations = LocationResource::collection($locations);

            return $locations;
        });
    }
}
