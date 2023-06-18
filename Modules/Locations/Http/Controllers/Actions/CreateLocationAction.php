<?php

namespace Modules\Locations\Http\Controllers\Actions;

use Modules\Locations\Location;
use Modules\Locations\LocationTranslation;

class CreateLocationAction
{
    public function execute($data, $translations)
    {
        // Create location
        $location = Location::create($data);
        $slug = "";

        // Create location translation
        foreach ($translations as  $value) {
            $value['location_id'] = $location->id;
            LocationTranslation::insert($value);
            $slug = $value['language_id'] == 1 ? str_slug($value['name']) : null;
        }

        // Update location 
        $location->update(['slug' => $slug]);
        $location->save();

        // Return the response 
        return $location;
    }
}
