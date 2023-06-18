<?php

namespace App\Http\Controllers\Web\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Compares\Http\Controllers\Actions\GetComparesAction;
use Modules\Inventory\Http\Controllers\Actions\Projects\GetIProjectByIdAction;
use Modules\Inventory\Http\Controllers\Actions\Projects\GetIProjectByPublishUuidAction;
use Modules\Inventory\Http\Controllers\Actions\Projects\GetProjectUnitsPurposeTypesAction;
use Modules\Inventory\Http\Resources\IProjectResource;
use Modules\Inventory\IProject;

class ProjectsController extends Controller
{
    public function features()
    {
        $action = new GetComparesAction;
        $compares = json_decode(json_encode($action->execute()));

        return [
            'compares' => $compares,
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, GetIProjectByIdAction $action)
    {
        switch ($id) {
            case 324:
                $id = 325;
                break;
            case 232:
                $id = 233;
                break;
            default:
                # code...
                break;
        }
        $project = json_decode(json_encode($action->execute($id)));

        // Get Unit Types
        $action = new GetProjectUnitsPurposeTypesAction();
        $project_units_purpose_types = $action->execute($project->id);

        // Get related project
        if ($project->city) {
            $relates = json_decode(json_encode(IProjectResource::collection(IProject::where('id', '!=', $project->id)->where('city_id', $project->city->id)->orderBy('created_at', 'DESC')->take(4)->get())));
        } else {
            $relates = [];
        }
        $features = $this->features();
        $features['single_project'] = $project;
        $features['project_units_purpose_types'] = $project_units_purpose_types;
        $features['relates'] = $relates;

        return view('front.pages.single-project', $features);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function publish($id, GetIProjectByPublishUuidAction $action)
    {
        $project = json_decode(json_encode($action->execute($id)));
        $features = $this->features();
        $features['single_project'] = $project;

        return view('front.pages.landing_page', compact('project'));
    }
}
