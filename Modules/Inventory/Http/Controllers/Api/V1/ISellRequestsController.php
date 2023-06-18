<?php

namespace Modules\Inventory\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth;
use Modules\Inventory\Http\Requests\SellRequests\CreateISellRequestRequest;
use Modules\Inventory\Http\Requests\SellRequests\UpdateISellRequestRequest;
use Modules\Inventory\Http\Requests\SellRequests\GetISellRequestRequest;
use Modules\Inventory\Http\Requests\SellRequests\DeleteISellRequestRequest;
use Modules\Inventory\Http\Controllers\Actions\SellRequests\CreateISellRequestAction;
use Modules\Inventory\Http\Controllers\Actions\SellRequests\UpdateISellRequestAction;
use Modules\Inventory\Http\Controllers\Actions\SellRequests\GetISellRequestsAction;
use Modules\Inventory\Http\Controllers\Actions\SellRequests\DeleteISellRequestAction;

class ISellRequestsController extends Controller
{
    /**
     * Create sell request
     *
     * @param  [string] compound
     * @param  [integer] i_purpose_id
     * @param  [integer] i_purpose_type_id
     * @param  [string] unit_name
     * @param  [string] comments
     * @param  [string] name
     * @param  [string] email
     * @param  [string] phone
     * @param  [array] attachments
     * @return [json] ServiceResponse object
     */
    public function store(CreateISellRequestRequest $request, CreateISellRequestAction $action)
    {
        // Create the sell request

        $i_sell_request = $action->execute($request->all(), $request->attachments);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Sell request created successfully';
        $resp->status = true;
        $resp->data = $i_sell_request;
        return response()->json($resp, 200);
    }

    /**
     * Update sell request
     *
     * @param  [integer] id
     * @param  [string] compound
     * @param  [integer] i_purpose_id
     * @param  [integer] i_purpose_type_id
     * @param  [string] unit_name
     * @param  [string] comments
     * @param  [string] name
     * @param  [string] email
     * @param  [string] phone
     * @param  [array] attachments
     * @return [json] ServiceResponse object
     */
    public function update(UpdateISellRequestRequest $request, UpdateISellRequestAction $action)
    {
        // Update the sell request
        $i_sell_request = $action->execute($request->input('id'), $request->except(['id']), $request->attachments);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Sell request updated successfully';
        $resp->status = true;
        $resp->data = $i_sell_request;
        return response()->json($resp, 200);
    }

    /**
     * Get sell requests
     *
     * @return [json] ServiceResponse object
     */
    public function index(GetISellRequestRequest $request, GetISellRequestsAction $action)
    {
        // Get sell requests
        $i_sell_requests = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Sell requests retrieved successfully';
        $resp->status = true;
        $resp->data = $i_sell_requests;
        return response()->json($resp, 200);
    }

    /**
     * Delete sell request
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteISellRequestRequest $request, DeleteISellRequestAction $action)
    {
        // Delete the sell request
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Sell request deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }
}
