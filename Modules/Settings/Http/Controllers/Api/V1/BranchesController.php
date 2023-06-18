<?php

namespace Modules\Settings\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Settings\Http\Controllers\Actions\Branches\CreateBranchAction;
use Modules\Settings\Http\Controllers\Actions\Branches\DeleteBranchAction;
use Modules\Settings\Http\Controllers\Actions\Branches\GetBranchesAction;
use Modules\Settings\Http\Controllers\Actions\Branches\UpdateBranchAction;
use Modules\Settings\Http\Requests\Branches\CreateBranchRequest;
use Modules\Settings\Http\Requests\Branches\DeleteBranchRequest;
use Modules\Settings\Http\Requests\Branches\UpdateBranchRequest;
use App\Http\Helpers\ServiceResponse;

class BranchesController extends Controller
{
    /**
     * Store branch
     *
     * @param  [string] branch
     * @param  [string] latitude
     * @param  [string] longitude 
     * @return [json] ServiceResponse object
     */
    public function store(CreateBranchRequest $request, CreateBranchAction $action)
    {
        // Create the branch
        $branch = $action->execute($request->all());

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Branch created successfully';
        $resp->status = true;
        $resp->data = $branch;
        return response()->json($resp, 200);
    }

    /**
     * Update branch
     *
     * @param  [integer] id
     * @param  [string] branch
     * @param  [string] latitude
     * @param  [string] longitude 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateBranchRequest $request, UpdateBranchAction $action)
    {
        // Update the branch
        $branch = $action->execute($request->input('id'), $request->except('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Branch updated successfully';
        $resp->status = true;
        $resp->data = $branch;
        return response()->json($resp, 200);
    }

    /**
     * Delete branch
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteBranchRequest $request, DeleteBranchAction $action)
    {
        // Delete the branch
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Branch deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index branches
     * @return Response
     */
    public function index(Request $request, GetBranchesAction $action)
    {
        // Delete branches
        $branches =  $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Branches retrieved successfully';
        $resp->status = true;
        $resp->data = $branches;
        return response()->json($resp, 200);
    }
}
