<?php

namespace Modules\Careers\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Careers\Http\Controllers\Actions\SearchCareersQueryAction;
use Modules\Careers\Http\Controllers\Actions\CreateCareerAction;
use Modules\Careers\Http\Controllers\Actions\UpdateCareerAction;
use Modules\Careers\Http\Controllers\Actions\DeleteCareerAction;
use Modules\Careers\Http\Controllers\Actions\GetCareersAction;
use Modules\Careers\Http\Controllers\Actions\ApplyCareerAction;
use Modules\Careers\Http\Requests\CreateCareerRequest;
use Modules\Careers\Http\Requests\UpdateCareerRequest;
use Modules\Careers\Http\Requests\DeleteCareerRequest;
use Modules\Careers\Http\Requests\ApplyCareerRequest;
use Modules\Careers\Http\Resources\CareerResource;
use Modules\Careers\Career;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth, Lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Yajra\Datatables\Datatables;
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
        $resp->data = ['redirect_to' => route('careers.index'), 'career' => $career];
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
        $resp->data = ['redirect_to' => route('careers.index'), 'career' => $career];
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
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the careers
            $action = new SearchCareersQueryAction;
            $careers = $action->execute($auth_user, $request);

            return Datatables::of($careers)
                ->addColumn('value', function ($career) {
                    return $career->value;
                })
                ->filterColumn('value', function($query, $keyword) {
                    $query->whereHas('translations', function($translation) use ($keyword) {
                        $translation->where('title', 'like', '%'.$keyword.'%');
                    });
                })
                ->addColumn('created_at', function ($career) {
                    return $career->created_at ? $career->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function ($career) {
                    return $career->updated_at ? $career->updated_at->toDateTimeString() : null;
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

            return view('careers::careers.' . $blade_name);
        }
    }

    /**
     * Create career
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('careers::careers.' . $blade_name, compact('languages'), []);
    }

    public function createCareerModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        return view('careers::careers.create', compact('languages'), [])->render();
    }

    public function UpdateCareerModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $career = Career::find($id);

        // If career does not exist, return error div
        if (!$career) {
            $error = Lang::get('careers::career.career_not_found_or_you_are_not_authorized_to_edit_the_career');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the languages
        $languages = Language::all();

        return view('careers::careers.modals.update', compact('career', 'languages'), [])->render();
    }

    public function application(Request $request)
    {
        return view('careers::careers.apply-career');
    }

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
