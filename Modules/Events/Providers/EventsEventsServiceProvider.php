<?php

namespace Modules\Events\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventsEventsServiceProvider extends ServiceProvider
{
    protected $listen = [
        // Event Events
        'event.created' => [
            'Modules\Events\Events\EventEvents@eventCreated',
        ],
        'event.updated' => [
            'Modules\Events\Events\EventEvents@eventUpdated',
        ],
        'event.saved' => [
            'Modules\Events\Events\EventEvents@eventSaved',
        ],
        'event.deleted' => [
            'Modules\Events\Events\EventEvents@eventDeleted',
        ],
        'event.restored' => [
            'Modules\Events\Events\EventEvents@eventRestored',
        ],

        // Event Translation Events
        'event_translation.created' => [
            'Modules\Events\Events\EventTranslationEvents@eventTranslationCreated',
        ],
        'event_translation.updated' => [
            'Modules\Events\Events\EventTranslationEvents@eventTranslationUpdated',
        ],
        'event_translation.saved' => [
            'Modules\Events\Events\EventTranslationEvents@eventTranslationSaved',
        ],
        'event_translation.deleted' => [
            'Modules\Events\Events\EventTranslationEvents@eventTranslationDeleted',
        ],
    ];
}
