<?php

namespace Modules\Inventory\Http\Controllers\Actions\Projects;

use Cache;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Inventory\Http\Controllers\Actions\Search\ProjectSearchAction;
use Modules\Inventory\IProject;
use Modules\Inventory\Http\Resources\IProjectMinimalResource;
use Modules\Inventory\Http\Resources\IProjectResource;

class GetFrontIProjectsAction
{
    public function execute($data)
    {
        // Get Projects
        $action = new ProjectSearchAction;
        $i_projects = $action->execute($data)->paginate(8);
        // Transform  Project
        $i_projects = IProjectResource::collection($i_projects);

        $i_projects = new LengthAwarePaginator(
            json_decode(json_encode($i_projects)),
            $i_projects->total(),
            $i_projects->perPage(),
            $i_projects->currentPage(),
            [
                'path' => \Request::url(),
                'query' => [
                    'page' => $i_projects->currentPage()
                ]
            ]
        );

        return $i_projects;
    }
}
