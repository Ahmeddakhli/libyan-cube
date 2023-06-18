<?php

namespace Modules\Locations\Http\Controllers\Actions;

use Cache;
use Modules\Locations\Location;
use Modules\Locations\Http\Resources\CountryResource;

class GetCountryByIdAction
{
    public function execute(array $data)
    {
        $id = $data['id'];
        
        // Get the country
        $country = Location::active()->where('id',$id)->with('children',
        'parent')->first();
        
        // Transform the output
        $country = ($country && $country->parent_id == Location::where('name', 'Country')->first()->id) ? new CountryResource($country) : null;

        return $country;
    }
}
