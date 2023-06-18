<?php

namespace Modules\Meetings\Http\Controllers\Actions;

use Modules\Meetings\Meeting;
use Modules\Meetings\Http\Resources\MeetingResource;

class UpdateMeetingAction
{
    function execute($id, $data)
    {
        // Get meeting
        $meeting = Meeting::find($id);

        // Update meeting
        $meeting->update($data);

        // Return transformed response
        return new MeetingResource($meeting);
    }
}
