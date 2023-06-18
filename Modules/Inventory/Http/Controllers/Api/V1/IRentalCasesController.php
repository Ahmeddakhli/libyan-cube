<?php

namespace Modules\Inventory\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Http\Controllers\Actions\RentalCases\CreateIRentalCaseAction;
use Modules\Inventory\Http\Controllers\Actions\RentalCases\DeleteIRentalCaseAction;
use Modules\Inventory\Http\Controllers\Actions\RentalCases\GetIRentalCasesAction;
use Modules\Inventory\Http\Controllers\Actions\RentalCases\UpdateIRentalCaseAction;
use Modules\Inventory\Http\Requests\RentalCases\CreateIRentalCaseRequest;
use Modules\Inventory\Http\Requests\RentalCases\DeleteIRentalCaseRequest;
use Modules\Inventory\Http\Requests\RentalCases\GetIRentalCasesRequest;
use Modules\Inventory\Http\Requests\RentalCases\UpdateIRentalCaseRequest;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth;

class IRentalCasesController extends Controller
{
    /**
     * Store i_rental_case
     *
     * @param  [integer] i_unit_id
     * @param  [integer] renter_id
     * @param  [string]  from
     * @param  [string]  to
     * @param  [integer] price 
     * @return [json] ServiceResponse object
     */
    public function store(CreateIRentalCaseRequest $request, CreateIRentalCaseAction $action)
    {
        // Create the i_rental_case
        $i_rental_case = $action->execute($request->except([]));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Rental case created successfully';
        $resp->status = true;
        $resp->data = $i_rental_case;
        return response()->json($resp, 200);
    }

    /**
     * Update i_rental_case
     *
     * @param  [integer] id
     * @param  [integer] i_unit_id
     * @param  [integer] renter_id
     * @param  [string]  from
     * @param  [string]  to
     * @param  [integer] price  
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIRentalCaseRequest $request, UpdateIRentalCaseAction $action)
    {
        // Update the i_rental_case
        $i_rental_case = $action->execute($request->input('id'), $request->except(['id']));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Rental case updated successfully';
        $resp->status = true;
        $resp->data = $i_rental_case;
        return response()->json($resp, 200);
    }

    /**
     * Get i_rental_cases
     *
     * @return [json] ServiceResponse object
     */
    public function GetIRentalCases(GetIRentalCasesRequest $request, GetIRentalCasesAction $action)
    {
        // Get the i_rental_cases
        $i_rental_cases = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Rental cases retrieved successfully';
        $resp->status = true;
        $resp->data = $i_rental_cases;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_rental_case
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIRentalCaseRequest $request, DeleteIRentalCaseAction $action)
    {
        // Delete the i_rental_case
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Rental case deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }
}
