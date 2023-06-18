<?php

namespace Modules\Inventory\Http\Controllers\Actions\Developers;

use Cache;
use Modules\Inventory\IDeveloper;
use Modules\Inventory\Http\Resources\IDeveloperResource;
use App;

class GetIDevelopersAction
{
    public function execute()
    {
        return Cache::rememberForever('inventory_module_developers_' . App::getLocale(), function () {
            $i_developers = IDeveloper::with(
                'translations',
                'country',
                'region',
                'city',
                'area',
                'projects',
                'projects.units'
            )->get();

            // Transform the i_developers
            $i_developers = IDeveloperResource::collection($i_developers);

            return $i_developers;
        });
    }
}
