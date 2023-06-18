<?php

namespace Modules\CMS\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\CMS\Http\Controllers\Actions\CreateCmsManagementAction;
use Modules\CMS\Http\Controllers\Actions\DeleteCmsManagementAction;
use Modules\CMS\Http\Controllers\Actions\GetCmsManagementAction;
use Modules\CMS\Http\Controllers\Actions\UpdateCmsManagementAction;
use Modules\CMS\Http\Requests\CreateCmsManagementRequest;
use Modules\CMS\Http\Requests\DeleteCmsManagementRequest;
use Modules\CMS\Http\Requests\UpdateCmsManagementRequest;
use App\Http\Helpers\ServiceResponse;

class CmsManagementsController extends Controller
{
    /**
     * Store Cms management
     *
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateCmsManagementRequest $request, CreateCmsManagementAction $action)
    {
        // Create the Cms management
        $cms_management = $action->execute($request->except([]), $request->translations);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Cms management created successfully';
        $resp->status = true;
        $resp->data = $cms_management;
        return response()->json($resp, 200);
    }

    /**
     * Update Cms management
     *
     * @param  [integer] id
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateCmsManagementRequest $request, UpdateCmsManagementAction $action)
    {
        // Update the Cms management
        $cms_management = $action->execute($request->input('id'), $request->except(['id']), $request->translations);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Cms management updated successfully';
        $resp->status = true;
        $resp->data = $cms_management;
        return response()->json($resp, 200);
    }

    /**
     * Delete Cms management
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteCmsManagementRequest $request, DeleteCmsManagementAction $action)
    {
        // Delete the Cms management
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Cms management deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index Cms managements
     * @return Response
     */
    public function index(Request $request, GetCmsManagementAction $action)
    {
        $cms_management_sections = json_decode(json_encode($action->execute($request->type)));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Cms managements retrieved successfully';
        $resp->status = true;
        $resp->data = $cms_management_sections;
        return response()->json($resp, 200);
    }
}
