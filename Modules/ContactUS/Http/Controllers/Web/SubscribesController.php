<?php

namespace Modules\ContactUS\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\ContactUS\Http\Controllers\Actions\Subscribes\SearchSubscribesQueryAction;
use Modules\ContactUS\Http\Controllers\Actions\Subscribes\CreateSubscribeAction;
use Modules\ContactUS\Http\Controllers\Actions\Subscribes\DeleteSubscribeAction;
use Modules\ContactUS\Http\Controllers\Actions\Subscribes\UpdateSubscribeAction;
use Modules\ContactUS\Http\Requests\Subscribes\CreateSubscribeRequest;
use Modules\ContactUS\Http\Requests\Subscribes\DeleteSubscribeRequest;
use Modules\ContactUS\Http\Requests\Subscribes\UpdateSubscribeRequest;
use Modules\ContactUS\Subscribe;
use App\Http\Helpers\ServiceResponse;
use Auth, Lang;
use Yajra\Datatables\Datatables;
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
        $resp->data = ['redirect_to' => route('contact_us.subscribes.index'), 'subscribe' => $subscribe];
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
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search subscribe
            $action = new SearchSubscribesQueryAction;
            $subscribe = $action->execute($auth_user, $request);

            return Datatables::of($subscribe)
                ->addColumn('created_at', function ($subscribe) {
                    return $subscribe->created_at ? $subscribe->created_at->toDateTimeString() : null;
                })
                ->orderColumn('created_at', function ($query, $order) {
                    return  $query->orderBy('created_at', $order);
                })
                // ->orderColumn('last_updated_at', function ($query, $order) {
                //     return  $query->orderBy('updated_at', $order);
                // })
                ->make(true);
        } else {
            $blade_name = ($request->ajax() ? 'index-partial' : 'index'); // Handle Partial Return

            return view('contactus::subscribes.' . $blade_name);
        }
    }

    /**
     * Create subscribe
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('contactus::subscribes.' . $blade_name, compact('languages'), []);
    }

    public function createSubscribeModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        return view('contactus::subscribes.create', compact('languages'), [])->render();
    }

    public function UpdateSubscribeModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        // Find subscribe 
        $subscribe = Subscribe::find($id);

        // If subscribe does not exist, return error div
        if (!$subscribe) {
            $error = Lang::get('contactus::contact_us.subscribe_not_found_or_you_are_not_authorized_to_edit_subscribe');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the languages
        $languages = Language::all();

        return view('contactus::subscribes.modals.update', compact('subscribe', 'languages'), [])->render();
    }
}
