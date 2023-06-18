<?php

namespace Modules\Tags\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class TagsEventServiceProvider extends ServiceProvider
{
    protected $listen = [
         // Tag Events
        'tag.created' => [
            'Modules\Tags\Events\TagEvents@tagCreated',
        ],
        'tag.updated' => [
            'Modules\Tags\Events\TagEvents@tagUpdated',
        ],
        'tag.saved' => [
            'Modules\Tags\Events\TagEvents@tagSaved',
        ],
        'tag.deleted' => [
            'Modules\Tags\Events\TagEvents@tagDeleted',
        ],
        'tag.restored' => [
            'Modules\Tags\Events\TagEvents@tagRestored',
        ],
    ];
}