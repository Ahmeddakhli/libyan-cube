<?php

namespace Modules\Inventory\Http\Controllers\Actions\Projects;

use Modules\Inventory\IProject;
use App\User;
use Modules\Inventory\Http\Resources\IProjectResource;

class GetIProjectByIdAction
{
    public function execute($id)
    {
        // Get the i_project
        $i_project = IProject::find($id);

        if (!$i_project) {
            return null;
        }

        // Transform the i_project
        $i_project = new IProjectResource($i_project);

        return $i_project;
    }
}
