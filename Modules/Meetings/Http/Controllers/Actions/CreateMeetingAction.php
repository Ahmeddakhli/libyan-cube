<?php

namespace Modules\Meetings\Http\Controllers\Actions;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Lang;
use Modules\Meetings\Meeting;
use Modules\Meetings\Http\Resources\MeetingResource;

class CreateMeetingAction
{
    function execute($data)
    {
        // Create meeting
        $meeting = Meeting::create($data);

        // Return transformed response 
        return new MeetingResource($meeting);
    }
}
