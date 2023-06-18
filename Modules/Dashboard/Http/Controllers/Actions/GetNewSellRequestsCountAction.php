<?php

namespace Modules\Dashboard\Http\Controllers\Actions;

use Modules\Inventory\ISellRequest;

class GetNewSellRequestsCountAction
{
    public function execute()
    {
        // Get Count Sell Requests
        $sell_requests = ISellRequest::where('is_seen', 0)->count();

        return $sell_requests;
    }
}
