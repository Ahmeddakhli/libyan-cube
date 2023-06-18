<?php

namespace Modules\Dashboard\Http\Controllers\Actions;

use Modules\Inventory\IProject;

class GetProjectsCountAction
{
    public function execute()
    {
        // Get Count Projects
        $projects = IProject::count();

        return $projects;
    }
}
