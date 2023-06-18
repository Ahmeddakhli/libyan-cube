<?php

namespace Modules\Inventory\Http\Controllers\Actions\Units;

use Cache;
use Modules\Inventory\Http\Resources\IProjectResource;
use Modules\Inventory\IUnit;
use Modules\Inventory\Http\Resources\IUnitMinimalResource;
use Modules\Inventory\Http\Resources\IUnitResource;
use Modules\Inventory\IDeveloper;
use Modules\Inventory\IProject;
use Modules\Locations\Location;

class GetIUnitsGroupedByCityAction
{
    public function execute()
    {
        $areas = Location::discoverBy()->select('id')->withCount('projects')->get();
        $developers = IDeveloper::discoverBy()->select()->withCount('projects')->get();
        $projects = IProject::discoverBy()->select('id','slug')->withCount('units')->get();
        $areas_projects_count=IProject::count();
        return [
            'areas' =>$areas ,
            'developers' => $developers,
            'projects' => $projects,
            'areas_projects_count' =>$areas_projects_count
        ];
    }
}
