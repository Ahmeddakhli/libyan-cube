<?php

namespace Modules\Ratings\Http\Controllers\Actions;

use Modules\Ratings\Http\Resources\RatingResource;
use Modules\Ratings\Rating;

class GetRatingsAction
{
    public function execute()
    {
        // Get ratings
        $ratings = Rating::all();

        // Return transformed response
        return RatingResource::collection($ratings);
    }
}
