<?php

namespace Modules\Inventory\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Inventory\Http\Controllers\Actions\Purposes\SearchIPurposesQueryAction;
use Modules\Inventory\Http\Controllers\Actions\Purposes\CreateIPurposeAction;
use Modules\Inventory\Http\Controllers\Actions\Purposes\DeleteIPurposeAction;
use Modules\Inventory\Http\Controllers\Actions\Purposes\UpdateIPurposeAction;
use Modules\Inventory\Http\Requests\Purposes\CreateIPurposeRequest;
use Modules\Inventory\Http\Requests\Purposes\DeleteIPurposeRequest;
use Modules\Inventory\Http\Requests\Purposes\UpdateIPurposeRequest;
use Modules\Inventory\Http\Resources\IPurposeResource;
use Modules\Inventory\IPurpose;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth, Lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Yajra\Datatables\Datatables;
use App\Language;

class IPurposesController extends Controller
{
    /**
     * Store i_purpose
     *
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateIPurposeRequest $request, CreateIPurposeAction $action)
    {
        // Create the i_purpose
        $i_purpose = $action->execute($request->except([]));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Purpose created successfully';
        $resp->status = true;
        $resp->data = $i_purpose;
        return response()->json($resp, 200);
    }

    /**
     * Update i_purpose
     *
     * @param  [integer] id
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIPurposeRequest $request, UpdateIPurposeAction $action)
    {
        // Update the i_purpose
        $i_purpose = $action->execute($request->input('id'), $request->except(['id']));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Purpose updated successfully';
        $resp->status = true;
        $resp->data = $i_purpose;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_purpose
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIPurposeRequest $request, DeleteIPurposeAction $action)
    {
        // Delete the i_purpose
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Purpose deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index i_purposes
     * @return Response
     */
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the i_purposes
            $action = new SearchIPurposesQueryAction;
            $i_purposes = $action->execute($auth_user, $request);
            return Datatables::of($i_purposes)
                ->addColumn('value', function($i_purpose) {
                    return $i_purpose->value;
                })
                ->filterColumn('value', function($query, $keyword) {
                    $query->whereHas('translations', function($translation) use ($keyword) {
                        $translation->where('purpose', 'like', '%'.$keyword.'%');
                    });
                })
                ->addColumn('created_at', function($i_purpose) {
                    return $i_purpose->created_at ? $i_purpose->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function($i_purpose) {
                    return $i_purpose->updated_at ? $i_purpose->updated_at->toDateTimeString() : null;
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

            return view('inventory::purposes.'.$blade_name);
        }

    }

    /**
     * Create i_purpose
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('inventory::purposes.'.$blade_name, compact('languages'), []);
    }

    public function createIPurposeModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        return view('inventory::purposes.modals.create', compact('languages'), [])->render();
    }

    public function UpdateIPurposeModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $i_purpose = IPurpose::find($id);

        // If i_purpose does not exist, return error div
        if (!$i_purpose) {
            $error = Lang::get('inventory::inventory.i_purpose_not_found_or_you_are_not_authorized_to_edit_the_i_purpose');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the languages
        $languages = Language::all();

        return view('inventory::purposes.modals.update', compact('i_purpose', 'languages'), [])->render();
    }
}
