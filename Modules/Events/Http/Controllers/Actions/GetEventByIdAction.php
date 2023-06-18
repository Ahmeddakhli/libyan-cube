<?php

namespace Modules\Events\Http\Controllers\Actions;

use Modules\Events\Event;
use Modules\Events\Http\Resources\EventResource;

class GetEventByIdAction
{
    public function execute($id)
    {
        // Find the event 
        $event = Event::find($id);

        // Return transformed event
        return new EventResource($event);
    }
}
