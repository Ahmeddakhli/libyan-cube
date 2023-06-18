<?php

namespace Modules\Inventory\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Http\Controllers\Actions\Purposes\CreateIPurposeAction;
use Modules\Inventory\Http\Controllers\Actions\Purposes\DeleteIPurposeAction;
use Modules\Inventory\Http\Controllers\Actions\Purposes\GetIPurposesAction;
use Modules\Inventory\Http\Controllers\Actions\Purposes\UpdateIPurposeAction;
use Modules\Inventory\Http\Requests\Purposes\CreateIPurposeRequest;
use Modules\Inventory\Http\Requests\Purposes\DeleteIPurposeRequest;
use Modules\Inventory\Http\Requests\Purposes\GetIPurposesRequest;
use Modules\Inventory\Http\Requests\Purposes\UpdateIPurposeRequest;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth;

class IPurposesController extends Controller
{
    /**
     * Store i_purpose
     *
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateIPurposeRequest $request, CreateIPurposeAction $action)
    {
        // Create the i_purpose
        $i_purpose = $action->execute($request->except([]));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Purpose created successfully';
        $resp->status = true;
        $resp->data = $i_purpose;
        return response()->json($resp, 200);
    }

    /**
     * Update i_purpose
     *
     * @param  [integer] id
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIPurposeRequest $request, UpdateIPurposeAction $action)
    {
        // Update the i_purpose
        $i_purpose = $action->execute($request->input('id'), $request->except(['id']));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Purpose updated successfully';
        $resp->status = true;
        $resp->data = $i_purpose;
        return response()->json($resp, 200);
    }

    /**
     * Get i_purposes
     *
     * @return [json] ServiceResponse object
     */
    public function GetIPurposes(GetIPurposesRequest $request, GetIPurposesAction $action)
    {
        // Get the i_purposes
        $i_purposes = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Purposes retrieved successfully';
        $resp->status = true;
        $resp->data = $i_purposes;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_purpose
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIPurposeRequest $request, DeleteIPurposeAction $action)
    {
        // Delete the i_purpose
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Purpose deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }
}
