<?php

namespace Modules\Services\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Services\Http\Controllers\Actions\Services\CreateServiceAction;
use Modules\Services\Http\Controllers\Actions\Services\DeleteServiceAction;
use Modules\Services\Http\Controllers\Actions\Services\GetServicesAction;
use Modules\Services\Http\Controllers\Actions\Services\UpdateServiceAction;
use Modules\Services\Http\Requests\Services\CreateServiceRequest;
use Modules\Services\Http\Requests\Services\DeleteServiceRequest;
use Modules\Services\Http\Requests\Services\GetServicesRequest;
use Modules\Services\Http\Requests\Services\UpdateServiceRequest;
use Modules\Services\Http\Resources\ServiceResource;
use Modules\Services\Service;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth, Lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Language;

class ServicesController extends Controller
{
    /**
     * Store service
     *
     * @param  [string] is_featured
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateServiceRequest $request, CreateServiceAction $action)
    {
        // Create the service
        $service = $action->execute($request->except(['attachments']), $request->attachments);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Service created successfully';
        $resp->status = true;
        $resp->data = $service;
        return response()->json($resp, 200);
    }
    /**
     * Update service
     *
     * @param  [integer] id
     * @param  [string] is_featured
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateServiceRequest $request, UpdateServiceAction $action)
    {
        // Update the service
        $service = $action->execute($request->input('id'), $request->except(['id', 'attachments']), $request->attachments);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Service updated successfully';
        $resp->status = true;
        $resp->data = $service;
        return response()->json($resp, 200);
    }
    /**
     * Delete service
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteServiceRequest $request, DeleteServiceAction $action)
    {
        // Delete the service
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Service deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index services
     * @return Response
     */
    public function index(Request $request, GetServicesAction $action)
    {
        // Get the services
        $services = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Services retrieved successfully';
        $resp->status = true;
        $resp->data = $services;
        return response()->json($resp, 200);
    }
}
