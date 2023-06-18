<?php

namespace Modules\Internationalizations\Http\Controllers\Actions\Currencies;

use Cache;
use Propaganistas\LaravelIntl\Facades\Currency;
use stdClass;

class AllCurrenciesAction
{
    public function __construct()
    {
        //
    }

    public function execute()
    {
        return Cache::rememberForever('internationalizations_module_currencies', function() {
            $currencies = Currency::all();
            $currencies_collection = collect();

            foreach ($currencies as $code => $currency) {
                $obj = new stdClass();
                $obj->code = $code;
                $obj->currency = $currency;

                $currencies_collection->push($obj);
            }

            return $currencies_collection;
        });
    }
}