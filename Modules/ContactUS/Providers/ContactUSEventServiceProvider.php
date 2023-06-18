<?php

namespace Modules\ContactUS\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class ContactUSEventServiceProvider extends ServiceProvider
{
    protected $listen = [
        // ContactUs Events
        'contact_us.created' => [
            'Modules\ContactUS\Events\ContactUsEvents@contactUsCreated',
        ],
        'contact_us.updated' => [
            'Modules\ContactUS\Events\ContactUsEvents@contactUsUpdated',
        ],
        'contact_us.saved' => [
            'Modules\ContactUS\Events\ContactUsEvents@contactUsSaved',
        ],
        'contact_us.deleted' => [
            'Modules\ContactUS\Events\ContactUsEvents@contactUsDeleted',
        ],
        'contact_us.restored' => [
            'Modules\ContactUS\Events\ContactUsEvents@contactUsRestored',
        ],

        // Subscribe Events
        'subscribe.created' => [
            'Modules\ContactUS\Events\SubscribeEvents@subscribeCreated',
        ],
        'subscribe.updated' => [
            'Modules\ContactUS\Events\SubscribeEvents@subscribeUpdated',
        ],
        'subscribe.saved' => [
            'Modules\ContactUS\Events\SubscribeEvents@subscribeSaved',
        ],
        'subscribe.deleted' => [
            'Modules\ContactUS\Events\SubscribeEvents@subscribeDeleted',
        ],
        'subscribe.restored' => [
            'Modules\ContactUS\Events\SubscribeEvents@subscribeRestored',
        ],
    ];
}