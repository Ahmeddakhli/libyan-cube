<?php

namespace Modules\Currencies\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class CurrenciesEventServiceProvider extends ServiceProvider
{
    protected $listen = [
         // Currency Events
        'currency.created' => [
            'Modules\Currencies\Events\CurrencyEvents@currencyCreated',
        ],
        'currency.updated' => [
            'Modules\Currencies\Events\CurrencyEvents@currencyUpdated',
        ],
        'currency.saved' => [
            'Modules\Currencies\Events\CurrencyEvents@currencySaved',
        ],
        'currency.deleted' => [
            'Modules\Currencies\Events\CurrencyEvents@currencyDeleted',
        ],
        'currency.restored' => [
            'Modules\Currencies\Events\CurrencyEvents@currencyRestored',
        ],
    ];
}