<?php

namespace Modules\Inventory\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Http\Controllers\Actions\FurnishingStatuses\CreateIFurnishingStatusAction;
use Modules\Inventory\Http\Controllers\Actions\FurnishingStatuses\DeleteIFurnishingStatusAction;
use Modules\Inventory\Http\Controllers\Actions\FurnishingStatuses\GetIFurnishingStatusesAction;
use Modules\Inventory\Http\Controllers\Actions\FurnishingStatuses\UpdateIFurnishingStatusAction;
use Modules\Inventory\Http\Requests\FurnishingStatuses\CreateIFurnishingStatusRequest;
use Modules\Inventory\Http\Requests\FurnishingStatuses\DeleteIFurnishingStatusRequest;
use Modules\Inventory\Http\Requests\FurnishingStatuses\GetIFurnishingStatusesRequest;
use Modules\Inventory\Http\Requests\FurnishingStatuses\UpdateIFurnishingStatusRequest;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth;

class IFurnishingStatusesController extends Controller
{
    /**
     * Store i_furnishing_status
     *
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateIFurnishingStatusRequest $request, CreateIFurnishingStatusAction $action)
    {
        // Create the i_furnishing_status
        $i_furnishing_status = $action->execute($request->except([]));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Furnishing status created successfully';
        $resp->status = true;
        $resp->data = $i_furnishing_status;
        return response()->json($resp, 200);
    }

    /**
     * Update i_furnishing_status
     *
     * @param  [integer] id
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIFurnishingStatusRequest $request, UpdateIFurnishingStatusAction $action)
    {
        // Update the i_furnishing_status
        $i_furnishing_status = $action->execute($request->input('id'), $request->except(['id']));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Furnishing status updated successfully';
        $resp->status = true;
        $resp->data = $i_furnishing_status;
        return response()->json($resp, 200);
    }

    /**
     * Get i_furnishing_statuses
     *
     * @return [json] ServiceResponse object
     */
    public function GetIFurnishingStatuses(GetIFurnishingStatusesRequest $request, GetIFurnishingStatusesAction $action)
    {
        // Get the i_furnishing_statuses
        $i_furnishing_statuses = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Furnishing statuses retrieved successfully';
        $resp->status = true;
        $resp->data = $i_furnishing_statuses;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_furnishing_status
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIFurnishingStatusRequest $request, DeleteIFurnishingStatusAction $action)
    {
        // Delete the i_furnishing_status
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Furnishing status deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }
}
