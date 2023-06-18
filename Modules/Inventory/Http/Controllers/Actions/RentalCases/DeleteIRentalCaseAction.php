<?php

namespace Modules\Inventory\Http\Controllers\Actions\RentalCases;

use Modules\Inventory\IRentalCase;

class DeleteIRentalCaseAction
{
    public function execute($id)
    {
        // Get the i_rental_case
        $i_rental_case = IRentalCase::find($id);

        // Delete the i_rental_case
        $i_rental_case->delete();

        // Return the response
        return null;
    }
}
