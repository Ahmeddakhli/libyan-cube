<?php

namespace Modules\Socials\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class SocialsEventServiceProvider extends ServiceProvider
{
    protected $listen = [
        // Social Events
        'social.created' => [
            'Modules\Socials\Events\SocialEvents@socialCreated',
        ],
        'social.updated' => [
            'Modules\Socials\Events\SocialEvents@socialUpdated',
        ],
        'social.saved' => [
            'Modules\Socials\Events\SocialEvents@socialSaved',
        ],
        'social.deleted' => [
            'Modules\Socials\Events\SocialEvents@socialDeleted',
        ],
        'social.restored' => [
            'Modules\Socials\Events\SocialEvents@socialRestored',
        ],

        // Social Translation Events
        'social_translation.created' => [
            'Modules\Socials\Events\SocialTranslationEvents@socialTranslationCreated',
        ],
        'social_translation.updated' => [
            'Modules\Socials\Events\SocialTranslationEvents@socialTranslationUpdated',
        ],
        'social_translation.saved' => [
            'Modules\Socials\Events\SocialTranslationEvents@socialTranslationSaved',
        ],
        'social_translation.deleted' => [
            'Modules\Socials\Events\SocialTranslationEvents@socialTranslationDeleted',
        ],
        'social_translation.restored' => [
            'Modules\Socials\Events\SocialTranslationEvents@socialTranslationRestored',
        ],
    ];
}