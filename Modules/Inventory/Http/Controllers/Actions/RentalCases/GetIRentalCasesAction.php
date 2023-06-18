<?php

namespace Modules\Inventory\Http\Controllers\Actions\RentalCases;

use Cache;
use Modules\Inventory\IRentalCase;
use Modules\Inventory\Http\Resources\IRentalCaseResource;

class GetIRentalCasesAction
{
    public function execute()
    {
        // Get  rental cases
        $i_rental_cases = IRentalCase::all();

        // Transform the i_rental_cases
        $i_rental_cases = IRentalCaseResource::collection($i_rental_cases);

        return $i_rental_cases;
    }
}
