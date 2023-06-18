<?php

namespace Modules\Inventory\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Http\Controllers\Actions\Facilities\CreateIFacilityAction;
use Modules\Inventory\Http\Controllers\Actions\Facilities\DeleteIFacilityAction;
use Modules\Inventory\Http\Controllers\Actions\Facilities\GetIFacilitiesAction;
use Modules\Inventory\Http\Controllers\Actions\Facilities\UpdateIFacilityAction;
use Modules\Inventory\Http\Requests\Facilities\CreateIFacilityRequest;
use Modules\Inventory\Http\Requests\Facilities\DeleteIFacilityRequest;
use Modules\Inventory\Http\Requests\Facilities\GetIFacilitiesRequest;
use Modules\Inventory\Http\Requests\Facilities\UpdateIFacilityRequest;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth;

class IFacilitiesController extends Controller
{
    /**
     * Store i_facility
     *
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateIFacilityRequest $request, CreateIFacilityAction $action)
    {
        // Create the i_facility
        $i_facility = $action->execute($request->except([]),$request->attachments);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Facility created successfully';
        $resp->status = true;
        $resp->data = $i_facility;
        return response()->json($resp, 200);
    }

    /**
     * Update i_facility
     *
     * @param  [integer] id
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIFacilityRequest $request, UpdateIFacilityAction $action)
    {
        // Update the i_facility
        $i_facility = $action->execute($request->input('id'), $request->except(['id']),$request->attachments);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Facility updated successfully';
        $resp->status = true;
        $resp->data = $i_facility;
        return response()->json($resp, 200);
    }

    /**
     * Get I_facilities
     *
     * @return [json] ServiceResponse object
     */
    public function GetIFacilities(GetIFacilitiesRequest $request, GetIFacilitiesAction $action)
    {
        // Get the I_facilities
        $I_facilities = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Facilities retrieved successfully';
        $resp->status = true;
        $resp->data = $I_facilities;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_facility
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIFacilityRequest $request, DeleteIFacilityAction $action)
    {
        // Delete the i_facility
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Facility deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }
}
