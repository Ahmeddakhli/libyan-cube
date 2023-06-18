<?php

namespace Modules\Inventory\Http\Controllers\Actions\Purposes;

use Cache;
use Modules\Inventory\IPurpose;
use Modules\Inventory\Http\Resources\IPurposeResource;
use App;

class GetIPurposesAction
{
    public function execute()
    {
        return Cache::rememberForever('inventory_module_purposes_'.App::getLocale(), function () {
            $i_purposes = IPurpose::with('translations')->get();

            // Transform the i_purposes
            $i_purposes = IPurposeResource::collection($i_purposes);

            return $i_purposes;
        });
    }
}
