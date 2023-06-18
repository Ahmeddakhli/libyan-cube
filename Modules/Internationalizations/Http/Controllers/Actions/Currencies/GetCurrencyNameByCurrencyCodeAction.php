<?php

namespace Modules\Internationalizations\Http\Controllers\Actions\Currencies;

use Propaganistas\LaravelIntl\Facades\Currency;

class GetCurrencyNameByCurrencyCodeAction
{
    public function __construct()
    {
        //
    }

    public function execute($currency_code)
    {
        return Currency::name($currency_code);
    }
}