<?php

namespace Modules\Inventory\Http\Controllers\Actions\Phases;

use Cache;
use Modules\Inventory\IPhase;
use Modules\Inventory\Http\Resources\IPhaseResource;
use App;

class GetIPhasesAction
{
    public function execute()
    {
        return Cache::rememberForever('inventory_module_phases_'.App::getLocale(), function () {
            $i_phases = IPhase::all();

            // Transform the bphases
            $i_phases = IPhaseResource::collection($i_phases);

            return $i_phases;
        });
    }
}
