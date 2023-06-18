<?php

namespace Modules\Careers\Http\Controllers\Actions;

use Cache;
use Modules\Careers\Career;
use Modules\Careers\Http\Resources\CareerResource;

class GetCareersAction
{
    public function execute()
    {
        // Get the careers
        $careers = Career::all();

        // Transform the Careers
        $careers = CareerResource::collection($careers);

        // Return the careers
        return $careers;
    }
}
