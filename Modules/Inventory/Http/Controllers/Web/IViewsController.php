<?php

namespace Modules\Inventory\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Inventory\Http\Controllers\Actions\Views\SearchIViewsQueryAction;
use Modules\Inventory\Http\Controllers\Actions\Views\CreateIViewAction;
use Modules\Inventory\Http\Controllers\Actions\Views\DeleteIViewAction;
use Modules\Inventory\Http\Controllers\Actions\Views\UpdateIViewAction;
use Modules\Inventory\Http\Requests\Views\CreateIViewRequest;
use Modules\Inventory\Http\Requests\Views\DeleteIViewRequest;
use Modules\Inventory\Http\Requests\Views\UpdateIViewRequest;
use Modules\Inventory\Http\Resources\IViewResource;
use Modules\Inventory\IView;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth, Lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Yajra\Datatables\Datatables;
use App\Language;

class IViewsController extends Controller
{
    /**
     * Store i_view
     *
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateIViewRequest $request, CreateIViewAction $action)
    {
        // Create the i_view
        $i_view = $action->execute($request->except([]));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'View created successfully';
        $resp->status = true;
        $resp->data = $i_view;
        return response()->json($resp, 200);
    }

    /**
     * Update i_view
     *
     * @param  [integer] id
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIViewRequest $request, UpdateIViewAction $action)
    {
        // Update the i_view
        $i_view = $action->execute($request->input('id'), $request->except(['id']));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'View updated successfully';
        $resp->status = true;
        $resp->data = $i_view;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_view
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIViewRequest $request, DeleteIViewAction $action)
    {
        // Delete the i_view
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'View deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index i_views
     * @return Response
     */
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the i_views
            $action = new SearchIViewsQueryAction;
            $i_views = $action->execute($auth_user, $request);
            return Datatables::of($i_views)
                ->addColumn('value', function ($i_view) {
                    return $i_view->value;
                })
                ->filterColumn('value', function($query, $keyword) {
                    $query->whereHas('translations', function($translation) use ($keyword) {
                        $translation->where('view', 'like', '%'.$keyword.'%');
                    });
                })
                ->addColumn('created_at', function ($i_view) {
                    return $i_view->created_at ? $i_view->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function ($i_view) {
                    return $i_view->updated_at ? $i_view->updated_at->toDateTimeString() : null;
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

            return view('inventory::views.' . $blade_name);
        }
    }

    /**
     * Create i_view
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('inventory::views.' . $blade_name, compact('languages'), []);
    }

    public function createIViewModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        return view('inventory::views.modals.create', compact('languages'), [])->render();
    }

    public function UpdateIViewModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $i_view = IView::find($id);

        // If i_view does not exist, return error div
        if (!$i_view) {
            $error = Lang::get('inventory::inventory.i_view_not_found_or_you_are_not_authorized_to_edit_the_i_view');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the languages
        $languages = Language::all();

        return view('inventory::views.modals.update', compact('i_view', 'languages'), [])->render();
    }
}
