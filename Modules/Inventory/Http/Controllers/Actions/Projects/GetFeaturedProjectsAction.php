<?php

namespace Modules\Inventory\Http\Controllers\Actions\Projects;

use Cache;
use Modules\Inventory\IProject;
use Modules\Inventory\Http\Resources\IProjectHomeResource;

class GetFeaturedProjectsAction
{
    public function execute()
    {
        // Get Projects
        $i_projects = IProject::featured()->orderBy('price_from', 'ASC')->with('city','country','translations','developer','region','area','unitTypes','areaUnit','facilities','amenities','tags','attachments')->get();

        // Transform  Project
        $i_projects = IProjectHomeResource::collection($i_projects);

        return $i_projects;
    }
}
