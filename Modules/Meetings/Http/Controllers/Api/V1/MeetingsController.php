<?php

namespace Modules\Meetings\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Meetings\Http\Controllers\Actions\CreateMeetingAction;
use Modules\Meetings\Http\Controllers\Actions\DeleteMeetingAction;
use Modules\Meetings\Http\Controllers\Actions\UpdateMeetingAction;
use Modules\Meetings\Http\Controllers\Actions\GetMeetingsAction;
use Modules\Meetings\Http\Requests\CreateMeetingRequest;
use Modules\Meetings\Http\Requests\DeleteMeetingRequest;
use Modules\Meetings\Http\Requests\UpdateMeetingRequest;
use Modules\Meetings\Meeting;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth, Lang;
use App\Language;

class MeetingsController extends Controller
{
    /**
     * Store meeting
     *
     * @param  [integer] user_id 
     * @param  [string] meeting_type
     * @return [json] ServiceResponse object
     */
    public function store(CreateMeetingRequest $request, CreateMeetingAction $action)
    {
        // Create the meeting
        $meeting = $action->execute($request->all());

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Meeting created successfully';
        $resp->status = true;
        $resp->data = $meeting;
        return response()->json($resp, 200);
    }

    /**
     * Update meeting
     *
     * @param  [integer] id
     * @param  [integer] user_id 
     * @param  [string] meeting_type
     * @return [json] ServiceResponse object
     */
    public function update(UpdateMeetingRequest $request, UpdateMeetingAction $action)
    {
        // Update the meeting
        $meeting = $action->execute($request->input('id'), $request->except('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Meeting updated successfully';
        $resp->status = true;
        $resp->data = $meeting;
        return response()->json($resp, 200);
    }

    /**
     * Delete meeting
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteMeetingRequest $request, DeleteMeetingAction $action)
    {
        // Delete the meeting
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Meeting deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index meetings
     * @return Response
     */
    public function index(Request $request)
    {
        // Search the meeting
        $action = new GetMeetingsAction;
        $meeting = $action->execute($request);
        
        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Meetings retrieved successfully';
        $resp->status = true;
        $resp->data = $meeting;
        return response()->json($resp, 200);
    }
}
