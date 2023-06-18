<?php

namespace Modules\Careers\Http\Controllers\Actions;

use Modules\Careers\Career;
use Modules\Careers\Http\Resources\CareerResource;

class GetCareerByIdAction
{
    public function execute($id)
    {
    	// Get the career
        $career = Career::find($id);

        // Return the response
        return $career ? new CareerResource($career) : null;
    }
}
