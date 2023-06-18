<?php

namespace Modules\Inventory\Http\Controllers\Actions\Search;

use Illuminate\Http\Request;
use Modules\Inventory\IProject;
use Modules\Inventory\IUnit;
use Carbon\Carbon;
use Modules\Inventory\Http\Controllers\Actions\Projects\GetFrontIProjectsAction;
use Modules\Inventory\Http\Controllers\Actions\Units\GetFrontIUnitsAction;
use Modules\Locations\Http\Resources\LocationResource;
use Modules\Locations\Location;

class LocationSearchAction
{
    public function execute($data, $id, $type = null)
    {
        $location = Location::where('id',$id)->withCount(['units','projects'])->first();
        if ($location) {
            switch ($type) {
                case 'project':
                    $data['city_id'] = [$id];
                    $results = (new GetFrontIProjectsAction)->execute($data);
                    break;
                case 'unit':
                    $data['city_id'] = [$id];
                    $results = (new GetFrontIUnitsAction)->execute($data);
                    break;
                default:
                    $data['city_id'] = [$id];
                    $results = (new GetFrontIProjectsAction)->execute($data);
                    break;
            }
        }

        return [
            'location' => new LocationResource($location),
            'results' => $results
        ];
    }
}
