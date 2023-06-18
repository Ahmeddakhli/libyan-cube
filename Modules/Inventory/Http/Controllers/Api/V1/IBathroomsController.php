<?php

namespace Modules\Inventory\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Http\Controllers\Actions\Bathrooms\CreateIBathroomAction;
use Modules\Inventory\Http\Controllers\Actions\Bathrooms\DeleteIBathroomAction;
use Modules\Inventory\Http\Controllers\Actions\Bathrooms\GetIBathroomsAction;
use Modules\Inventory\Http\Controllers\Actions\Bathrooms\UpdateIBathroomAction;
use Modules\Inventory\Http\Requests\Bathrooms\CreateIBathroomRequest;
use Modules\Inventory\Http\Requests\Bathrooms\DeleteIBathroomRequest;
use Modules\Inventory\Http\Requests\Bathrooms\GetIBathroomsRequest;
use Modules\Inventory\Http\Requests\Bathrooms\UpdateIBathroomRequest;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth;

class IBathroomsController extends Controller
{
    /**
     * Store i_bathroom
     *
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateIBathroomRequest $request, CreateIBathroomAction $action)
    {
        // Create the i_bathroom
        $i_bathroom = $action->execute($request->except([]));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Bathroom created successfully';
        $resp->status = true;
        $resp->data = $i_bathroom;
        return response()->json($resp, 200);
    }

    /**
     * Update i_bathroom
     *
     * @param  [integer] id
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIBathroomRequest $request, UpdateIBathroomAction $action)
    {
        // Update the i_bathroom
        $i_bathroom = $action->execute($request->input('id'), $request->except(['id']));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Bathroom updated successfully';
        $resp->status = true;
        $resp->data = $i_bathroom;
        return response()->json($resp, 200);
    }

    /**
     * Get i_bathrooms
     *
     * @return [json] ServiceResponse object
     */
    public function GetIBathrooms(GetIBathroomsRequest $request, GetIBathroomsAction $action)
    {
        // Get the i_bathrooms
        $i_bathrooms = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Bathrooms retrieved successfully';
        $resp->status = true;
        $resp->data = $i_bathrooms;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_bathroom
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIBathroomRequest $request, DeleteIBathroomAction $action)
    {
        // Delete the i_bathroom
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Bathroom deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }
}
