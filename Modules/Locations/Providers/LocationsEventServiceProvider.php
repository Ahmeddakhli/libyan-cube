<?php

namespace Modules\Locations\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class LocationsEventServiceProvider extends ServiceProvider
{
    protected $listen = [
        // Location Events
        'location.created' => [
            'Modules\Locations\Events\LocationEvents@locationCreated',
        ],
        'location.updated' => [
            'Modules\Locations\Events\LocationEvents@locationUpdated',
        ],
        'location.saved' => [
            'Modules\Locations\Events\LocationEvents@locationSaved',
        ],
        'location.deleted' => [
            'Modules\Locations\Events\LocationEvents@locationDeleted',
        ],
        'location.restored' => [
            'Modules\Locations\Events\LocationEvents@locationRestored',
        ],

        // Location Translation Events
        'location_translation.created' => [
            'Modules\Locations\Events\LocationTranslationEvents@locationTranslationCreated',
        ],
        'location_translation.updated' => [
            'Modules\Locations\Events\LocationTranslationEvents@locationTranslationUpdated',
        ],
        'location_translation.saved' => [
            'Modules\Locations\Events\LocationTranslationEvents@locationTranslationSaved',
        ],
        'location_translation.deleted' => [
            'Modules\Locations\Events\LocationTranslationEvents@locationTranslationDeleted',
        ],
        'location_translation.restored' => [
            'Modules\Locations\Events\LocationTranslationEvents@locationTranslationRestored',
        ],
    ];
}
