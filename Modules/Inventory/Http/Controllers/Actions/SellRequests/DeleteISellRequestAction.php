<?php

namespace Modules\Inventory\Http\Controllers\Actions\SellRequests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Modules\Inventory\ISellRequest;

class DeleteISellRequestAction
{
    public function execute($id)
    {
        // Find sell request 
        $i_sell_request = ISellRequest::find($id);

        // Delete sell request
        $i_sell_request->delete();

        // Return response
        return null;
    }
}
