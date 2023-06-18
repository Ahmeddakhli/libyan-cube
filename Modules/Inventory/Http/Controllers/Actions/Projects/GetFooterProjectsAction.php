<?php

namespace Modules\Inventory\Http\Controllers\Actions\Projects;

use Cache;
use Modules\Inventory\Http\Resources\IProjectMinimalResource;
use Modules\Inventory\IProject;

class GetFooterProjectsAction
{
    public function execute()
    {
        // Get Projects
        $i_projects = IProject::select('id','price_from','price_to','currency_code')->orderBy('id', 'DESC')->take(5)->get();
        $i_projects = IProjectMinimalResource::collection($i_projects);

        return $i_projects;
    }
}
