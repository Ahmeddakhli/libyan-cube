<?php

namespace Modules\Services\Http\Controllers\Actions\Services;

use Cache;
use Modules\Services\Service;
use Modules\Services\Http\Resources\ServiceResource;

class GetFeaturedServicesAction
{
    public function execute()
    {
        // Get the services
        $services = Service::where('is_featured',1)->get();

        // Transform the  services
        $services = ServiceResource::collection($services);

        // Return the result
        return $services;
    }
}
