<?php

namespace Modules\Events\Http\Controllers\Actions;

use Cache;
use Modules\Events\Event;
use Modules\Events\Http\Resources\EventResource;

class GetEventsAction
{
    public function execute()
    {
        // Get events
        $events = Event::all();

        // Transform event
        $events = EventResource::collection($events);

        // Return the response
        return $events;
    }
}
