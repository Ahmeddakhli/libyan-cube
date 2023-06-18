<?php

namespace Modules\Events\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
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
use Carbon\Carbon;
use Auth, Lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Language;

class EventsController extends Controller
{
    /**
     * Store event
     *
     * @param  [array] translations 
     * @param  [date] start_date
     * @param  [date] end_date
     * @param  [boolean] is_featured
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
        $resp->data = $event;

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
    public function index(Request $request, GetEventsAction $action)
    {
        // Get events
        $events = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Events retrieved successfully';
        $resp->status = true;
        $resp->data = $events;

        return response()->json($resp, 200);
    }
}
