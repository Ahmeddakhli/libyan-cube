<?php

namespace Modules\Currencies\Http\Controllers\Actions;

use Cache;
use Modules\Currencies\Currency;
use Modules\Currencies\Http\Resources\CurrencyResource;

class AllCurrenciesAction
{
    public function __construct()
    {
        //
    }

    public function execute()
    {
        return Cache::rememberForever('currencies_module_currencies', function() {
            $currencies = Currency::all();

            // Transform the currencies
            $currencies = CurrencyResource::collection($currencies);

            return $currencies;
        });
    }
}