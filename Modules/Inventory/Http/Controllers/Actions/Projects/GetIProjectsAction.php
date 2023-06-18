<?php

namespace Modules\Inventory\Http\Controllers\Actions\Projects;

use Cache;
use Modules\Inventory\IProject;
use Modules\Inventory\Http\Resources\IProjectMinimalResource;

class GetIProjectsAction
{
    public function execute()
    {
        // Get Projects
        $i_projects = IProject::all();

        // Transform  Project
        $i_projects = IProjectMinimalResource::collection($i_projects);
        
        return $i_projects;
    }
}
