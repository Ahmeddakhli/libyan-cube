<?php

namespace Modules\KeyWords\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class KeyWordsEventsServiceProvider extends ServiceProvider
{
    protected $listen = [
        // Event KeyWords
        'key_word.created' => [
            'Modules\KeyWords\Events\KeyWordEvents@keyWordCreated',
        ],
        'key_word.updated' => [
            'Modules\KeyWords\Events\KeyWordEvents@keyWordUpdated',
        ],
        'key_word.saved' => [
            'Modules\KeyWords\Events\KeyWordEvents@keyWordSaved',
        ],
        'key_word.deleted' => [
            'Modules\KeyWords\Events\KeyWordEvents@keyWordDeleted',
        ],
        'key_word.restored' => [
            'Modules\KeyWords\Events\KeyWordEvents@keyWordRestored',
        ],

        // Event Translation Events
        'key_word_translation.created' => [
            'Modules\KeyWords\Events\KeyWordTranslationEvents@keyWordTranslationCreated',
        ],
        'key_word_translation.updated' => [
            'Modules\KeyWords\Events\KeyWordTranslationEvents@keyWordTranslationUpdated',
        ],
        'key_word_translation.saved' => [
            'Modules\KeyWords\Events\KeyWordTranslationEvents@keyWordTranslationSaved',
        ],
        'key_word_translation.deleted' => [
            'Modules\KeyWords\Events\KeyWordTranslationEvents@keyWordTranslationDeleted',
        ],
    ];
}
