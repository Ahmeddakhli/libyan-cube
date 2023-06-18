<?php

namespace Modules\Inventory\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Http\Controllers\Actions\Amenities\CreateIAmenityAction;
use Modules\Inventory\Http\Controllers\Actions\Amenities\DeleteIAmenityAction;
use Modules\Inventory\Http\Controllers\Actions\Amenities\GetIAmenitiesAction;
use Modules\Inventory\Http\Controllers\Actions\Amenities\UpdateIAmenityAction;
use Modules\Inventory\Http\Requests\Amenities\CreateIAmenityRequest;
use Modules\Inventory\Http\Requests\Amenities\DeleteIAmenityRequest;
use Modules\Inventory\Http\Requests\Amenities\GetIAmenitiesRequest;
use Modules\Inventory\Http\Requests\Amenities\UpdateIAmenityRequest;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth;

class IAmenitiesController extends Controller
{
    /**
     * Store i_amenity
     *
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateIAmenityRequest $request, CreateIAmenityAction $action)
    {
        // Create the i_amenity
        $i_amenity = $action->execute($request->except([]),$request->attachments);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Amenity created successfully';
        $resp->status = true;
        $resp->data = $i_amenity;
        return response()->json($resp, 200);
    }

    /**
     * Update i_amenity
     *
     * @param  [integer] id
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIAmenityRequest $request, UpdateIAmenityAction $action)
    {
        // Update the i_amenity
        $i_amenity = $action->execute($request->input('id'), $request->except(['id']),$request->attachments);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Amenity updated successfully';
        $resp->status = true;
        $resp->data = $i_amenity;
        return response()->json($resp, 200);
    }

    /**
     * Get I_amenities
     *
     * @return [json] ServiceResponse object
     */
    public function GetIAmenities(GetIAmenitiesRequest $request, GetIAmenitiesAction $action)
    {
        // Get the I_amenities
        $i_amenities = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Amenities retrieved successfully';
        $resp->status = true;
        $resp->data = $i_amenities;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_amenity
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIAmenityRequest $request, DeleteIAmenityAction $action)
    {
        // Delete the i_amenity
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Amenity deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }
}
