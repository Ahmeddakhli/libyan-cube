<?php

namespace Modules\SEO\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class SeoEventServiceProvider extends ServiceProvider
{
    protected $listen = [
         // Seo Events
        'seo.created' => [
            'Modules\SEO\Events\SeoEvents@seoCreated',
        ],
        'seo.updated' => [
            'Modules\SEO\Events\SeoEvents@seoUpdated',
        ],
        'seo.saved' => [
            'Modules\SEO\Events\SeoEvents@seoSaved',
        ],
        'seo.deleted' => [
            'Modules\SEO\Events\SeoEvents@seoDeleted',
        ],
        'seo.restored' => [
            'Modules\SEO\Events\SeoEvents@seoRestored',
        ],

         // Seo Translation Events
        'seo_translation.created' => [
            'Modules\SEO\Events\SeoTranslationEvents@seoTranslationCreated',
        ],
        'seo_translation.updated' => [
            'Modules\SEO\Events\SeoTranslationEvents@seoTranslationUpdated',
        ],
        'seo_translation.saved' => [
            'Modules\SEO\Events\SeoTranslationEvents@seoTranslationSaved',
        ],
        'seo_translation.deleted' => [
            'Modules\SEO\Events\SeoTranslationEvents@seoTranslationDeleted',
        ],
    ];
}