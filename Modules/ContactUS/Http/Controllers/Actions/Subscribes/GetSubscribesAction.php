<?php

namespace Modules\ContactUS\Http\Controllers\Actions\Subscribes;

use Cache;
use Modules\ContactUS\Subscribe;
use Modules\ContactUS\Http\Resources\SubscribeResource;

class GetSubscribesAction
{
    public function execute()
    {
        // Get subscribes list 
        $subscribes = Subscribe::all();

        // Transform the subscribes list 
        $subscribes = SubscribeResource::collection($subscribes);

        // Return the response 
        return $subscribes;
    }
}
