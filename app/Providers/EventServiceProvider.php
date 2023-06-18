<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        // Groups Events
        'group.created' => [
            'App\Events\GroupEvents@groupCreated',
        ],
        'group.updated' => [
            'App\Events\GroupEvents@groupUpdated',
        ],
        'group.saved' => [
            'App\Events\GroupEvents@groupUpdated',
        ],
        'group.deleted' => [
            'App\Events\GroupEvents@groupDeleted',
        ],
        'group.restored' => [
            'App\Events\GroupEvents@groupUpdated',
        ],
        // User Events
        'user.created' => [
            'App\Events\UserEvents@userCreated',
        ],
        'user.updated' => [
            'App\Events\UserEvents@userUpdated',
        ],
        'user.saved' => [
            'App\Events\UserEvents@userUpdated',
        ],
        'user.deleting' => [
            'App\Events\UserEvents@userDeleting',
        ],
        'user.deleted' => [
            'App\Events\UserEvents@userDeleted',
        ],
        'user.restored' => [
            'App\Events\UserEvents@userUpdated',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
