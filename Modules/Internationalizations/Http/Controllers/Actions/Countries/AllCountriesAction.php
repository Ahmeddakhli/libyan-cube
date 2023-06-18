<?php

namespace Modules\Internationalizations\Http\Controllers\Actions\Countries;

use Cache;
use Propaganistas\LaravelIntl\Facades\Country;
use stdClass;

class AllCountriesAction
{
    public function __construct()
    {
        //
    }

    public function execute()
    {
        return Cache::rememberForever('internationalizations_module_countries', function() {
            $countries = Country::all();
            $countries_collection = collect();

            foreach ($countries as $code => $country) {
                $obj = new stdClass();
                $obj->code = $code;
                $obj->country = $country;

                $countries_collection->push($obj);
            }

            return $countries_collection;
        });
    }
}