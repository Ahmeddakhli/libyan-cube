<?php

namespace Modules\Inventory\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth;
use Modules\Inventory\Http\Requests\Developers\CreateIDeveloperRequest;
use Modules\Inventory\Http\Requests\Developers\UpdateIDeveloperRequest;
use Modules\Inventory\Http\Requests\Developers\GetIDevelopersRequest;
use Modules\Inventory\Http\Requests\Developers\DeleteIDeveloperRequest;
use Modules\Inventory\Http\Controllers\Actions\Developers\CreateIDeveloperAction;
use Modules\Inventory\Http\Controllers\Actions\Developers\UpdateIDeveloperAction;
use Modules\Inventory\Http\Controllers\Actions\Developers\GetIDevelopersAction;
use Modules\Inventory\Http\Controllers\Actions\Developers\DeleteIDeveloperAction;

class IDevelopersController extends Controller
{
    /**
     * Create i_developer
     *
     * @param  [string] developer
     * @return [json] ServiceResponse object
     */
    public function store(CreateIDeveloperRequest $request, CreateIDeveloperAction $action)
    {
        // Create the i_developer

        $i_developer = $action->execute($request->all(), $request->attachments);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Developer created successfully';
        $resp->status = true;
        $resp->data = $i_developer;
        return response()->json($resp, 200);
    }

    /**
     * Update i_developer
     *
     * @param  [integer] id
     * @param  [string] developer
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIDeveloperRequest $request, UpdateIDeveloperAction $action)
    {
        // Update the i_developer
        $i_developer = $action->execute($request->input('id'), $request->except(['id']), $request->attachments);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Developer updated successfully';
        $resp->status = true;
        $resp->data = $i_developer;
        return response()->json($resp, 200);
    }

    /**
     * Get i_developers
     *
     * @return [json] ServiceResponse object
     */
    public function GetIDevelopers(GetIDevelopersRequest $request, GetIDevelopersAction $action)
    {
        // Get i_developers
        $i_developers = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Developers retrieved successfully';
        $resp->status = true;
        $resp->data = $i_developers;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_developer
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIDeveloperRequest $request, DeleteIDeveloperAction $action)
    {
        // Delete the i_developer
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Developer deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }
}
