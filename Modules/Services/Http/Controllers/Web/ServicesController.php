<?php

namespace Modules\Services\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Services\Http\Controllers\Actions\Services\SearchServicesQueryAction;
use Modules\Services\Http\Controllers\Actions\Services\CreateServiceAction;
use Modules\Services\Http\Controllers\Actions\Services\DeleteServiceAction;
use Modules\Services\Http\Controllers\Actions\Services\UpdateServiceAction;
use Modules\Services\Http\Requests\Services\CreateServiceRequest;
use Modules\Services\Http\Requests\Services\DeleteServiceRequest;
use Modules\Services\Http\Requests\Services\UpdateServiceRequest;
use Modules\Services\Http\Resources\ServiceResource;
use Modules\Services\Service;
use App\Http\Helpers\ServiceResponse;
use App\Http\Resources\MediaResource;
use Carbon\Carbon;
use Auth, Lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Yajra\Datatables\Datatables;
use App\Language;
use Modules\Services\ServiceCategory;

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
        $resp->message = 'service created successfully';
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
        $resp->message = 'service updated successfully';
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
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the services
            $action = new SearchServicesQueryAction;
            $services = $action->execute($auth_user, $request);
            return Datatables::of($services)
                ->addColumn('value', function ($service) {
                    return $service->value;
                })
                ->filterColumn('value', function ($query, $keyword) {
                    $query->whereHas('translations', function ($translation) use ($keyword) {
                        $translation->where('title', 'like', '%' . $keyword . '%');
                    });
                })
                ->addColumn('created_at', function ($service) {
                    return $service->created_at ? $service->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function ($service) {
                    return $service->updated_at ? $service->updated_at->toDateTimeString() : null;
                })
                ->orderColumn('created_at', function ($query, $order) {
                    return  $query->orderBy('created_at', $order);
                })
                ->orderColumn('last_updated_at', function ($query, $order) {
                    return  $query->orderBy('updated_at', $order);
                })
                ->make(true);
        } else {
            $blade_name = ($request->ajax() ? 'index-partial' : 'index'); // Handle Partial Return
            return view('services::services.' . $blade_name);
        }
    }

    /**
     * Create services
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('services::services.' . $blade_name, compact('languages'), []);
    }

    public function createServiceModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        return view('services::services.modals.create', compact('languages'), [])->render();
    }

    public function UpdateServiceModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $service = Service::find($id);
        $attachments = json_decode(json_encode(MediaResource::collection($service->getMedia(request()->getHttpHost() . ',services,' . $service->id . ',' . 'attachments'))));

        // If service does not exist, return error div
        if (!$service) {
            $error = Lang::get('services::services.service_not_found_or_you_are_not_authorized_to_edit_the_service');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the languages
        $languages = Language::all();

        return view('services::services.modals.update', compact('service', 'languages', 'attachments'), [])->render();
    }
}
