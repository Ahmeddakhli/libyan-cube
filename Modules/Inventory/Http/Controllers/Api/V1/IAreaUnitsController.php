<?php

namespace Modules\Inventory\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Http\Controllers\Actions\AreaUnits\CreateIAreaUnitAction;
use Modules\Inventory\Http\Controllers\Actions\AreaUnits\DeleteIAreaUnitAction;
use Modules\Inventory\Http\Controllers\Actions\AreaUnits\GetIAreaUnitsAction;
use Modules\Inventory\Http\Controllers\Actions\AreaUnits\UpdateIAreaUnitAction;
use Modules\Inventory\Http\Requests\AreaUnits\CreateIAreaUnitRequest;
use Modules\Inventory\Http\Requests\AreaUnits\DeleteIAreaUnitRequest;
use Modules\Inventory\Http\Requests\AreaUnits\GetIAreaUnitsRequest;
use Modules\Inventory\Http\Requests\AreaUnits\UpdateIAreaUnitRequest;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth;

class IAreaUnitsController extends Controller
{
    /**
     * Store i_area_unit
     *
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateIAreaUnitRequest $request, CreateIAreaUnitAction $action)
    {
        // Create the i_area_unit
        $i_area_unit = $action->execute($request->except([]));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Area unit created successfully';
        $resp->status = true;
        $resp->data = $i_area_unit;
        return response()->json($resp, 200);
    }

    /**
     * Update i_area_unit
     *
     * @param  [integer] id
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIAreaUnitRequest $request, UpdateIAreaUnitAction $action)
    {
        // Update the i_area_unit
        $i_area_unit = $action->execute($request->input('id'), $request->except(['id']));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Area unit updated successfully';
        $resp->status = true;
        $resp->data = $i_area_unit;
        return response()->json($resp, 200);
    }

    /**
     * Get i_area_units
     *
     * @return [json] ServiceResponse object
     */
    public function GetIAreaUnits(GetIAreaUnitsRequest $request, GetIAreaUnitsAction $action)
    {
        // Get the i_area_units
        $i_area_units = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Area units retrieved successfully';
        $resp->status = true;
        $resp->data = $i_area_units;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_area_unit
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIAreaUnitRequest $request, DeleteIAreaUnitAction $action)
    {
        // Delete the i_area_unit
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Area unit deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }
}
