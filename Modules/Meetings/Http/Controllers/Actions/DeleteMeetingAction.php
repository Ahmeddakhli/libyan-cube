<?php

namespace Modules\Meetings\Http\Controllers\Actions;

use Modules\Meetings\Meeting;

class DeleteMeetingAction
{
    public function execute($id)
    {
        // Delete meeting
        $meeting = Meeting::find($id)->delete();

        // Return the response
        return $meeting;
    }
}
