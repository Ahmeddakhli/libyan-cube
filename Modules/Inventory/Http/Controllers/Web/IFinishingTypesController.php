<?php

namespace Modules\Inventory\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Inventory\Http\Controllers\Actions\FinishingTypes\SearchIFinishingTypesQueryAction;
use Modules\Inventory\Http\Controllers\Actions\FinishingTypes\CreateIFinishingTypeAction;
use Modules\Inventory\Http\Controllers\Actions\FinishingTypes\DeleteIFinishingTypeAction;
use Modules\Inventory\Http\Controllers\Actions\FinishingTypes\UpdateIFinishingTypeAction;
use Modules\Inventory\Http\Requests\FinishingTypes\CreateIFinishingTypeRequest;
use Modules\Inventory\Http\Requests\FinishingTypes\DeleteIFinishingTypeRequest;
use Modules\Inventory\Http\Requests\FinishingTypes\UpdateIFinishingTypeRequest;
use Modules\Inventory\Http\Resources\IFinishingTypeResource;
use Modules\Inventory\IFinishingType;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth, Lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Yajra\Datatables\Datatables;
use App\Language;

class IFinishingTypesController extends Controller
{
    /**
     * Store i_finishing_type
     *
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateIFinishingTypeRequest $request, CreateIFinishingTypeAction $action)
    {
        // Create the i_finishing_type
        $i_finishing_type = $action->execute($request->except([]));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Finishing type created successfully';
        $resp->status = true;
        $resp->data = $i_finishing_type;
        return response()->json($resp, 200);
    }

    /**
     * Update i_finishing_type
     *
     * @param  [integer] id
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIFinishingTypeRequest $request, UpdateIFinishingTypeAction $action)
    {
        // Update the i_finishing_type
        $i_finishing_type = $action->execute($request->input('id'), $request->except(['id']));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Finishing type updated successfully';
        $resp->status = true;
        $resp->data = $i_finishing_type;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_finishing_type
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIFinishingTypeRequest $request, DeleteIFinishingTypeAction $action)
    {
        // Delete the i_finishing_type
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Finishing type deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index i_finishing_types
     * @return Response
     */
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the i_finishing_types
            $action = new SearchIFinishingTypesQueryAction;
            $i_finishing_types = $action->execute($auth_user, $request);
            return Datatables::of($i_finishing_types)
                ->addColumn('value', function ($i_finishing_type) {
                    return $i_finishing_type->value;
                })
                ->filterColumn('value', function($query, $keyword) {
                    $query->whereHas('translations', function($translation) use ($keyword) {
                        $translation->where('finishing_type', 'like', '%'.$keyword.'%');
                    });
                })
                ->addColumn('created_at', function ($i_finishing_type) {
                    return $i_finishing_type->created_at ? $i_finishing_type->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function ($i_finishing_type) {
                    return $i_finishing_type->updated_at ? $i_finishing_type->updated_at->toDateTimeString() : null;
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

            return view('inventory::finishing_types.' . $blade_name);
        }
    }

    /**
     * Create i_finishing_type
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('inventory::finishing_types.' . $blade_name, compact('languages'), []);
    }

    public function createIFinishingTypeModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        return view('inventory::finishing_types.modals.create', compact('languages'), [])->render();
    }

    public function UpdateIFinishingTypeModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $i_finishing_type = IFinishingType::find($id);

        // If i_finishing_type does not exist, return error div
        if (!$i_finishing_type) {
            $error = Lang::get('inventory::inventory.i_finishing_type_not_found_or_you_are_not_authorized_to_edit_the_i_finishing_type');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the languages
        $languages = Language::all();

        return view('inventory::finishing_types.modals.update', compact('i_finishing_type', 'languages'), [])->render();
    }
}
