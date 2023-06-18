<?php

namespace Modules\Ratings\Http\Controllers\Actions;

use App\User;
use Modules\Inventory\IProject;
use Modules\Inventory\IUnit;
use Modules\Ratings\Rating;

class CreateRatingAction
{
    public function execute($data)
    {
        if ($rating = Rating::where('created_by', auth()->user()->id)->first()) {
            $rating->update([
                'rate' => $data['rate']
            ]);
        } else {
            // Create rate
            $rating = Rating::create([
                'rate' => $data['rate']
            ]);
        }
        // Get the rateable
        $rateable_id = $data['rateable_id'];
        $rateable_type = $data['rateable_type'];
        $rateable = $rateable_type::find($rateable_id);

        // Associate the rate with the rateable
        $rating = $rateable->ratings()->save($rating);

        // Return the response
        return $rating;
    }
}
