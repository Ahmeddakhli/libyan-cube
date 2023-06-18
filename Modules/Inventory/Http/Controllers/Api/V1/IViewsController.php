<?php

namespace Modules\Inventory\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Http\Controllers\Actions\Views\CreateIViewAction;
use Modules\Inventory\Http\Controllers\Actions\Views\DeleteIViewAction;
use Modules\Inventory\Http\Controllers\Actions\Views\GetIViewsAction;
use Modules\Inventory\Http\Controllers\Actions\Views\UpdateIViewAction;
use Modules\Inventory\Http\Requests\Views\CreateIViewRequest;
use Modules\Inventory\Http\Requests\Views\DeleteIViewRequest;
use Modules\Inventory\Http\Requests\Views\GetIViewsRequest;
use Modules\Inventory\Http\Requests\Views\UpdateIViewRequest;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth;

class IViewsController extends Controller
{
    /**
     * Store i_view
     *
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateIViewRequest $request, CreateIViewAction $action)
    {
        // Create the i_view
        $i_view = $action->execute($request->except([]));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'View created successfully';
        $resp->status = true;
        $resp->data = $i_view;
        return response()->json($resp, 200);
    }

    /**
     * Update i_view
     *
     * @param  [integer] id
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIViewRequest $request, UpdateIViewAction $action)
    {
        // Update the i_view
        $i_view = $action->execute($request->input('id'), $request->except(['id']));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'View updated successfully';
        $resp->status = true;
        $resp->data = $i_view;
        return response()->json($resp, 200);
    }

    /**
     * Get i_views
     *
     * @return [json] ServiceResponse object
     */
    public function GetIViews(GetIViewsRequest $request, GetIViewsAction $action)
    {
        // Get the i_views
        $i_views = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Views retrieved successfully';
        $resp->status = true;
        $resp->data = $i_views;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_view
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIViewRequest $request, DeleteIViewAction $action)
    {
        // Delete the i_view
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'View deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }
}
