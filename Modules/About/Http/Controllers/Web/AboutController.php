<?php

namespace Modules\About\Http\Controllers\Web;

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

class AboutController extends Controller
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
        $resp->data = ['redirect_to' => route('about.index'), 'about' => $about];
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
        $resp->data = ['redirect_to' => route('about.index'), 'about' => $about];
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
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the about sections
            $action = new SearchAboutQueryAction;
            $about = $action->execute($auth_user, $request);

            return Datatables::of($about)
                ->addColumn('value', function ($about) {
                    return $about->value;
                })
                ->filterColumn('value', function($query, $keyword) {
                    $query->whereHas('translations', function($translation) use ($keyword) {
                        $translation->where('title', 'like', '%'.$keyword.'%');
                    });
                })
                ->addColumn('created_at', function ($about) {
                    return $about->created_at ? $about->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function ($about) {
                    return $about->updated_at ? $about->updated_at->toDateTimeString() : null;
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
            return view('about::about.' . $blade_name);
        }
    }

    /**
     * Create about
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('about::about.' . $blade_name, compact('languages'), []);
    }

    public function createAboutModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        return view('about::about.modals.create', compact('languages'), [])->render();
    }

    public function UpdateAboutModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $about = About::find($id);

        // If about does not exist, return error div
        if (!$about) {
            $error = Lang::get('about::about.about_secion_not_found_or_you_are_not_authorized_to_edit_the_about_section');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the languages
        $languages = Language::all();

        return view('about::about.modals.update', compact('about', 'languages'), [])->render();
    }
}
