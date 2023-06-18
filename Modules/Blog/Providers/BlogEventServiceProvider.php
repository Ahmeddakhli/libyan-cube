<?php

namespace Modules\Blog\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class BlogEventServiceProvider extends ServiceProvider
{
    protected $listen = [
        // Blog Events
        'blog.created' => [
            'Modules\Blog\Events\BlogEvents@blogCreated',
        ],
        'blog.updated' => [
            'Modules\Blog\Events\BlogEvents@blogUpdated',
        ],
        'blog.saved' => [
            'Modules\Blog\Events\BlogEvents@blogSaved',
        ],
        'blog.deleted' => [
            'Modules\Blog\Events\BlogEvents@blogDeleted',
        ],
        'blog.restored' => [
            'Modules\Blog\Events\BlogEvents@blogRestored',
        ],

        // Blog Translation Events
        'blog_translation.created' => [
            'Modules\Blog\Events\BlogTranslationEvents@blogTranslationCreated',
        ],
        'blog_translation.updated' => [
            'Modules\Blog\Events\BlogTranslationEvents@blogTranslationUpdated',
        ],
        'blog_translation.saved' => [
            'Modules\Blog\Events\BlogTranslationEvents@blogTranslationSaved',
        ],
        'blog_translation.deleted' => [
            'Modules\Blog\Events\BlogTranslationEvents@blogTranslationDeleted',
        ],
        'blog_translation.restored' => [
            'Modules\Blog\Events\BlogTranslationEvents@blogTranslationRestored',
        ],

        // Blog Events
        'blog_category.created' => [
            'Modules\Blog\Events\BlogCategoryEvents@blogCategoryCreated',
        ],
        'blog_category.updated' => [
            'Modules\Blog\Events\BlogCategoryEvents@blogCategoryUpdated',
        ],
        'blog_category.saved' => [
            'Modules\Blog\Events\BlogCategoryEvents@blogCategorySaved',
        ],
        'blog_category.deleted' => [
            'Modules\Blog\Events\BlogCategoryEvents@blogCategoryDeleted',
        ],
        'blog_category.restored' => [
            'Modules\Blog\Events\BlogCategoryEvents@blogCategoryRestored',
        ],

        // Blog Translation Events
        'blog_category_translation.created' => [
            'Modules\Blog\Events\BlogCategoryTranslationEvents@blogCategoryTranslationCreated',
        ],
        'blog_category_translation.updated' => [
            'Modules\Blog\Events\BlogCategoryTranslationEvents@blogCategoryTranslationUpdated',
        ],
        'blog_category_translation.saved' => [
            'Modules\Blog\Events\BlogCategoryTranslationEvents@blogCategoryTranslationSaved',
        ],
        'blog_category_translation.deleted' => [
            'Modules\Blog\Events\BlogCategoryTranslationEvents@blogCategoryTranslationDeleted',
        ],
        'blog_category_translation.restored' => [
            'Modules\Blog\Events\BlogCategoryTranslationEvents@blogCategoryTranslationRestored',
        ],
    ];
}
