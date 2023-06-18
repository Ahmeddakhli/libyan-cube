<?php

namespace Modules\Meetings\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class MeetingsEventServiceProvider extends ServiceProvider
{
    protected $listen = [
         // Meeting Events
        'meeting.created' => [
            'Modules\Meetings\Events\MeetingEvents@meetingCreated',
        ],
        'meeting.updated' => [
            'Modules\Meetings\Events\MeetingEvents@meetingUpdated',
        ],
        'meeting.saved' => [
            'Modules\Meetings\Events\MeetingEvents@meetingSaved',
        ],
        'meeting.deleted' => [
            'Modules\Meetings\Events\MeetingEvents@meetingDeleted',
        ],
        'meeting.restored' => [
            'Modules\Meetings\Events\MeetingEvents@meetingRestored',
        ],
    ];
}