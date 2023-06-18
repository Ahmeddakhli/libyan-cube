<?php

namespace Modules\ContactUS\Http\Controllers\Actions\Subscribes;

use Modules\ContactUS\Subscribe;
use Modules\ContactUS\Http\Resources\SubscribeResource;

class UpdateSubscribeAction
{
    public function execute($id, array $data): SubscribeResource
    {
        // Find subscribe 
        $subscribe = Subscribe::find($id);

        // Trigger update subscribe on subscribe to cache its values
        // Update subscribe
        $subscribe->update($data);

        // Transform the result
        $subscribe = new SubscribeResource($subscribe);

        // Return the response 
        return $subscribe;
    }
}
