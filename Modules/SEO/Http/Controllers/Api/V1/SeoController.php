<?php

namespace Modules\SEO\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\SEO\Http\Controllers\Actions\CreateSeoAction;
use Modules\SEO\Http\Controllers\Actions\DeleteSeoAction;
use Modules\SEO\Http\Controllers\Actions\GetSeoAction;
use Modules\SEO\Http\Controllers\Actions\UpdateSeoAction;
use Modules\SEO\Http\Controllers\Actions\ApplySeoAction;
use Modules\SEO\Http\Requests\CreateSeoRequest;
use Modules\SEO\Http\Requests\DeleteSeoRequest;
use Modules\SEO\Http\Requests\UpdateSeoRequest;
use Modules\SEO\Http\Requests\ApplySeoRequest;
use App\Http\Helpers\ServiceResponse;

class SeoController extends Controller
{
    /**
     * Store Seo
     *
     * @param  [integer] number_of_available_vacancies
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateSeoRequest $request, CreateSeoAction $action)
    {
        // Create the Seo
        $seo = $action->execute($request->except([]));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Seo created successfully';
        $resp->status = true;
        $resp->data = $seo;
        return response()->json($resp, 200);
    }

    /**
     * Update Seo
     *
     * @param  [integer] id
     * @param  [integer] number_of_available_vacancies
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateSeoRequest $request, UpdateSeoAction $action)
    {
        // Update the Seo
        $seo = $action->execute($request->input('id'), $request->except(['id']));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Seo updated successfully';
        $resp->status = true;
        $resp->data = $seo;
        return response()->json($resp, 200);
    }

    /**
     * Delete Seo
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteSeoRequest $request, DeleteSeoAction $action)
    {

        // Delete the Seo
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Seo deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index Seos
     * @return Response
     */
    public function index(Request $request, GetSeoAction $action)
    {
        // Search the Seos
        $seos = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Seo retrieved successfully';
        $resp->status = true;
        $resp->data = $seos;
        return response()->json($resp, 200);
    }

    /**
     * Apply on Seo
     * @return Response
     */
    public function apply(ApplySeoRequest $request, ApplySeoAction $action)
    {
        $response = $action->execute($request->all(), $request->attachment);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = $response ? 'Application sent successfully' : 'Error occured while applying on the Seo';
        $resp->status = $response;
        $resp->data = null;
        return response()->json($resp, 200);
    }
}
