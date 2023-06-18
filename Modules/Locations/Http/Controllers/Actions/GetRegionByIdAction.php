<?php

namespace Modules\Locations\Http\Controllers\Actions;

use Cache;
use Modules\Locations\Location;
use Modules\Locations\Http\Resources\RegionResource;

class GetRegionByIdAction
{
    public function execute(array $data)
    {
        $id = $data['id'];

        // Get the region
        $region = Location::active()->where('id',$id)->with('children',
        'parent')->first();
        
        // Transform the output
        $region = ($region && $region->parent && $region->parent->parent_id == Location::where('name', 'Country')->first()->id) ? new RegionResource($region) : null;

        return $region;
    }
}
