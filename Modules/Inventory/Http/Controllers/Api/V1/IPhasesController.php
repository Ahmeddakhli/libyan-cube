<?php

namespace Modules\Inventory\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Inventory\Http\Controllers\Actions\Phases\CreateIPhaseAction;
use Modules\Inventory\Http\Controllers\Actions\Phases\DeleteIPhaseAction;
use Modules\Inventory\Http\Controllers\Actions\Phases\GetIPhasesAction;
use Modules\Inventory\Http\Controllers\Actions\Phases\UpdateIPhaseAction;
use Modules\Inventory\Http\Requests\Phases\CreateIPhaseRequest;
use Modules\Inventory\Http\Requests\Phases\DeleteIPhaseRequest;
use Modules\Inventory\Http\Requests\Phases\GetIPhasesRequest;
use Modules\Inventory\Http\Requests\Phases\UpdateIPhaseRequest;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth;

class IPhasesController extends Controller
{
    /**
     * Store i_phase
     *
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateIPhaseRequest $request, CreateIPhaseAction $action)
    {
        // Create the i_phase
        $i_phase = $action->execute($request->except(['attachments'], $request->attachments));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Phase created successfully';
        $resp->status = true;
        $resp->data = $i_phase;
        return response()->json($resp, 200);
    }

    /**
     * Update i_phase
     *
     * @param  [integer] id
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIPhaseRequest $request, UpdateIPhaseAction $action)
    {
        // Update the i_phase
        $i_phase = $action->execute($request->input('id'), $request->except(['id', 'attachments']), $request->attachments);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Phase updated successfully';
        $resp->status = true;
        $resp->data = $i_phase;
        return response()->json($resp, 200);
    }

    /**
     * Get i_phases
     *
     * @return [json] ServiceResponse object
     */
    public function GetIPhases(GetIPhasesRequest $request, GetIPhasesAction $action)
    {
        // Get the i_phases
        $i_phases = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Phases retrieved successfully';
        $resp->status = true;
        $resp->data = $i_phases;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_phase
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIPhaseRequest $request, DeleteIPhaseAction $action)
    {
        // Delete the i_phase
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Phase deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }
}
