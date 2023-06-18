<?php

namespace Modules\Inventory\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth,Lang;
use App\Http\Resources\MediaResource;
use Yajra\Datatables\Datatables;
use Modules\Inventory\Http\Requests\SellRequests\CreateISellRequestRequest;
use Modules\Inventory\Http\Requests\SellRequests\UpdateISellRequestRequest;
use Modules\Inventory\Http\Requests\SellRequests\DeleteISellRequestRequest;
use Modules\Inventory\Http\Controllers\Actions\SellRequests\CreateISellRequestAction;
use Modules\Inventory\Http\Controllers\Actions\SellRequests\UpdateISellRequestAction;
use Modules\Inventory\Http\Controllers\Actions\SellRequests\DeleteISellRequestAction;
use Modules\Inventory\Http\Controllers\Actions\SellRequests\GetISellRequestByIdAction;
use Modules\Inventory\Http\Controllers\Actions\SellRequests\SearchISellRequestsQueryAction;
use Modules\Inventory\ISellRequest;
use Modules\Inventory\Http\Controllers\Actions\Purposes\GetIPurposesAction;

class ISellRequestsController extends Controller
{
    /**
     * Create i_sell_request
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
        // Create the i_sell_request

        $i_sell_request = $action->execute($request->all(), $request->attachments);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Sell request received successfully';
        $resp->status = true;
        $resp->data = $i_sell_request;
        return response()->json($resp, 200);
    }

    /**
     * Update i_sell_request
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
        // Update the i_sell_request
        $i_sell_request = $action->execute($request->input('id'), $request->except(['id']), $request->attachments);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Sell request updated successfully';
        $resp->status = true;
        $resp->data = $i_sell_request;
        return response()->json($resp, 200);
    }
    /**
     * Delete i_sell_request
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteISellRequestRequest $request, DeleteISellRequestAction $action)
    {
        // Delete the i_sell_request
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Sell request deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index i_sell_requests
     * @return Response
     */
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the i_sell_requests
            $action = new SearchISellRequestsQueryAction;
            $i_sell_requests = $action->execute($auth_user, $request);
            return Datatables::of($i_sell_requests)
                ->addColumn('created_at', function ($i_sell_request) {
                    return $i_sell_request->created_at ? $i_sell_request->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function ($i_sell_request) {
                    return $i_sell_request->updated_at ? $i_sell_request->updated_at->toDateTimeString() : null;
                })
                ->orderColumn('created_at', function ($query, $order) {
                    return  $query->orderBy('created_at', $order);
                })
                ->orderColumn('last_updated_at', function ($query, $order) {
                    return  $query->orderBy('updated_at', $order);
                })
                ->make(true);
        } else {
            $blade_name = ($request->ajax() ? 'index-partial' : 'index'); // Handle Partial Return

            return view('inventory::sell_requests.' . $blade_name, []);
        }
    }

    public function show($id)
    {
        // Get sell request 
        $action = new GetISellRequestByIdAction();
        $i_sell_request = json_decode(json_encode($action->execute($id)));

        // Update sell request is seen value
        ISellRequest::find($id)->update([
            'is_seen' => 1
        ]);

        return view('inventory::sell_requests.modals.view',compact('i_sell_request'))->render();
    }

    /**
     * Create i_sell_request
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('inventory::sell_requests.' . $blade_name, []);
    }

    public function createISellRequestModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        $action = new GetIPurposesAction;
        $purposes = json_decode(json_encode($action->execute()));

        return view('inventory::sell_requests.modals.create',compact('purposes'),[])->render();
    }

    public function UpdateISellRequestModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $i_sell_request = ISellRequest::find($id);
        $attachments = json_decode(json_encode(MediaResource::collection($i_sell_request->getMedia(request()->getHttpHost() . ',inventory,sell_requests,' . $i_sell_request->id . ',' . 'attachments'))));

        $action = new GetIPurposesAction;
        $purposes = json_decode(json_encode($action->execute()));

        // If i_sell_request does not exist, return error div
        if (!$i_sell_request) {
            $error = Lang::get('inventory::inventory.i_sell_request_not_found_or_you_are_not_authorized_to_edit_the_i_sell_request');
            return view('dashboard.components.error', compact('error'))->render();
        }

        return view('inventory::sell_requests.modals.update', compact('i_sell_request', 'attachments','purposes'), [])->render();
    }
}
