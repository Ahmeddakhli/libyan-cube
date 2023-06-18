<?php

namespace Modules\Inventory\Http\Controllers\Actions\Favorites;

use Modules\Inventory\IUnit;

class UnFavoriteIUnitAction
{
    public function execute($data)
    {
        // Get unit
        $unit = IUnit::find($data['unit_id']);
        
        if (in_array(auth()->user()->id, $unit->favoredByUsers->pluck('id')->toArray())) {
            // detach user favorite
            $unit->favoredByUsers()->detach(auth()->user()->id);
            $message = 'Unit removed from favorites successfully';
        } else {
            // attach user favorite
            $unit->favoredByUsers()->attach(auth()->user()->id);
            $message = 'Unit added to favorites successfully';
        }

        return $message;
    }
}
