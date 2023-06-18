<?php

namespace Modules\Inventory\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Inventory\Http\Controllers\Actions\OfferingTypes\SearchIOfferingTypesQueryAction;
use Modules\Inventory\Http\Controllers\Actions\OfferingTypes\CreateIOfferingTypeAction;
use Modules\Inventory\Http\Controllers\Actions\OfferingTypes\DeleteIOfferingTypeAction;
use Modules\Inventory\Http\Controllers\Actions\OfferingTypes\UpdateIOfferingTypeAction;
use Modules\Inventory\Http\Requests\OfferingTypes\CreateIOfferingTypeRequest;
use Modules\Inventory\Http\Requests\OfferingTypes\DeleteIOfferingTypeRequest;
use Modules\Inventory\Http\Requests\OfferingTypes\UpdateIOfferingTypeRequest;
use Modules\Inventory\Http\Resources\IOfferingTypeResource;
use Modules\Inventory\IOfferingType;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth, Lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Yajra\Datatables\Datatables;
use App\Language;

class IOfferingTypesController extends Controller
{
    /**
     * Store i_offering_type
     *
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateIOfferingTypeRequest $request, CreateIOfferingTypeAction $action)
    {
        // Create the i_offering_type
        $i_offering_type = $action->execute($request->except([]));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Offering type created successfully';
        $resp->status = true;
        $resp->data = $i_offering_type;
        return response()->json($resp, 200);
    }

    /**
     * Update i_offering_type
     *
     * @param  [integer] id
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIOfferingTypeRequest $request, UpdateIOfferingTypeAction $action)
    {
        // Update the i_offering_type
        $i_offering_type = $action->execute($request->input('id'), $request->except(['id']));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Offering type updated successfully';
        $resp->status = true;
        $resp->data = $i_offering_type;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_offering_type
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIOfferingTypeRequest $request, DeleteIOfferingTypeAction $action)
    {
        // Delete the i_offering_type
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Offering type deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index i_offering_types
     * @return Response
     */
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the i_offering_types
            $action = new SearchIOfferingTypesQueryAction;
            $i_offering_types = $action->execute($auth_user, $request);
            return Datatables::of($i_offering_types)
                ->addColumn('value', function ($i_offering_type) {
                    return $i_offering_type->value;
                })
                ->filterColumn('value', function($query, $keyword) {
                    $query->whereHas('translations', function($translation) use ($keyword) {
                        $translation->where('offering_type', 'like', '%'.$keyword.'%');
                    });
                })
                ->addColumn('created_at', function ($i_offering_type) {
                    return $i_offering_type->created_at ? $i_offering_type->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function ($i_offering_type) {
                    return $i_offering_type->updated_at ? $i_offering_type->updated_at->toDateTimeString() : null;
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

            return view('inventory::offering_types.' . $blade_name);
        }
    }

    /**
     * Create i_offering_type
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('inventory::offering_types.' . $blade_name, compact('languages'), []);
    }

    public function createIOfferingTypeModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        return view('inventory::offering_types.modals.create', compact('languages'), [])->render();
    }

    public function UpdateIOfferingTypeModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $i_offering_type = IOfferingType::find($id);

        // If i_offering_type does not exist, return error div
        if (!$i_offering_type) {
            $error = Lang::get('inventory::inventory.i_offering_type_not_found_or_you_are_not_authorized_to_edit_the_i_offering_type');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the languages
        $languages = Language::all();

        return view('inventory::offering_types.modals.update', compact('i_offering_type', 'languages'), [])->render();
    }
}
