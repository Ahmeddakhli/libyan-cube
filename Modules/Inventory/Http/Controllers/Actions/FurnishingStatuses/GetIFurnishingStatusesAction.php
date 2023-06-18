<?php

namespace Modules\Inventory\Http\Controllers\Actions\FurnishingStatuses;

use Cache;
use Modules\Inventory\IFurnishingStatus;
use Modules\Inventory\Http\Resources\IFurnishingStatusResource;
use App;

class GetIFurnishingStatusesAction
{
    public function execute()
    {
        return Cache::rememberForever('inventory_module_furnishing_statuses_'.App::getLocale(), function () {
            $i_furnishing_statuses = IFurnishingStatus::with('translations')->get();

            // Transform the i_furnishing_statuses
            $i_furnishing_statuses = IFurnishingStatusResource::collection($i_furnishing_statuses);

            return $i_furnishing_statuses;
        });
    }
}
