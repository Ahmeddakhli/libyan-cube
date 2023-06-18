<?php

namespace Modules\Internationalizations\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Internationalizations\Http\Controllers\Actions\Currencies\AllCurrenciesAction;
use Modules\Internationalizations\Http\Controllers\Actions\Currencies\AllCurrencyCodesAction;
use Modules\Internationalizations\Http\Controllers\Actions\Currencies\GetCurrencyNameByCurrencyCodeAction;
use Modules\Internationalizations\Http\Requests\Currencies\GetCurrencyNameByCurrencyCodeRequest;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth;

class CurrenciesController extends Controller
{
    /**
     * Get currencies
     *
     * @return [json] ServiceResponse object
     */
    public function currencies(Request $request, AllCurrenciesAction $action)
    {
        // Get the currencies
        $currencies = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Currencies retrieved successfully';
        $resp->status = true;
        $resp->data = $currencies;
        return response()->json($resp, 200);
    }

    /**
     * Get currency codes
     *
     * @return [json] ServiceResponse object
     */
    public function currencyCodes(Request $request, AllCurrencyCodesAction $action)
    {
        // Get the currency codes
        $currency_codes = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Currency codes retrieved successfully';
        $resp->status = true;
        $resp->data = $currency_codes;
        return response()->json($resp, 200);
    }

    /**
     * Get currency name by currency code
     *
     * @param  [string] code
     * @return [json] ServiceResponse object
     */
    public function getCurrencyNameByCurrencyCode(GetCurrencyNameByCurrencyCodeRequest $request, GetCurrencyNameByCurrencyCodeAction $action)
    {
        // Get the currency name
        $currency_name = $action->execute($request->input('code'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Currency name retrieved successfully';
        $resp->status = true;
        $resp->data = $currency_name;
        return response()->json($resp, 200);
    }
}
