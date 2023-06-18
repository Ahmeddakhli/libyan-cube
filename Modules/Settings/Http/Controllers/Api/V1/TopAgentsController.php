<?php

namespace Modules\Settings\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Settings\Http\Controllers\Actions\TopAgents\CreateTopAgentAction;
use Modules\Settings\Http\Controllers\Actions\TopAgents\DeleteTopAgentAction;
use Modules\Settings\Http\Controllers\Actions\TopAgents\GetTopAgentsAction;
use Modules\Settings\Http\Controllers\Actions\TopAgents\UpdateTopAgentAction;
use Modules\Settings\Http\Requests\TopAgents\CreateTopAgentRequest;
use Modules\Settings\Http\Requests\TopAgents\DeleteTopAgentRequest;
use Modules\Settings\Http\Requests\TopAgents\UpdateTopAgentRequest;
use App\Http\Helpers\ServiceResponse;

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
        $top_agent = $action->execute($request->input('id'), $request->except('id'));

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
    public function index(Request $request, GetTopAgentsAction $action)
    {
        // Get contact
        $top_agents = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Top agents retrieved successfully';
        $resp->status = true;
        $resp->data = $top_agents;
        return response()->json($resp, 200);
    }
}
