<?php

namespace Modules\Services\Http\Controllers\Actions\Services;

use Modules\Services\Service;
use Modules\Services\Http\Resources\ServiceResource;

class GetServiceByIdAction
{
    public function execute($id)
    {
        $service = Service::find($id);

        return new ServiceResource($service);
    }
}
