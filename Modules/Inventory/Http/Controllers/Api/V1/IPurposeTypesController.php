<?php

namespace Modules\Inventory\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Http\Controllers\Actions\PurposeTypes\CreateIPurposeTypeAction;
use Modules\Inventory\Http\Controllers\Actions\PurposeTypes\DeleteIPurposeTypeAction;
use Modules\Inventory\Http\Controllers\Actions\PurposeTypes\GetIPurposeTypesAction;
use Modules\Inventory\Http\Controllers\Actions\PurposeTypes\UpdateIPurposeTypeAction;
use Modules\Inventory\Http\Controllers\Actions\PurposeTypes\GetIPurposePurposeTypesAction;
use Modules\Inventory\Http\Requests\PurposeTypes\CreateIPurposeTypeRequest;
use Modules\Inventory\Http\Requests\PurposeTypes\DeleteIPurposeTypeRequest;
use Modules\Inventory\Http\Requests\PurposeTypes\GetIPurposeTypesRequest;
use Modules\Inventory\Http\Requests\PurposeTypes\UpdateIPurposeTypeRequest;
use Modules\Inventory\Http\Requests\PurposeTypes\GetIPurposePurposeTypesRequest;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth;

class IPurposeTypesController extends Controller
{
    /**
     * Store i_purpose_type
     *
     * @param  [integer] order
     * @param  [integer] i_purpose_id
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateIPurposeTypeRequest $request, CreateIPurposeTypeAction $action)
    {
        // Create the i_purpose_type
        $i_purpose_type = $action->execute($request->except([]));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Purpose type created successfully';
        $resp->status = true;
        $resp->data = $i_purpose_type;
        return response()->json($resp, 200);
    }

    /**
     * Update i_purpose_type
     *
     * @param  [integer] id
     * @param  [integer] order
     * @param  [integer] i_purpose_id
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIPurposeTypeRequest $request, UpdateIPurposeTypeAction $action)
    {
        // Update the i_purpose_type
        $i_purpose_type = $action->execute($request->input('id'), $request->except(['id']));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Purpose type updated successfully';
        $resp->status = true;
        $resp->data = $i_purpose_type;
        return response()->json($resp, 200);
    }

    /**
     * Get i_purpose_types
     *
     * @return [json] ServiceResponse object
     */
    public function GetIPurposeTypes(GetIPurposeTypesRequest $request, GetIPurposeTypesAction $action)
    {
        // Get the i_purpose_types
        $i_purpose_types = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Purpose types retrieved successfully';
        $resp->status = true;
        $resp->data = $i_purpose_types;
        return response()->json($resp, 200);
    }

    /**
     * Get i_purpose_purpose_types
     *
     * @param  [integer/array] i_purpose_id
     * @return [json] ServiceResponse object
     */
    public function GetIPurposePurposeTypes(GetIPurposePurposeTypesRequest $request, GetIPurposePurposeTypesAction $action)
    {
        // Get the i_purpose_types
        $i_purpose_types = $action->execute($request->all());

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Purpose types retrieved successfully';
        $resp->status = true;
        $resp->data = $i_purpose_types;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_purpose_type
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIPurposeTypeRequest $request, DeleteIPurposeTypeAction $action)
    {
        // Delete the i_purpose_type
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Purpose type deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }
}
