<?php

namespace Modules\Inventory\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Http\Controllers\Actions\OfferingTypes\CreateIOfferingTypeAction;
use Modules\Inventory\Http\Controllers\Actions\OfferingTypes\DeleteIOfferingTypeAction;
use Modules\Inventory\Http\Controllers\Actions\OfferingTypes\GetIOfferingTypesAction;
use Modules\Inventory\Http\Controllers\Actions\OfferingTypes\UpdateIOfferingTypeAction;
use Modules\Inventory\Http\Requests\OfferingTypes\CreateIOfferingTypeRequest;
use Modules\Inventory\Http\Requests\OfferingTypes\DeleteIOfferingTypeRequest;
use Modules\Inventory\Http\Requests\OfferingTypes\GetIOfferingTypesRequest;
use Modules\Inventory\Http\Requests\OfferingTypes\UpdateIOfferingTypeRequest;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth;

class IOfferingTypesController extends Controller
{
    /**
     * Store i_offering_type
     *
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateIOfferingTypeRequest $request, CreateIOfferingTypeAction $action)
    {
        // Create the i_offering_type
        $i_offering_type = $action->execute($request->except([]));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Offering type created successfully';
        $resp->status = true;
        $resp->data = $i_offering_type;
        return response()->json($resp, 200);
    }

    /**
     * Update i_offering_type
     *
     * @param  [integer] id
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIOfferingTypeRequest $request, UpdateIOfferingTypeAction $action)
    {
        // Update the i_offering_type
        $i_offering_type = $action->execute($request->input('id'), $request->except(['id']));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Offering type updated successfully';
        $resp->status = true;
        $resp->data = $i_offering_type;
        return response()->json($resp, 200);
    }

    /**
     * Get i_offering_types
     *
     * @return [json] ServiceResponse object
     */
    public function GetIOfferingTypes(GetIOfferingTypesRequest $request, GetIOfferingTypesAction $action)
    {
        // Get the i_offering_types
        $i_offering_types = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Offering types retrieved successfully';
        $resp->status = true;
        $resp->data = $i_offering_types;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_offering_type
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIOfferingTypeRequest $request, DeleteIOfferingTypeAction $action)
    {
        // Delete the i_offering_type
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Offering type deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }
}
