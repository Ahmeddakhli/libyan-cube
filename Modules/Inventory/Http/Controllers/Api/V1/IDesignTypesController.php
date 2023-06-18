<?php

namespace Modules\Inventory\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Http\Controllers\Actions\DesignTypes\CreateIDesignTypeAction;
use Modules\Inventory\Http\Controllers\Actions\DesignTypes\DeleteIDesignTypeAction;
use Modules\Inventory\Http\Controllers\Actions\DesignTypes\GetIDesignTypesAction;
use Modules\Inventory\Http\Controllers\Actions\DesignTypes\UpdateIDesignTypeAction;
use Modules\Inventory\Http\Requests\DesignTypes\CreateIDesignTypeRequest;
use Modules\Inventory\Http\Requests\DesignTypes\DeleteIDesignTypeRequest;
use Modules\Inventory\Http\Requests\DesignTypes\GetIDesignTypesRequest;
use Modules\Inventory\Http\Requests\DesignTypes\UpdateIDesignTypeRequest;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth;

class IDesignTypesController extends Controller
{
    /**
     * Store i_design_type
     *
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateIDesignTypeRequest $request, CreateIDesignTypeAction $action)
    {
        // Create the i_design_type
        $i_design_type = $action->execute($request->except([]), $request->attachments);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Design type created successfully';
        $resp->status = true;
        $resp->data = $i_design_type;
        return response()->json($resp, 200);
    }

    /**
     * Update i_design_type
     *
     * @param  [integer] id
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIDesignTypeRequest $request, UpdateIDesignTypeAction $action)
    {
        // Update the i_design_type
        $i_design_type = $action->execute($request->input('id'), $request->except(['id']), $request->attachments);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Design type updated successfully';
        $resp->status = true;
        $resp->data = $i_design_type;
        return response()->json($resp, 200);
    }

    /**
     * Get i_design_types
     *
     * @return [json] ServiceResponse object
     */
    public function GetIDesignTypes(GetIDesignTypesRequest $request, GetIDesignTypesAction $action)
    {
        // Get the i_design_types
        $i_design_types = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Design types retrieved successfully';
        $resp->status = true;
        $resp->data = $i_design_types;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_design_type
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIDesignTypeRequest $request, DeleteIDesignTypeAction $action)
    {
        // Delete the i_design_type
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Design type deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }
}
