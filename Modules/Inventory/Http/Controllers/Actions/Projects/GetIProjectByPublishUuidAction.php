<?php

namespace Modules\Inventory\Http\Controllers\Actions\Projects;

use Modules\Inventory\IProject;
use App\User;
use Modules\Inventory\Http\Resources\IProjectLandingResource;
use Modules\Inventory\Http\Resources\IProjectResource;

class GetIProjectByPublishUuidAction
{
    public function execute($id)
    {
        // Get the i_project
        $i_project = IProject::where('slug', $id)->first();

        if (!$i_project) {
            return null;
        }

        // Transform the i_project
        $i_project = new IProjectLandingResource($i_project);

        return $i_project;
    }
}
