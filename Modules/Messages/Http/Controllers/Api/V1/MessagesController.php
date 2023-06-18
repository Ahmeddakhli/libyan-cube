<?php

namespace Modules\Messages\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Messages\Http\Controllers\Actions\CreateMessageAction;
use Modules\Messages\Http\Controllers\Actions\DeleteMessageAction;
use Modules\Messages\Http\Controllers\Actions\UpdateMessageAction;
use Modules\Messages\Http\Controllers\Actions\GetMessagesAction;
use Modules\Messages\Http\Requests\CreateMessageRequest;
use Modules\Messages\Http\Requests\DeleteMessageRequest;
use Modules\Messages\Http\Requests\UpdateMessageRequest;
use Modules\Messages\Message;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth, Lang;
use App\Language;

class MessagesController extends Controller
{
    /**
     * Store message
     * 
     * @param  [integer] $sender_id
     * @param  [integer] $receiver_id
     * @param  [integer] $i_unit_id
     * @param  [string] $name
     * @param  [string] $email
     * @param  [string] $phone
     * @param  [string] $message
     * @return [json] ServiceResponse object
     */
    public function store(CreateMessageRequest $request, CreateMessageAction $action)
    {
        // Create the message
        $message = $action->execute($request->all());

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Message created successfully';
        $resp->status = true;
        $resp->data = $message;
        return response()->json($resp, 200);
    }

    /**
     * Update message
     *
     * @param  [integer] id
     * @param  [integer] $sender_id
     * @param  [integer] $receiver_id
     * @param  [integer] $i_unit_id
     * @param  [string] $name
     * @param  [string] $email
     * @param  [string] $phone
     * @param  [string] $message
     * @return [json] ServiceResponse object
     */
    public function update(UpdateMessageRequest $request, UpdateMessageAction $action)
    {
        // Update the message
        $message = $action->execute($request->input('id'), $request->except('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Message updated successfully';
        $resp->status = true;
        $resp->data = $message;
        return response()->json($resp, 200);
    }

    /**
     * Delete message
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteMessageRequest $request, DeleteMessageAction $action)
    {
        // Delete the message
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Message deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index messages
     * @return Response
     */
    public function index(Request $request)
    {
        // Search the message
        $action = new GetMessagesAction;
        $message = $action->execute($request);
        
        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Messages retrieved successfully';
        $resp->status = true;
        $resp->data = $message;
        return response()->json($resp, 200);
    }
}
