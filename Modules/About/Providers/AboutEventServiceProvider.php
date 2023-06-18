<?php

namespace Modules\About\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class AboutEventServiceProvider extends ServiceProvider
{
    protected $listen = [
         // About Events
        'about.created' => [
            'Modules\About\Events\AboutEvents@aboutCreated',
        ],
        'about.updated' => [
            'Modules\About\Events\AboutEvents@aboutUpdated',
        ],
        'about.saved' => [
            'Modules\About\Events\AboutEvents@aboutSaved',
        ],
        'about.deleted' => [
            'Modules\About\Events\AboutEvents@aboutDeleted',
        ],
        'about.restored' => [
            'Modules\About\Events\AboutEvents@aboutRestored',
        ],
    ];
}