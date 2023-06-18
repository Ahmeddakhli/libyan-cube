<?php

namespace Modules\WelcomeMessages\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\WelcomeMessages\Http\Controllers\Actions\CreateWelcomeMessageAction;
use Modules\WelcomeMessages\Http\Controllers\Actions\DeleteWelcomeMessageAction;
use Modules\WelcomeMessages\Http\Controllers\Actions\GetWelcomeMessageAction;
use Modules\WelcomeMessages\Http\Controllers\Actions\UpdateWelcomeMessageAction;
use Modules\WelcomeMessages\Http\Requests\CreateWelcomeMessageRequest;
use Modules\WelcomeMessages\Http\Requests\DeleteWelcomeMessageRequest;
use Modules\WelcomeMessages\Http\Requests\UpdateWelcomeMessageRequest;
use App\Http\Helpers\ServiceResponse;

class WelcomeMessagesController extends Controller
{
    /**
     * Store welcome message
     *
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateWelcomeMessageRequest $request, CreateWelcomeMessageAction $action)
    {
        // Create the welcome message
        $welcome_message = $action->execute($request->except([]), $request->translations);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'WelcomeMessage section created successfully';
        $resp->status = true;
        $resp->data = $welcome_message;
        return response()->json($resp, 200);
    }

    /**
     * Update welcome message
     *
     * @param  [integer] id
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateWelcomeMessageRequest $request, UpdateWelcomeMessageAction $action)
    {
        // Update the welcome message
        $welcome_message = $action->execute($request->input('id'), $request->except(['id']), $request->translations);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'WelcomeMessage section updated successfully';
        $resp->status = true;
        $resp->data = $welcome_message;
        return response()->json($resp, 200);
    }

    /**
     * Delete welcome message
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteWelcomeMessageRequest $request, DeleteWelcomeMessageAction $action)
    {
        // Delete the welcome message
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'WelcomeMessage section deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index WelcomeMessage sections
     * @return Response
     */
    public function index(Request $request, GetWelcomeMessageAction $action)
    {
        $welcome_message_sections = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'WelcomeMessage sections retrieved successfully';
        $resp->status = true;
        $resp->data = $welcome_message_sections;
        return response()->json($resp, 200);
    }
}
