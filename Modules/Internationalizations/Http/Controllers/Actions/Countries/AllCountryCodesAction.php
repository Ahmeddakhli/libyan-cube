<?php

namespace Modules\Internationalizations\Http\Controllers\Actions\Countries;

use Cache;
use Propaganistas\LaravelIntl\Facades\Country;
use stdClass;

class AllCountryCodesAction
{
    public function __construct()
    {
        //
    }

    public function execute()
    {
        return Cache::rememberForever('internationalizations_module_country_codes', function() {
            $countries = Country::all();
            $country_codes_list = array_keys($countries);

            return $country_codes_list;
        });
    }
}