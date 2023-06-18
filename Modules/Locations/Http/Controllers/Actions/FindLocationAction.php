<?php

namespace Modules\Locations\Http\Controllers\Actions;

use Modules\Locations\Location;
use Modules\Locations\LocationTranslation;

class FindLocationAction
{
    public function execute($data)
    {
        // Location search 
        $location = Location::whereHas('translations', function ($q) use ($data) {
            $q->where('name', 'LIKE', '%' . $data . '%');
        })->with('parent', 'parent.parent', 'parent.parent.parent', 'parent.parent.parent.parent')->get();
        return $location;
    }
}
