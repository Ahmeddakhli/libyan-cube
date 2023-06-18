<?php

namespace Modules\Settings\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Settings\Http\Controllers\Actions\TopAgents\SearchTopAgentsQueryAction;
use Modules\Settings\Http\Controllers\Actions\TopAgents\CreateTopAgentAction;
use Modules\Settings\Http\Controllers\Actions\TopAgents\DeleteTopAgentAction;
use Modules\Settings\Http\Controllers\Actions\TopAgents\UpdateTopAgentAction;
use Modules\Settings\Http\Requests\TopAgents\CreateTopAgentRequest;
use Modules\Settings\Http\Requests\TopAgents\DeleteTopAgentRequest;
use Modules\Settings\Http\Requests\TopAgents\UpdateTopAgentRequest;
use Modules\Settings\TopAgent;
use App\Http\Helpers\ServiceResponse;
use Auth, Lang;
use Yajra\Datatables\Datatables;
use App\Language;
use App\User;

class TopAgentsController extends Controller
{
    /**
     * Store top_agent
     *
     * @param  [integer] user_id
     * @return [json] ServiceResponse object
     */
    public function store(CreateTopAgentRequest $request, CreateTopAgentAction $action)
    {
        // Create the top_agent
        $top_agent = $action->execute($request->all());

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Top agent created successfully';
        $resp->status = true;
        $resp->data = $top_agent;
        return response()->json($resp, 200);
    }

    /**
     * Update top_agent
     *
     * @param  [integer] id
     * @param  [integer] user_id
     * @return [json] ServiceResponse object
     */
    public function update(UpdateTopAgentRequest $request, UpdateTopAgentAction $action)
    {
        // Update the top_agent
        $top_agent = $action->execute($request->input('id'), $request->except(['id']));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Top agent updated successfully';
        $resp->status = true;
        $resp->data = $top_agent;
        return response()->json($resp, 200);
    }

    /**
     * Delete top_agent
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteTopAgentRequest $request, DeleteTopAgentAction $action)
    {
        // Delete the top_agent
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Top agent deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index top_agents
     * @return Response
     */
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the top_agents
            $action = new SearchTopAgentsQueryAction;
            $top_agents = $action->execute($auth_user, $request)->with(['user']);

            return Datatables::of($top_agents)
                ->addColumn('top_agent', function ($top_agent) {
                    return $top_agent->user ? $top_agent->user->full_name : '';
                })
                ->filterColumn('top_agent', function ($query, $keyword) {
                    $query->whereHas('user', function ($user) use ($keyword) {
                        $user->where('username', 'like', '%' . $keyword . '%')->orWhere('email', 'like', '%' . $keyword . '%')->orWhere('full_name', 'like', '%' . $keyword . '%')->orWhere('mobile_number', 'like', '%' . $keyword . '%');
                    });
                })
                ->orderColumn('top_agent', function ($query, $order) {
                    $query->orderBy('user_id', $order);
                })
                ->addColumn('created_at', function ($top_agent) {
                    return $top_agent->created_at ? $top_agent->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function ($top_agent) {
                    return $top_agent->updated_at ? $top_agent->updated_at->toDateTimeString(): null;
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

            return view('settings::top_agents.' . $blade_name);
        }
    }

    /**
     * Create top_agent
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('settings::top_agents.' . $blade_name, compact('languages'), []);
    }

    public function createTopAgentModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();
        $users = User::all();

        return view('settings::top_agents.modals.create', compact('languages', 'users'), [])->render();
    }

    public function updateTopAgentModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();
        $users = User::all();

        $top_agent = TopAgent::find($id);
        // If top_agent does not exist, return error div
        if (!$top_agent) {
            $error = Lang::get('settings::settings.top_agent_not_found_or_you_are_not_authorized_to_edit_the_top_agent');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the languages
        $languages = Language::all();

        return view('settings::top_agents.modals.update', compact('top_agent', 'languages', 'users'), [])->render();
    }
}
