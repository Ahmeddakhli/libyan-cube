<?php

namespace Modules\Careers\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Careers\Http\Controllers\Actions\CreateCareerAction;
use Modules\Careers\Http\Controllers\Actions\DeleteCareerAction;
use Modules\Careers\Http\Controllers\Actions\GetCareersAction;
use Modules\Careers\Http\Controllers\Actions\UpdateCareerAction;
use Modules\Careers\Http\Controllers\Actions\ApplyCareerAction;
use Modules\Careers\Http\Requests\CreateCareerRequest;
use Modules\Careers\Http\Requests\DeleteCareerRequest;
use Modules\Careers\Http\Requests\GetCareersRequest;
use Modules\Careers\Http\Requests\UpdateCareerRequest;
use Modules\Careers\Http\Requests\ApplyCareerRequest;
use Modules\Careers\Http\Resources\CareerResource;
use Modules\Careers\Career;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth, Lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Language;

class CareersController extends Controller
{
    /**
     * Store career
     *
     * @param  [integer] number_of_available_vacancies
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateCareerRequest $request, CreateCareerAction $action)
    {
        // Create the career
        $career = $action->execute($request->except([]));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Career created successfully';
        $resp->status = true;
        $resp->data = $career;
        return response()->json($resp, 200);
    }

    /**
     * Update career
     *
     * @param  [integer] id
     * @param  [integer] number_of_available_vacancies
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateCareerRequest $request, UpdateCareerAction $action)
    {
        // Update the career
        $career = $action->execute($request->input('id'), $request->except(['id']));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Career updated successfully';
        $resp->status = true;
        $resp->data = $career;
        return response()->json($resp, 200);
    }

    /**
     * Delete career
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteCareerRequest $request, DeleteCareerAction $action)
    {

        // Delete the career
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Career deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index careers
     * @return Response
     */
    public function index(Request $request, GetCareersAction $action)
    {
        // Search the careers
        $careers = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Career retrieved successfully';
        $resp->status = true;
        $resp->data = $careers;
        return response()->json($resp, 200);
    }

    /**
     * Apply on career
     * @return Response
     */
    public function apply(ApplyCareerRequest $request, ApplyCareerAction $action)
    {
        $response = $action->execute($request->all(), $request->attachment);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = $response ? 'Application sent successfully' : 'Error occured while applying on the career';
        $resp->status = $response;
        $resp->data = null;
        return response()->json($resp, 200);
    }
}
