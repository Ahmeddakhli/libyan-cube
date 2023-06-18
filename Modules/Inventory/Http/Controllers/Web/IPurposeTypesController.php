<?php

namespace Modules\Inventory\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Inventory\Http\Controllers\Actions\PurposeTypes\SearchIPurposeTypesQueryAction;
use Modules\Inventory\Http\Controllers\Actions\PurposeTypes\CreateIPurposeTypeAction;
use Modules\Inventory\Http\Controllers\Actions\PurposeTypes\DeleteIPurposeTypeAction;
use Modules\Inventory\Http\Controllers\Actions\PurposeTypes\UpdateIPurposeTypeAction;
use Modules\Inventory\Http\Controllers\Actions\PurposeTypes\GetIPurposePurposeTypesAction;
use Modules\Inventory\Http\Controllers\Actions\Purposes\GetIPurposesAction;
use Modules\Inventory\Http\Requests\PurposeTypes\CreateIPurposeTypeRequest;
use Modules\Inventory\Http\Requests\PurposeTypes\DeleteIPurposeTypeRequest;
use Modules\Inventory\Http\Requests\PurposeTypes\UpdateIPurposeTypeRequest;
use Modules\Inventory\Http\Requests\PurposeTypes\GetIPurposePurposeTypesRequest;
use Modules\Inventory\Http\Resources\IPurposeTypeResource;
use Modules\Inventory\IPurposeType;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth, Lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Yajra\Datatables\Datatables;
use App\Language;

class IPurposeTypesController extends Controller
{
    /**
     * Store i_purpose_type
     *
     * @param  [integer] order
     * @param  [integer] i_purpose_id
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateIPurposeTypeRequest $request, CreateIPurposeTypeAction $action)
    {
        // Create the i_purpose_type
        $i_purpose_type = $action->execute($request->except([]));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Purpose type created successfully';
        $resp->status = true;
        $resp->data = $i_purpose_type;
        return response()->json($resp, 200);
    }

    /**
     * Update i_purpose_type
     *
     * @param  [integer] id
     * @param  [integer] order
     * @param  [integer] i_purpose_id
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIPurposeTypeRequest $request, UpdateIPurposeTypeAction $action)
    {
        // Update the i_purpose_type
        $i_purpose_type = $action->execute($request->input('id'), $request->except(['id']));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Purpose type updated successfully';
        $resp->status = true;
        $resp->data = $i_purpose_type;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_purpose_type
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIPurposeTypeRequest $request, DeleteIPurposeTypeAction $action)
    {
        // Delete the i_purpose_type
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Purpose type deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index i_purpose_types
     * @return Response
     */
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the i_purpose_types
            $action = new SearchIPurposeTypesQueryAction;
            $i_purpose_types = $action->execute($auth_user, $request);
            $i_purpose_types->with('purpose');
            return Datatables::of($i_purpose_types)
                ->addColumn('value', function($i_purpose_type) {
                    return $i_purpose_type->value;
                })
                ->filterColumn('value', function($query, $keyword) {
                    $query->whereHas('translations', function($translation) use ($keyword) {
                        $translation->where('purpose_type', 'like', '%'.$keyword.'%');
                    });
                })
                ->addColumn('created_at', function($i_purpose_type) {
                    return $i_purpose_type->created_at ? $i_purpose_type->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function($i_purpose_type) {
                    return $i_purpose_type->updated_at ? $i_purpose_type->updated_at->toDateTimeString() : null;
                })
                ->addColumn('purpose', function($i_purpose_type) {
                    return $i_purpose_type->purpose ? $i_purpose_type->purpose->value : '';
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

            return view('inventory::purpose_types.'.$blade_name);
        }

    }

    /**
     * Get i_purpose_purpose_types
     *
     * @param  [integer] i_purpose_id
     * @return [json] ServiceResponse object
     */
    public function GetIPurposePurposeTypes(GetIPurposePurposeTypesRequest $request, GetIPurposePurposeTypesAction $action)
    {
        // Get the i_purpose_types
        $i_purpose_types = $action->execute($request->all());

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Purpose types retrieved successfully';
        $resp->status = true;
        $resp->data = $i_purpose_types;
        return response()->json($resp, 200);
    }

    /**
     * Create i_purpose_type
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();
        // Get the purposes
        $action = new GetIPurposesAction;
        $purposes = $action->execute();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('inventory::purpose_types.'.$blade_name, compact('languages', 'purposes'), []);
    }

    public function createIPurposeTypeModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();
        // Get the purposes
        $action = new GetIPurposesAction;
        $purposes = $action->execute();

        return view('inventory::purpose_types.modals.create', compact('languages', 'purposes'), [])->render();
    }

    public function UpdateIPurposeTypeModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $i_purpose_type = IPurposeType::find($id);

        // If i_purpose_type does not exist, return error div
        if (!$i_purpose_type) {
            $error = Lang::get('inventory::inventory.i_purpose_type_not_found_or_you_are_not_authorized_to_edit_the_i_purpose_type');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the languages
        $languages = Language::all();

        // Get the purposes
        $action = new GetIPurposesAction;
        $purposes = $action->execute();

        return view('inventory::purpose_types.modals.update', compact('i_purpose_type', 'languages', 'purposes'), [])->render();
    }
}
