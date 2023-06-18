<?php

namespace Modules\ContactUS\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\ContactUS\Http\Controllers\Actions\Subscribes\CreateSubscribeAction;
use Modules\ContactUS\Http\Controllers\Actions\Subscribes\DeleteSubscribeAction;
use Modules\ContactUS\Http\Controllers\Actions\Subscribes\UpdateSubscribeAction;
use Modules\ContactUS\Http\Controllers\Actions\Subscribes\GetSubscribesAction;
use Modules\ContactUS\Http\Requests\Subscribes\CreateSubscribeRequest;
use Modules\ContactUS\Http\Requests\Subscribes\DeleteSubscribeRequest;
use Modules\ContactUS\Http\Requests\Subscribes\UpdateSubscribeRequest;
use Modules\ContactUS\ContactUs;
use App\Http\Helpers\ServiceResponse;
use Auth, Lang;
use App\Language;

class SubscribesController extends Controller
{
    /**
     * Store subscribe
     *
     * @param  [string] email
     * @return [json] ServiceResponse object
     */
    public function store(CreateSubscribeRequest $request, CreateSubscribeAction $action)
    {
        // Create the subscribe
        $subscribe = $action->execute($request->all());

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Thanks for subscribing with us.';
        $resp->status = true;
        $resp->data = $subscribe;
        return response()->json($resp, 200);
    }

    /**
     * Update subscribe
     *
     * @param  [integer] id
     * @param  [string] email
     * @return [json] ServiceResponse object
     */
    public function update(UpdateSubscribeRequest $request, UpdateSubscribeAction $action)
    {
        // Update the subscribe
        $subscribe = $action->execute($request->input('id'), $request->except(['id']));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Subscription updated successfully';
        $resp->status = true;
        $resp->data = $subscribe;
        return response()->json($resp, 200);
    }

    /**
     * Delete subscribe
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteSubscribeRequest $request, DeleteSubscribeAction $action)
    {
        // Delete the subscribe
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Subscription deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index subscribe
     * @return Response
     */
    public function index(Request $request, GetSubscribesAction $action)
    {
        // Get subscribe
        $subscribe = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Subscriptions retrieved successfully';
        $resp->status = true;
        $resp->data = $subscribe;
        return response()->json($resp, 200);
    }
}
