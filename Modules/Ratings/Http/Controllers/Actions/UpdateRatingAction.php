<?php

namespace Modules\Ratings\Http\Controllers\Actions;

use Modules\Ratings\Rating;

class UpdateRatingAction
{
    public function execute($id, $data)
    {
        // Get rating 
        $rating = Rating::find($id);
        
        // Update rating 
        $rating->update([
            'rate' => $data['rate']
        ]);

        // Return the response
        return $rating;
    }
}
