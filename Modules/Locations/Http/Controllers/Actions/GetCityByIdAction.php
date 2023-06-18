<?php

namespace Modules\Locations\Http\Controllers\Actions;

use Cache;
use Modules\Locations\Location;
use Modules\Locations\Http\Resources\CityResource;

class GetCityByIdAction
{
    public function execute(array $data)
    {
        $id = $data['id'];

        // Get the city
        $city = Location::active()->where('id', $id)->with('children',
        'parent')->first();
        
        // Transform the output
        $city = ($city && $city->parent && $city->parent->parent && $city->parent->parent->parent_id == Location::where('name', 'Country')->first()->id) ? new CityResource($city) : null;

        return $city;
    }
}
