<?php

namespace Modules\Services\Http\Controllers\Actions\Services;

use Cache;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Services\Service;
use Modules\Services\Http\Resources\ServiceResource;

class GetServicesFrontAction
{
    public function __construct()
    {
        //
    }
    public function execute()
    {
        // Get Services
        $services =  Service::all();

        // Transform result
        $services = json_decode(json_encode(ServiceResource::collection($services)));

        // Return the result
        return $services;
    }
}
