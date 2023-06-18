<?php

namespace Modules\Internationalizations\Http\Controllers\Actions\Countries;

use Propaganistas\LaravelIntl\Facades\Country;

class GetCountryNameByCountryCodeAction
{
    public function __construct()
    {
        //
    }

    public function execute($country_code)
    {
        return Country::name($country_code);
    }
}