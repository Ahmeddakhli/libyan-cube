<?php

namespace Modules\WelcomeMessages\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class WelcomeMessagesEventServiceProvider extends ServiceProvider
{
    protected $listen = [
         // Welcome Message Events
        'welcome_message.created' => [
            'Modules\WelcomeMessages\Events\WelcomeMessageEvents@welcomeMessageCreated',
        ],
        'welcome_message.updated' => [
            'Modules\WelcomeMessages\Events\WelcomeMessageEvents@welcomeMessageUpdated',
        ],
        'welcome_message.saved' => [
            'Modules\WelcomeMessages\Events\WelcomeMessageEvents@welcomeMessageSaved',
        ],
        'welcome_message.deleted' => [
            'Modules\WelcomeMessages\Events\WelcomeMessageEvents@welcomeMessageDeleted',
        ],
        'welcome_message.restored' => [
            'Modules\WelcomeMessages\Events\WelcomeMessageEvents@welcomeMessageRestored',
        ],
    ];
}