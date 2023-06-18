<?php

namespace Modules\Services\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class ServicesEventServiceProvider extends ServiceProvider
{
    protected $listen = [
        // Service Events
        'service.created' => [
            'Modules\Services\Events\ServiceEvents@serviceCreated',
        ],
        'service.updated' => [
            'Modules\Services\Events\ServiceEvents@serviceUpdated',
        ],
        'service.saved' => [
            'Modules\Services\Events\ServiceEvents@serviceSaved',
        ],
        'service.deleted' => [
            'Modules\Services\Events\ServiceEvents@serviceDeleted',
        ],
        'service.restored' => [
            'Modules\Services\Events\ServiceEvents@serviceRestored',
        ],

        // Service Translation Events
        'service_translation.created' => [
            'Modules\Services\Events\ServiceTranslationEvents@serviceTranslationCreated',
        ],
        'service_translation.updated' => [
            'Modules\Services\Events\ServiceTranslationEvents@serviceTranslationUpdated',
        ],
        'service_translation.saved' => [
            'Modules\Services\Events\ServiceTranslationEvents@serviceTranslationSaved',
        ],
        'service_translation.deleted' => [
            'Modules\Services\Events\ServiceTranslationEvents@serviceTranslationDeleted',
        ],
    ];
}
