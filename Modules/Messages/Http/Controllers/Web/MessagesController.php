<?php

namespace Modules\Messages\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Messages\Http\Controllers\Actions\SearchMessageQueryAction;
use Modules\Messages\Http\Controllers\Actions\CreateMessageAction;
use Modules\Messages\Http\Controllers\Actions\DeleteMessageAction;
use Modules\Messages\Http\Controllers\Actions\UpdateMessageAction;
use Modules\Messages\Http\Requests\CreateMessageRequest;
use Modules\Messages\Http\Requests\DeleteMessageRequest;
use Modules\Messages\Http\Requests\UpdateMessageRequest;
use Modules\Messages\Message;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth, Lang;
use Yajra\Datatables\Datatables;
use App\Language;
use Modules\Messages\Http\Controllers\Actions\ReadMessageAction;

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
        $message = $action->execute($request->input('id'), $request->except(['id']));

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
        $resp->message = 'message deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * read message
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function read(DeleteMessageRequest $request, ReadMessageAction $action)
    {
        // read the message
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'message readed successfully';
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
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {

            // Search the message
            $action = new SearchMessageQueryAction;
            $message = $action->execute($auth_user, $request);
            $message->with(['sender', 'receiver', 'project']);

            return Datatables::of($message)
                ->addColumn('created_at', function ($message) {
                    return $message->created_at ? $message->created_at->toDateTimeString() : null;
                })
                ->addColumn('sender', function ($message) {
                    return $message->sender ? $message->sender->full_name : '';
                })
                ->filterColumn('sender', function ($query, $keyword) {
                    $query->whereHas('sender', function ($sender) use ($keyword) {
                        $sender->where('full_name', 'like', '%' . $keyword . '%');
                    });
                })
                ->addColumn('receiver', function ($message) {
                    return $message->receiver ? $message->receiver->full_name : '';
                })
                ->filterColumn('receiver', function ($query, $keyword) {
                    $query->whereHas('receiver', function ($receiver) use ($keyword) {
                        $receiver->where('full_name', 'like', '%' . $keyword . '%');
                    });
                })
                ->addColumn('last_updated_at', function ($message) {
                    return $message->updated_at ? $message->updated_at->toDateTimeString() : null;
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

            return view('messages::messages.' . $blade_name);
        }
    }

    /**
     * Create message
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('messages::messages.' . $blade_name, compact('languages'), []);
    }

    public function createMessageModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        return view('messages::messages.modals.create', compact('languages'), [])->render();
    }

    public function UpdateMessageModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get message
        $message = Message::find($id);


        // If message does not exist, return error div
        if (!$message) {
            $error = Lang::get('messages::message.message_not_found_or_you_are_not_authorized_to_edit_the_message');

            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the languages
        $languages = Language::all();

        return view('messages::messages.modals.update', compact('message', 'languages'), [])->render();
    }
}
