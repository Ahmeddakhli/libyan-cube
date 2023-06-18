<?php

namespace Modules\Inventory\Http\Controllers\Actions\Developers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Inventory\Http\Controllers\Actions\Projects\GetFrontIProjectsAction;
use Modules\Inventory\Http\Resources\IDeveloperResource;
use Modules\Inventory\Http\Resources\IProjectResource;
use Modules\Inventory\IDeveloper;
use Modules\Inventory\IProject;

class GetIDeveloperByIdAction
{
    public function execute(Request $request,$id)
    {
        // Find  i_developer 
        $data=$request->all();
        $i_developer = IDeveloper::find($id);

        if ($i_developer) {        
            // Transform developer
            $data['developer'] = new IDeveloperResource($i_developer);

            // Get developers projects 
            $projects_ids = $i_developer->projects()->pluck('id');
            if (!empty($projects_ids)) {
                $data['i_developer_id'] = $id;
                $i_projects = (new GetFrontIProjectsAction)->execute($data);

                $data['projects'] = $i_projects;
            } else {
                $data['projects'] = null;
            }
        } else {
            $data = null;
        }

        return $data;
    }
}
