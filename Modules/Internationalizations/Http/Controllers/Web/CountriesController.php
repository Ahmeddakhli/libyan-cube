<?php

namespace Modules\Internationalizations\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Internationalizations\Http\Controllers\Actions\Countries\AllCountriesAction;
use Modules\Internationalizations\Http\Controllers\Actions\Countries\AllCountryCodesAction;
use Modules\Internationalizations\Http\Controllers\Actions\Countries\GetCountryNameByCountryCodeAction;
use Modules\Internationalizations\Http\Requests\Countries\GetCountryNameByCountryCodeRequest;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth;

class CountriesController extends Controller
{
    /**
     * Get countries
     *
     * @return [json] ServiceResponse object
     */
    public function countries(Request $request, AllCountriesAction $action)
    {
        // Get the countries
        $countries = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Countries retrieved successfully';
        $resp->status = true;
        $resp->data = $countries;
        return response()->json($resp, 200);
    }

    /**
     * Get country codes
     *
     * @return [json] ServiceResponse object
     */
    public function countryCodes(Request $request, AllCountryCodesAction $action)
    {
        // Get the country codes
        $country_codes = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Country codes retrieved successfully';
        $resp->status = true;
        $resp->data = $country_codes;
        return response()->json($resp, 200);
    }

    /**
     * Get country name by country code
     *
     * @param  [string] code
     * @return [json] ServiceResponse object
     */
    public function getCountryNameByCountryCode(GetCountryNameByCountryCodeRequest $request, GetCountryNameByCountryCodeAction $action)
    {
        // Get the country name
        $country_name = $action->execute($request->input('code'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Country name retrieved successfully';
        $resp->status = true;
        $resp->data = $country_name;
        return response()->json($resp, 200);
    }
}
