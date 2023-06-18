<?php

namespace Modules\SEO\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\SEO\Http\Controllers\Actions\SearchSeoQueryAction;
use Modules\SEO\Http\Controllers\Actions\CreateSeoAction;
use Modules\SEO\Http\Controllers\Actions\UpdateSeoAction;
use Modules\SEO\Http\Controllers\Actions\DeleteSeoAction;
use Modules\SEO\Http\Controllers\Actions\ApplySeoAction;
use Modules\SEO\Http\Requests\CreateSeoRequest;
use Modules\SEO\Http\Requests\UpdateSeoRequest;
use Modules\SEO\Http\Requests\DeleteSeoRequest;
use Modules\SEO\Http\Requests\ApplySeoRequest;
use Modules\SEO\Seo;
use App\Http\Helpers\ServiceResponse;
use Auth, Lang;
use Yajra\Datatables\Datatables;
use App\Language;

class SeoController extends Controller
{
    /**
     * Store seo
     *
     * @param  [integer] number_of_available_vacancies
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateSeoRequest $request, CreateSeoAction $action)
    {
        // Create the seo
        $seo = $action->execute($request->except([]));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'seo created successfully';
        $resp->status = true;
        $resp->data = ['redirect_to' => route('seo.index'), 'seo' => $seo];
        return response()->json($resp, 200);
    }

    /**
     * Update seo
     *
     * @param  [integer] id
     * @param  [integer] number_of_available_vacancies
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateSeoRequest $request, UpdateSeoAction $action)
    {
        // Update the seo
        $seo = $action->execute($request->input('id'), $request->except(['id']));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'seo updated successfully';
        $resp->status = true;
        $resp->data = ['redirect_to' => route('seo.index'), 'seo' => $seo];
        return response()->json($resp, 200);
    }

    /**
     * Delete seo
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteSeoRequest $request, DeleteSeoAction $action)
    {
        // Delete the seo
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'seo deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index seo
     * @return Response
     */
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the seo
            $action = new SearchSeoQueryAction;
            $seo = $action->execute($auth_user, $request);

            return Datatables::of($seo)
                ->addColumn('value', function ($seo) {
                    return $seo->value;
                })
                ->filterColumn('value', function($query, $keyword) {
                    $query->whereHas('translations', function($translation) use ($keyword) {
                        $translation->where('title', 'like', '%'.$keyword.'%');
                    });
                })
                ->addColumn('created_at', function ($seo) {
                    return $seo->created_at ? $seo->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function ($seo) {
                    return $seo->updated_at ? $seo->updated_at->toDateTimeString() : null;
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

            return view('seo::seo.' . $blade_name);
        }
    }

    /**
     * Create seo
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('seo::seo.' . $blade_name, compact('languages'), []);
    }

    public function createSeoModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        return view('seo::seo.create', compact('languages'), [])->render();
    }

    public function UpdateSeoModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $seo = Seo::find($id);

        // If seo does not exist, return error div
        if (!$seo) {
            $error = Lang::get('seo::seo.seo_not_found_or_you_are_not_authorized_to_edit_the_seo');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the languages
        $languages = Language::all();

        return view('seo::seo.modals.update', compact('seo', 'languages'), [])->render();
    }

}
