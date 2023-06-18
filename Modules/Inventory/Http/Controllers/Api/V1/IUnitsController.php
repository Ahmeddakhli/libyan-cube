<?php

namespace Modules\Inventory\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Http\Controllers\Actions\Units\CreateIUnitAction;
use Modules\Inventory\Http\Controllers\Actions\Units\DeleteIUnitAction;
use Modules\Inventory\Http\Controllers\Actions\Units\GetIUnitsAction;
use Modules\Inventory\Http\Controllers\Actions\Units\UpdateIUnitAction;
use Modules\Inventory\Http\Controllers\Actions\Units\GetIUnitByIdAction;
use Modules\Inventory\Http\Controllers\Actions\Units\DeleteIUnitAttachmentAction;
use Modules\Inventory\Http\Controllers\Actions\Units\GetMyUnitsAction;
use Modules\Inventory\Http\Requests\Units\CreateIUnitRequest;
use Modules\Inventory\Http\Requests\Units\DeleteIUnitRequest;
use Modules\Inventory\Http\Requests\Units\GetIUnitsRequest;
use Modules\Inventory\Http\Requests\Units\UpdateIUnitRequest;
use Modules\Inventory\Http\Requests\Units\DeleteIUnitAttachmentRequest;
use Modules\Inventory\Http\Requests\Units\GetMyUnitsRequest;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth;

class IUnitsController extends Controller
{
    /**
     * Store i_unit
     *
     * @param  [integer] i_project_id
     * @param  [string] unit_number
     * @param  [string] building_number
     * @param  [integer] seller_id
     * @param  [integer] i_position_id
     * @param  [integer] i_view_id
     * @param  [integer] rent_price
     * @param  [integer] resale_price
     * @param  [integer] area
     * @param  [integer] garden_area
     * @param  [integer] plot_area
     * @param  [integer] build_up_area
     * @param  [integer] i_bedroom_area
     * @param  [integer] i_bathroom_area
     * @param  [integer] i_floor_number_id
     * @param  [integer] i_purpose_id
     * @param  [integer] i_purpose_type_id
     * @param  [integer] country_id
     * @param  [integer] region_id
     * @param  [integer] city_id
     * @param  [integer] area_id
     * @param  [string] latitude
     * @param  [string] longitude
     * @param  [integer] i_offering_type_id
     * @param  [integer] price
     * @param  [integer] i_payment_method_id
     * @param  [integer] buyer_id
     * @param  [integer] down_payment
     * @param  [integer] number_of_installments
     * @param  [string] currency_code
     * @param  [integer] i_area_unit_id
     * @param  [integer] i_garden_area_unit_id
     * @param  [integer] i_furnishing_status_id
     * @param  [integer] i_design_type_id
     * @param  [integer] i_finishing_type_id
     * @param  [integer] is_featured
     * @param  [integer] is_active
     * @param  [array] translations
     * @return [json] ServiceResponse object
     */
    public function store(CreateIUnitRequest $request, CreateIUnitAction $action)
    {
        // Create the i_unit
        $i_unit = $action->execute($request->except(['facilities', 'amenities']), $request->input('facilities'), $request->input('amenities'), $request->attachments, $request->floorplans, $request->masterplans, $request->images, $request->input('tags'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Unit created successfully';
        $resp->status = true;
        $resp->data = $i_unit;
        return response()->json($resp, 200);
    }

    /**
     * Update i_unit
     *
     * @param  [integer] id
     * @param  [integer] i_project_id
     * @param  [string] unit_number
     * @param  [string] building_number
     * @param  [integer] seller_id
     * @param  [integer] i_position_id
     * @param  [integer] i_view_id
     * @param  [integer] area
     * @param  [integer] garden_area
     * @param  [integer] plot_area
     * @param  [integer] build_up_area
     * @param  [integer] i_bedroom_area
     * @param  [integer] i_bathroom_area
     * @param  [integer] i_floor_number_id
     * @param  [integer] i_purpose_id
     * @param  [integer] i_purpose_type_id
     * @param  [integer] country_id
     * @param  [integer] region_id
     * @param  [integer] city_id
     * @param  [integer] area_id
     * @param  [string] latitude
     * @param  [string] longitude
     * @param  [integer] i_offering_type_id
     * @param  [integer] price
     * @param  [integer] i_payment_method_id
     * @param  [integer] buyer_id
     * @param  [integer] down_payment
     * @param  [integer] number_of_installments
     * @param  [string] currency_code
     * @param  [integer] i_area_unit_id
     * @param  [integer] i_garden_area_unit_id
     * @param  [integer] i_furnishing_status_id
     * @param  [integer] i_design_type_id
     * @param  [integer] i_finishing_type_id
     * @param  [integer] is_featured
     * @param  [integer] is_active
     * @param  [array] translations
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIUnitRequest $request, UpdateIUnitAction $action)
    {
        // Update the i_unit
        $i_unit = $action->execute($request->input('id'), $request->except(['id', 'facilities', 'amenities']), $request->input('facilities'), $request->input('amenities'), $request->attachments, $request->floorplans, $request->masterplans, $request->images, $request->input('tags'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Unit updated successfully';
        $resp->status = true;
        $resp->data = $i_unit;
        return response()->json($resp, 200);
    }

    /**
     * Get i_units
     *
     * @return [json] ServiceResponse object
     */
    public function GetIUnits(GetIUnitsRequest $request, GetIUnitsAction $action)
    {
        // Get the i_units
        $i_units = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Units retrieved successfully';
        $resp->status = true;
        $resp->data = $i_units;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_unit
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIUnitRequest $request, DeleteIUnitAction $action)
    {
        // Delete the i_unit
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Unit deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_unit attachment
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function deleteAttachment(DeleteIUnitAttachmentRequest $request, DeleteIUnitAttachmentAction $action)
    {
        // Delete the i_unit attachment
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Unit attachment deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Show i_unit
     * @return Response
     */
    public function show(Request $request, $id, GetIUnitByIdAction $action)
    {
        // Get the i_unit
        $i_unit = $action->execute($id);

        if (!$i_unit) {
            $resp = new ServiceResponse;
            $resp->message = 'Unit not found';
            $resp->status = false;
            $resp->data = null;
            return response()->json($resp, 200);
        }

        $resp = new ServiceResponse;
        $resp->message = 'Unit retrieved successfully';
        $resp->status = true;
        $resp->data = $i_unit;
        return response()->json($resp, 200);
    }

    public function myUnits(GetMyUnitsRequest $request, GetMyUnitsAction $action)
    {
        $i_units = $action->execute();

        $resp = new ServiceResponse;
        $resp->message = 'Units retrieved successfully';
        $resp->status = true;
        $resp->data = $i_units;
        return response()->json($resp, 200);
    }
}
