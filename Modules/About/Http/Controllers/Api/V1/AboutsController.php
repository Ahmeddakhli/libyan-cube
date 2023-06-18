<?php

namespace Modules\About\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\About\Http\Controllers\Actions\SearchAboutQueryAction;
use Modules\About\Http\Controllers\Actions\CreateAboutAction;
use Modules\About\Http\Controllers\Actions\DeleteAboutAction;
use Modules\About\Http\Controllers\Actions\GetAboutAction;
use Modules\About\Http\Controllers\Actions\UpdateAboutAction;
use Modules\About\Http\Requests\CreateAboutRequest;
use Modules\About\Http\Requests\DeleteAboutRequest;
use Modules\About\Http\Requests\UpdateAboutRequest;
use Modules\About\Http\Resources\AboutResource;
use Modules\About\About;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth, Lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Yajra\Datatables\Datatables;
use App\Language;

class AboutsController extends Controller
{
    /**
     * Store about
     *
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateAboutRequest $request, CreateAboutAction $action)
    {
        // Create the about
        $about = $action->execute($request->except([]), $request->translations);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'About section created successfully';
        $resp->status = true;
        $resp->data = $about;
        return response()->json($resp, 200);
    }

    /**
     * Update about
     *
     * @param  [integer] id
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateAboutRequest $request, UpdateAboutAction $action)
    {
        // Update the about
        $about = $action->execute($request->input('id'), $request->except(['id']), $request->translations);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'About section updated successfully';
        $resp->status = true;
        $resp->data = $about;
        return response()->json($resp, 200);
    }

    /**
     * Delete about
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteAboutRequest $request, DeleteAboutAction $action)
    {
        // Delete the about
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'About section deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index about sections
     * @return Response
     */
    public function index(Request $request, GetAboutAction $action)
    {
        $about_sections = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'About sections retrieved successfully';
        $resp->status = true;
        $resp->data = $about_sections;
        return response()->json($resp, 200);
    }
}
