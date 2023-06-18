<?php

namespace Modules\Events\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Events\Http\Controllers\Actions\SearchEventsQueryAction;
use Modules\Events\Http\Controllers\Actions\CreateEventAction;
use Modules\Events\Http\Controllers\Actions\DeleteEventAction;
use Modules\Events\Http\Controllers\Actions\GetEventsAction;
use Modules\Events\Http\Controllers\Actions\UpdateEventAction;
use Modules\Events\Http\Requests\CreateEventRequest;
use Modules\Events\Http\Requests\DeleteEventRequest;
use Modules\Events\Http\Requests\GetEventsRequest;
use Modules\Events\Http\Requests\UpdateEventRequest;
use Modules\Events\Http\Resources\EventResource;
use Modules\Events\Event;
use App\Http\Helpers\ServiceResponse;
use App\Http\Resources\MediaResource;
use Carbon\Carbon;
use Auth, Lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Yajra\Datatables\Datatables;
use App\Language;

class EventsController extends Controller
{
    /**
     * Store event
     *
     * @param  [array] translations 
     * @param  [boolean] is_featured
     * @param  [date] start_date
     * @param  [date] end_date
     * @return [json] ServiceResponse object
     */
    public function store(CreateEventRequest $request, CreateEventAction $action)
    {
        // Create the event
        $event = $action->execute($request->except(['attachments']), $request->attachments);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Event created successfully';
        $resp->status = true;
        $resp->data = ['redirect_to' => route('events.index'), 'event' => $event];

        return response()->json($resp, 200);
    }
    /**
     * Update event
     *
     * @param  [integer] id
     * @param  [array] translations 
     * @param  [boolean] is_featured
     * @param  [date] start_date
     * @param  [date] end_date
     * @return [json] ServiceResponse object
     */
    public function update(UpdateEventRequest $request, UpdateEventAction $action)
    {
        // Update the event
        $event = $action->execute($request->input('id'), $request->except(['id', 'attachments']), $request->attachments);
        
        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Event updated successfully';
        $resp->status = true;
        $resp->data = $event;

        return response()->json($resp, 200);
    }
    /**
     * Delete event
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteEventRequest $request, DeleteEventAction $action)
    {
        // Delete the event
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Event deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index events
     * @return Response
     */
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {

            // Search the events
            $action = new SearchEventsQueryAction;
            $events = $action->execute($auth_user, $request);

            return Datatables::of($events)
                ->addColumn('value', function ($event) {
                    return $event->value;
                })
                ->filterColumn('value', function ($query, $keyword) {
                    $query->whereHas('translations', function ($translation) use ($keyword) {
                        $translation->where('title', 'like', '%' . $keyword . '%');
                    });
                })
                ->addColumn('created_at', function ($event) {
                    return $event->created_at ? $event->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function ($event) {
                    return $event->updated_at ? $event->updated_at->toDateTimeString() : null;
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

            return view('events::events.' . $blade_name);
        }
    }

    /**
     * Create event
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();
        
        // Get the languages
        $languages = Language::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('events::events.' . $blade_name, compact('languages'), []);
    }

    public function createEventModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();
        
        // Get the languages
        $languages = Language::all();

        return view('events::events.create', compact('languages'), [])->render();
    }

    public function UpdateEventModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $event = Event::find($id);
        $attachments = MediaResource::collection($event->getMedia(request()->getHttpHost() . ',events,' . $event->id . ',' . 'attachments'));
       
        // If event does not exist, return error div
        if (!$event) {
            $error = Lang::get('events::event.event_not_found_or_you_are_not_authorized_to_edit_the_event');
           
            return view('dashboard.components.error', compact('error'))->render();
        }
        // Get the languages
        $languages = Language::all();

        return view('events::events.modals.update', compact('event', 'languages', 'attachments'), [])->render();
    }
}
