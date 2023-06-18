<?php

namespace Modules\Meetings\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Meetings\Http\Controllers\Actions\SearchMeetingQueryAction;
use Modules\Meetings\Http\Controllers\Actions\CreateMeetingAction;
use Modules\Meetings\Http\Controllers\Actions\DeleteMeetingAction;
use Modules\Meetings\Http\Controllers\Actions\UpdateMeetingAction;
use Modules\Meetings\Http\Requests\CreateMeetingRequest;
use Modules\Meetings\Http\Requests\DeleteMeetingRequest;
use Modules\Meetings\Http\Requests\UpdateMeetingRequest;
use Modules\Meetings\Meeting;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth, Lang;
use Yajra\Datatables\Datatables;
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
        $resp->message = 'Your Meeting Request send successfully';
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
        $meeting = $action->execute($request->input('id'), $request->except(['id']));

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
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {

            // Search the meeting
            $action = new SearchMeetingQueryAction;
            $meeting = $action->execute($auth_user, $request);

            return Datatables::of($meeting)
                ->addColumn('created_at', function ($meeting) {
                    return $meeting->created_at ? $meeting->created_at->toDateTimeString() : null;
                })
                ->filterColumn('user', function ($query, $keyword) {
                    $query->whereHas('user', function ($user) use ($keyword) {
                        $user->where('full_name', 'like', '%' . $keyword . '%');
                    });
                })
                ->addColumn('last_updated_at', function ($meeting) {
                    return $meeting->updated_at ? $meeting->updated_at->toDateTimeString() : null;
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

            return view('meetings::meeting.' . $blade_name);
        }
    }

    /**
     * Create meeting
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('meetings::meeting.' . $blade_name, compact('languages'), []);
    }

    public function createMeetingModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        return view('meetings::meeting.modals.create', compact('languages'), [])->render();
    }

    public function UpdateMeetingModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get meeting
        $meeting = Meeting::find($id);


        // If meeting does not exist, return error div
        if (!$meeting) {
            $error = Lang::get('meetings::meeting.meeting_not_found_or_you_are_not_authorized_to_edit_the_meeting');

            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the languages
        $languages = Language::all();

        return view('meetings::meeting.modals.update', compact('meeting', 'languages'), [])->render();
    }
}
