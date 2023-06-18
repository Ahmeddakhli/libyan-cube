<?php

namespace Modules\WelcomeMessages\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\WelcomeMessages\Http\Controllers\Actions\SearchWelcomeMessagesQueryAction;
use Modules\WelcomeMessages\Http\Controllers\Actions\CreateWelcomeMessageAction;
use Modules\WelcomeMessages\Http\Controllers\Actions\DeleteWelcomeMessageAction;
use Modules\WelcomeMessages\Http\Controllers\Actions\UpdateWelcomeMessageAction;
use Modules\WelcomeMessages\Http\Requests\CreateWelcomeMessageRequest;
use Modules\WelcomeMessages\Http\Requests\DeleteWelcomeMessageRequest;
use Modules\WelcomeMessages\Http\Requests\UpdateWelcomeMessageRequest;
use Modules\WelcomeMessages\WelcomeMessage;
use App\Http\Helpers\ServiceResponse;
use Auth, Lang;
use Yajra\Datatables\Datatables;
use App\Language;

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
        $resp->message = 'Welcome message created successfully';
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
        $resp->message = 'Welcome message updated successfully';
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
        $resp->message = 'Welcome message deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index Welcome messages
     * @return Response
     */
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the Welcome messages
            $action = new SearchWelcomeMessagesQueryAction;
            $welcome_messages = $action->execute($auth_user, $request);

            return Datatables::of($welcome_messages)
                ->addColumn('value', function ($welcome_message) {
                    return $welcome_message->value;
                })
                ->filterColumn('value', function($query, $keyword) {
                    $query->whereHas('translations', function($translation) use ($keyword) {
                        $translation->where('title', 'like', '%'.$keyword.'%');
                    });
                })
                ->addColumn('created_at', function ($welcome_message) {
                    return $welcome_message->created_at ? $welcome_message->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function ($welcome_message) {
                    return $welcome_message->updated_at ? $welcome_message->updated_at->toDateTimeString() : null;
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
            return view('welcome_messages::welcome_messages.' . $blade_name);
        }
    }

    /**
     * Create welcome message
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('welcome_messages::welcome_messages.' . $blade_name, compact('languages'), []);
    }

    public function createWelcomeMessageModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        return view('welcome_messages::welcome_messages.modals.create', compact('languages'), [])->render();
    }

    public function UpdateWelcomeMessageModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $welcome_message = WelcomeMessage::find($id);

        // If welcome message does not exist, return error div
        if (!$welcome_message) {
            $error = Lang::get('welcome_messages::welcome_messages.welcome_message_secion_not_found_or_you_are_not_authorized_to_edit_the_welcome_message_section');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the languages
        $languages = Language::all();

        return view('welcome_messages::welcome_messages.modals.update', compact('welcome_message', 'languages'), [])->render();
    }
}
