<?php

namespace Modules\Services\Http\Controllers\Actions\Services;

use Cache;
use Modules\Services\Service;
use Modules\Services\Http\Resources\ServiceResource;

class GetServicesAction
{
    public function execute()
    {
        // Get the services
        $services = Service::all();

        // Transform the  services
        $services = serviceResource::collection($services);

        // Return the result
        return $services;
    }
}
