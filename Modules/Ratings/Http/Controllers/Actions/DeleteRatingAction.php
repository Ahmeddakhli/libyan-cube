<?php

namespace Modules\Ratings\Http\Controllers\Actions;

use Modules\Ratings\Rating;

class DeleteRatingAction
{
    public function execute($id)
    {
        // Get rating
        $rating = Rating::find($id);
        
        // Delete rating 
        $rating->delete();

        return null;
    }
}
