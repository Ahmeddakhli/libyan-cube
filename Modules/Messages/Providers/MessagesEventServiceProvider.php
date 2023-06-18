<?php

namespace Modules\Messages\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class MessagesEventServiceProvider extends ServiceProvider
{
    protected $listen = [
         // Message Events
        'message.created' => [
            'Modules\Messages\Events\MessageEvents@messageCreated',
        ],
        'message.updated' => [
            'Modules\Messages\Events\MessageEvents@messageUpdated',
        ],
        'message.saved' => [
            'Modules\Messages\Events\MessageEvents@messageSaved',
        ],
        'message.deleted' => [
            'Modules\Messages\Events\MessageEvents@messageDeleted',
        ],
        'message.restored' => [
            'Modules\Messages\Events\MessageEvents@messageRestored',
        ],
    ];
}