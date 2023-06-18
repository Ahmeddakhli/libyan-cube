<?php

namespace Modules\Inventory\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Http\Controllers\Actions\Bedrooms\CreateIBedroomAction;
use Modules\Inventory\Http\Controllers\Actions\Bedrooms\DeleteIBedroomAction;
use Modules\Inventory\Http\Controllers\Actions\Bedrooms\GetIBedroomsAction;
use Modules\Inventory\Http\Controllers\Actions\Bedrooms\UpdateIBedroomAction;
use Modules\Inventory\Http\Requests\Bedrooms\CreateIBedroomRequest;
use Modules\Inventory\Http\Requests\Bedrooms\DeleteIBedroomRequest;
use Modules\Inventory\Http\Requests\Bedrooms\GetIBedroomsRequest;
use Modules\Inventory\Http\Requests\Bedrooms\UpdateIBedroomRequest;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth;

class IBedroomsController extends Controller
{
    /**
     * Store i_bedroom
     *
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateIBedroomRequest $request, CreateIBedroomAction $action)
    {
        // Create the i_bedroom
        $i_bedroom = $action->execute($request->except([]));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Bedroom created successfully';
        $resp->status = true;
        $resp->data = $i_bedroom;
        return response()->json($resp, 200);
    }

    /**
     * Update i_bedroom
     *
     * @param  [integer] id
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIBedroomRequest $request, UpdateIBedroomAction $action)
    {
        // Update the i_bedroom
        $i_bedroom = $action->execute($request->input('id'), $request->except(['id']));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Bedroom updated successfully';
        $resp->status = true;
        $resp->data = $i_bedroom;
        return response()->json($resp, 200);
    }

    /**
     * Get i_bedrooms
     *
     * @return [json] ServiceResponse object
     */
    public function GetIBedrooms(GetIBedroomsRequest $request, GetIBedroomsAction $action)
    {
        // Get the i_bedrooms
        $i_bedrooms = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Bedrooms retrieved successfully';
        $resp->status = true;
        $resp->data = $i_bedrooms;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_bedroom
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIBedroomRequest $request, DeleteIBedroomAction $action)
    {
        // Delete the i_bedroom
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Bedroom deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }
}
