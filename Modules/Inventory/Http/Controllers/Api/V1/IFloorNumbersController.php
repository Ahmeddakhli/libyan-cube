<?php

namespace Modules\Inventory\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Http\Controllers\Actions\FloorNumbers\CreateIFloorNumberAction;
use Modules\Inventory\Http\Controllers\Actions\FloorNumbers\DeleteIFloorNumberAction;
use Modules\Inventory\Http\Controllers\Actions\FloorNumbers\GetIFloorNumbersAction;
use Modules\Inventory\Http\Controllers\Actions\FloorNumbers\UpdateIFloorNumberAction;
use Modules\Inventory\Http\Requests\FloorNumbers\CreateIFloorNumberRequest;
use Modules\Inventory\Http\Requests\FloorNumbers\DeleteIFloorNumberRequest;
use Modules\Inventory\Http\Requests\FloorNumbers\GetIFloorNumbersRequest;
use Modules\Inventory\Http\Requests\FloorNumbers\UpdateIFloorNumberRequest;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth;

class IFloorNumbersController extends Controller
{
    /**
     * Store i_floor_number
     *
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateIFloorNumberRequest $request, CreateIFloorNumberAction $action)
    {
        // Create the i_floor_number
        $i_floor_number = $action->execute($request->except([]));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Floor number created successfully';
        $resp->status = true;
        $resp->data = $i_floor_number;
        return response()->json($resp, 200);
    }

    /**
     * Update i_floor_number
     *
     * @param  [integer] id
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIFloorNumberRequest $request, UpdateIFloorNumberAction $action)
    {
        // Update the i_floor_number
        $i_floor_number = $action->execute($request->input('id'), $request->except(['id']));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Floor number updated successfully';
        $resp->status = true;
        $resp->data = $i_floor_number;
        return response()->json($resp, 200);
    }

    /**
     * Get i_floor_numbers
     *
     * @return [json] ServiceResponse object
     */
    public function GetIFloorNumbers(GetIFloorNumbersRequest $request, GetIFloorNumbersAction $action)
    {
        // Get the i_floor_numbers
        $i_floor_numbers = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Floor numbers retrieved successfully';
        $resp->status = true;
        $resp->data = $i_floor_numbers;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_floor_number
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIFloorNumberRequest $request, DeleteIFloorNumberAction $action)
    {
        // Delete the i_floor_number
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Floor number deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }
}
