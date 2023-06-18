<?php

namespace Modules\Compares\Http\Controllers\Api\V1;

use App\Http\Helpers\ServiceResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Compares\Http\Controllers\Actions\CreateCompareAction;
use Modules\Compares\Http\Controllers\Actions\UpdateCompareAction;
use Modules\Compares\Http\Controllers\Actions\GetComparesAction;
use Modules\Compares\Http\Controllers\Actions\DeleteCompareAction;
use Modules\Compares\Http\Requests\CreateCompareRequest;
use Modules\Compares\Http\Requests\UpdateCompareRequest;
use Modules\Compares\Http\Requests\GetComparesRequest;
use Modules\Compares\Http\Requests\DeleteCompareRequest;

class ComparesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(GetComparesRequest $request, GetComparesAction $action)
    {
        // Get compares
        $compares = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Compare retrieved successfully';
        $resp->status = true;
        $resp->data = $compares;
        return response()->json($resp, 200);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(CreateCompareRequest $request, CreateCompareAction $action)
    {
        // Create compare
        $compare = $action->execute($request->all());

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Compare Created successfully';
        $resp->status = true;
        $resp->data = $compare;
        return response()->json($resp, 200);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(UpdateCompareRequest $request, UpdateCompareAction $action)
    {
        // Update compare
        $compare = $action->execute($request->id, $request->except('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Compare updated successfully';
        $resp->status = true;
        $resp->data = $compare;
        return response()->json($resp, 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function delete(DeleteCompareRequest $request, DeleteCompareAction $action)
    {
        // Delete compare
        $compare = $action->execute($request->id);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Compare deleted successfully';
        $resp->status = true;
        $resp->data = $compare;
        return response()->json($resp, 200);
    }
}
