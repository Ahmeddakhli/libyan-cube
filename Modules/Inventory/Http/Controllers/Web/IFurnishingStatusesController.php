<?php

namespace Modules\Inventory\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Inventory\Http\Controllers\Actions\FurnishingStatuses\SearchIFurnishingStatusesQueryAction;
use Modules\Inventory\Http\Controllers\Actions\FurnishingStatuses\CreateIFurnishingStatusAction;
use Modules\Inventory\Http\Controllers\Actions\FurnishingStatuses\DeleteIFurnishingStatusAction;
use Modules\Inventory\Http\Controllers\Actions\FurnishingStatuses\UpdateIFurnishingStatusAction;
use Modules\Inventory\Http\Requests\FurnishingStatuses\CreateIFurnishingStatusRequest;
use Modules\Inventory\Http\Requests\FurnishingStatuses\DeleteIFurnishingStatusRequest;
use Modules\Inventory\Http\Requests\FurnishingStatuses\UpdateIFurnishingStatusRequest;
use Modules\Inventory\Http\Resources\IFurnishingStatusResource;
use Modules\Inventory\IFurnishingStatus;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth, Lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Yajra\Datatables\Datatables;
use App\Language;

class IFurnishingStatusesController extends Controller
{
    /**
     * Store i_furnishing_status
     *
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateIFurnishingStatusRequest $request, CreateIFurnishingStatusAction $action)
    {
        // Create the i_furnishing_status
        $i_furnishing_status = $action->execute($request->except([]));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Furnishing status created successfully';
        $resp->status = true;
        $resp->data = $i_furnishing_status;
        return response()->json($resp, 200);
    }

    /**
     * Update i_furnishing_status
     *
     * @param  [integer] id
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIFurnishingStatusRequest $request, UpdateIFurnishingStatusAction $action)
    {
        // Update the i_furnishing_status
        $i_furnishing_status = $action->execute($request->input('id'), $request->except(['id']));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Furnishing status updated successfully';
        $resp->status = true;
        $resp->data = $i_furnishing_status;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_furnishing_status
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIFurnishingStatusRequest $request, DeleteIFurnishingStatusAction $action)
    {
        // Delete the i_furnishing_status
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Furnishing status deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index i_furnishing_statuses
     * @return Response
     */
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the i_furnishing_statuses
            $action = new SearchIFurnishingStatusesQueryAction;
            $i_furnishing_statuses = $action->execute($auth_user, $request);
            return Datatables::of($i_furnishing_statuses)
                ->addColumn('value', function($i_furnishing_status) {
                    return $i_furnishing_status->value;
                })
                ->filterColumn('value', function($query, $keyword) {
                    $query->whereHas('translations', function($translation) use ($keyword) {
                        $translation->where('furnishing_status', 'like', '%'.$keyword.'%');
                    });
                })
                ->addColumn('created_at', function($i_furnishing_status) {
                    return $i_furnishing_status->created_at ? $i_furnishing_status->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function($i_furnishing_status) {
                    return $i_furnishing_status->updated_at ? $i_furnishing_status->updated_at->toDateTimeString() : null;
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

            return view('inventory::furnishing_statuses.'.$blade_name);
        }

    }

    /**
     * Create i_furnishing_status
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('inventory::furnishing_statuses.'.$blade_name, compact('languages'), []);
    }

    public function createIFurnishingStatusModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        return view('inventory::furnishing_statuses.modals.create', compact('languages'), [])->render();
    }

    public function UpdateIFurnishingStatusModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $i_furnishing_status = IFurnishingStatus::find($id);

        // If i_furnishing_status does not exist, return error div
        if (!$i_furnishing_status) {
            $error = Lang::get('inventory::inventory.i_furnishing_status_not_found_or_you_are_not_authorized_to_edit_the_i_furnishing_status');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the languages
        $languages = Language::all();

        return view('inventory::furnishing_statuses.modals.update', compact('i_furnishing_status', 'languages'), [])->render();
    }
}
