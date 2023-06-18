<?php

namespace Modules\Currencies\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Currencies\Http\Controllers\Actions\AllCurrenciesAction;
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
    public function all(Request $request, AllCurrenciesAction $action)
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
}
