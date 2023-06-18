<?php

namespace Modules\Inventory\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Http\Controllers\Actions\Positions\CreateIPositionAction;
use Modules\Inventory\Http\Controllers\Actions\Positions\DeleteIPositionAction;
use Modules\Inventory\Http\Controllers\Actions\Positions\GetIPositionsAction;
use Modules\Inventory\Http\Controllers\Actions\Positions\UpdateIPositionAction;
use Modules\Inventory\Http\Requests\Positions\CreateIPositionRequest;
use Modules\Inventory\Http\Requests\Positions\DeleteIPositionRequest;
use Modules\Inventory\Http\Requests\Positions\GetIPositionsRequest;
use Modules\Inventory\Http\Requests\Positions\UpdateIPositionRequest;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth;

class IPositionsController extends Controller
{
    /**
     * Store i_position
     *
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateIPositionRequest $request, CreateIPositionAction $action)
    {
        // Create the i_position
        $i_position = $action->execute($request->except([]));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Position created successfully';
        $resp->status = true;
        $resp->data = $i_position;
        return response()->json($resp, 200);
    }

    /**
     * Update i_position
     *
     * @param  [integer] id
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIPositionRequest $request, UpdateIPositionAction $action)
    {
        // Update the i_position
        $i_position = $action->execute($request->input('id'), $request->except(['id']));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Position updated successfully';
        $resp->status = true;
        $resp->data = $i_position;
        return response()->json($resp, 200);
    }

    /**
     * Get i_positions
     *
     * @return [json] ServiceResponse object
     */
    public function GetIPositions(GetIPositionsRequest $request, GetIPositionsAction $action)
    {
        // Get the i_positions
        $i_positions = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Positions retrieved successfully';
        $resp->status = true;
        $resp->data = $i_positions;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_position
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIPositionRequest $request, DeleteIPositionAction $action)
    {
        // Delete the i_position
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Position deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }
}
