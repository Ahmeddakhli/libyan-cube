<?php

namespace Modules\Inventory\Http\Controllers\Actions\SellRequests;

use Modules\Inventory\Http\Resources\ISellRequestResource;
use Modules\Inventory\ISellRequest;

class GetISellRequestsAction
{
    public function execute()
    {
        // Get sell request 
        $i_sell_request = ISellRequest::all();

        // Transform sell requests
        $i_sell_request = ISellRequestResource::collection($i_sell_request);

        // Return response
        return $i_sell_request;
    }
}
