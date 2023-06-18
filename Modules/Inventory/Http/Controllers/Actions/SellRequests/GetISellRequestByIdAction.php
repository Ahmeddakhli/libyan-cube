<?php

namespace Modules\Inventory\Http\Controllers\Actions\SellRequests;

use Modules\Inventory\Http\Resources\ISellRequestResource;
use Modules\Inventory\ISellRequest;

class GetISellRequestByIdAction
{
    public function execute($id)
    {
        // Get sell request 
        $i_sell_request = ISellRequest::find($id);

        // Transform sell requests
        $i_sell_request = $i_sell_request ? new ISellRequestResource($i_sell_request) : null;

        // Return response
        return $i_sell_request;
    }
}
