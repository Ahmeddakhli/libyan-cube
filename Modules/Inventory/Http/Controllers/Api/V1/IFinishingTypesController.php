<?php

namespace Modules\Inventory\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Http\Controllers\Actions\FinishingTypes\CreateIFinishingTypeAction;
use Modules\Inventory\Http\Controllers\Actions\FinishingTypes\DeleteIFinishingTypeAction;
use Modules\Inventory\Http\Controllers\Actions\FinishingTypes\GetIFinishingTypesAction;
use Modules\Inventory\Http\Controllers\Actions\FinishingTypes\UpdateIFinishingTypeAction;
use Modules\Inventory\Http\Requests\FinishingTypes\CreateIFinishingTypeRequest;
use Modules\Inventory\Http\Requests\FinishingTypes\DeleteIFinishingTypeRequest;
use Modules\Inventory\Http\Requests\FinishingTypes\GetIFinishingTypesRequest;
use Modules\Inventory\Http\Requests\FinishingTypes\UpdateIFinishingTypeRequest;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth;

class IFinishingTypesController extends Controller
{
    /**
     * Store i_finishing_type
     *
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateIFinishingTypeRequest $request, CreateIFinishingTypeAction $action)
    {
        // Create the i_finishing_type
        $i_finishing_type = $action->execute($request->except([]));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Finishing type created successfully';
        $resp->status = true;
        $resp->data = $i_finishing_type;
        return response()->json($resp, 200);
    }

    /**
     * Update i_finishing_type
     *
     * @param  [integer] id
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIFinishingTypeRequest $request, UpdateIFinishingTypeAction $action)
    {
        // Update the i_finishing_type
        $i_finishing_type = $action->execute($request->input('id'), $request->except(['id']));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Finishing type updated successfully';
        $resp->status = true;
        $resp->data = $i_finishing_type;
        return response()->json($resp, 200);
    }

    /**
     * Get i_finishing_types
     *
     * @return [json] ServiceResponse object
     */
    public function GetIFinishingTypes(GetIFinishingTypesRequest $request, GetIFinishingTypesAction $action)
    {
        // Get the i_finishing_types
        $i_finishing_types = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Finishing types retrieved successfully';
        $resp->status = true;
        $resp->data = $i_finishing_types;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_finishing_type
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIFinishingTypeRequest $request, DeleteIFinishingTypeAction $action)
    {
        // Delete the i_finishing_type
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Finishing type deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }
}
