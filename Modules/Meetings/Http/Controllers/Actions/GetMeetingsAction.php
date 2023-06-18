<?php

namespace Modules\Meetings\Http\Controllers\Actions;

use Modules\Meetings\Meeting;
use Modules\Meetings\Http\Resources\MeetingResource;

class GetMeetingsAction
{
    public function execute()
    {
        // Get meetings 
        $meetings = Meeting::all();
        
        // Return transformed response 
        return MeetingResource::collection($meetings);
    }
}
