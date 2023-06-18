<?php

namespace Modules\Careers\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class CareersEventServiceProvider extends ServiceProvider
{
    protected $listen = [
         // Career Events
        'career.created' => [
            'Modules\Careers\Events\CareerEvents@careerCreated',
        ],
        'career.updated' => [
            'Modules\Careers\Events\CareerEvents@careerUpdated',
        ],
        'career.saved' => [
            'Modules\Careers\Events\CareerEvents@careerSaved',
        ],
        'career.deleted' => [
            'Modules\Careers\Events\CareerEvents@careerDeleted',
        ],
        'career.restored' => [
            'Modules\Careers\Events\CareerEvents@careerRestored',
        ],

         // Career Translation Events
        'career_translation.created' => [
            'Modules\Careers\Events\CareerTranslationEvents@careerTranslationCreated',
        ],
        'career_translation.updated' => [
            'Modules\Careers\Events\CareerTranslationEvents@careerTranslationUpdated',
        ],
        'career_translation.saved' => [
            'Modules\Careers\Events\CareerTranslationEvents@careerTranslationSaved',
        ],
        'career_translation.deleted' => [
            'Modules\Careers\Events\CareerTranslationEvents@careerTranslationDeleted',
        ],
    ];
}