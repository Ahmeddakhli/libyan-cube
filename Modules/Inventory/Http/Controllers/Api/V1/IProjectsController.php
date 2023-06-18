<?php

namespace Modules\Inventory\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Http\Controllers\Actions\Projects\CreateIProjectAction;
use Modules\Inventory\Http\Controllers\Actions\Projects\DeleteIProjectAction;
use Modules\Inventory\Http\Controllers\Actions\Projects\GetIProjectsAction;
use Modules\Inventory\Http\Controllers\Actions\Projects\UpdateIProjectAction;
use Modules\Inventory\Http\Requests\Projects\CreateIProjectRequest;
use Modules\Inventory\Http\Requests\Projects\DeleteIProjectRequest;
use Modules\Inventory\Http\Requests\Projects\GetIProjectsRequest;
use Modules\Inventory\Http\Requests\Projects\UpdateIProjectRequest;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth;

class IProjectsController extends Controller
{
    /**
     * Store i_project
     *
     * @param  [integer] developer_id
     * @param  [timestamp] delivery_date
     * @param  [integer] finished_status
     * @param  [integer] country_id
     * @param  [integer] region_id
     * @param  [integer] city_id
     * @param  [integer] area_id
     * @param  [string] latitude
     * @param  [string] longitude
     * @param  [string] address
     * @param  [integer] area_from
     * @param  [integer] area_to
     * @param  [integer] price_from
     * @param  [integer] price_to
     * @param  [string] currency_code
     * @param  [integer] i_area_unit_id
     * @param  [integer] down_payment_from
     * @param  [integer] down_payment_to
     * @param  [integer] number_of_installments_from
     * @param  [integer] number_of_installments_to
     * @param  [integer] is_featured
     * @param  [array] facilities
     * @param  [array] amenities
     * @param  [array] tags
     * @param  [array] attachments 
     * @param  [array] floorplans 
     * @param  [array] masterplans
     * @param  [array] phases 
     * @param  [array] translations
     * @return [json] ServiceResponse object
     */
    public function store(CreateIProjectRequest $request, CreateIProjectAction $action)
    {
        // Create the i_project
        $i_project = $action->execute($request->except(['facilities', 'amenities', 'phases']), $request->input('facilities'), $request->input('amenities'), $request->tags, $request->attachments, $request->floorplans, $request->masterplans, $request->phases);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Project created successfully';
        $resp->status = true;
        $resp->data = $i_project;
        return response()->json($resp, 200);
    }

    /**
     * Update i_project
     *
     * @param  [integer] id
     * @param  [integer] developer_id
     * @param  [timestamp] delivery_date
     * @param  [integer] finished_status
     * @param  [integer] country_id
     * @param  [integer] region_id
     * @param  [integer] city_id
     * @param  [integer] area_id
     * @param  [string] latitude
     * @param  [string] longitude
     * @param  [string] address
     * @param  [integer] area_from
     * @param  [integer] area_to
     * @param  [integer] price_from
     * @param  [integer] price_to
     * @param  [string] currency_code
     * @param  [integer] i_area_unit_id
     * @param  [integer] down_payment_from
     * @param  [integer] down_payment_to
     * @param  [integer] number_of_installments_from
     * @param  [integer] number_of_installments_to
     * @param  [integer] is_featured
     * @param  [array] facilities
     * @param  [array] amenities
     * @param  [array] tags
     * @param  [array] attachments 
     * @param  [array] floorplans 
     * @param  [array] masterplans
     * @param  [array] phases 
     * @param  [array] translations
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIProjectRequest $request, UpdateIProjectAction $action)
    {
        // Update the i_project
        $i_project = $action->execute($request->input('id'), $request->except(['facilities', 'amenities', 'phases', 'id']), $request->input('facilities'), $request->input('amenities'), $request->tags, $request->attachments, $request->floorplans, $request->masterplans, $request->phases);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Project updated successfully';
        $resp->status = true;
        $resp->data = $i_project;
        return response()->json($resp, 200);
    }

    /**
     * Get i_projects
     *
     * @return [json] ServiceResponse object
     */
    public function GetIProjects(GetIProjectsRequest $request, GetIProjectsAction $action)
    {
        // Get the i_projects
        $i_projects = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Projects retrieved successfully';
        $resp->status = true;
        $resp->data = $i_projects;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_project
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIProjectRequest $request, DeleteIProjectAction $action)
    {
        // Delete the i_project
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Project deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }
}
