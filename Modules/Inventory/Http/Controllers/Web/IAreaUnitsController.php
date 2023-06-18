<?php

namespace Modules\Inventory\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Inventory\Http\Controllers\Actions\AreaUnits\SearchIAreaUnitsQueryAction;
use Modules\Inventory\Http\Controllers\Actions\AreaUnits\CreateIAreaUnitAction;
use Modules\Inventory\Http\Controllers\Actions\AreaUnits\DeleteIAreaUnitAction;
use Modules\Inventory\Http\Controllers\Actions\AreaUnits\UpdateIAreaUnitAction;
use Modules\Inventory\Http\Requests\AreaUnits\CreateIAreaUnitRequest;
use Modules\Inventory\Http\Requests\AreaUnits\DeleteIAreaUnitRequest;
use Modules\Inventory\Http\Requests\AreaUnits\UpdateIAreaUnitRequest;
use Modules\Inventory\Http\Resources\IAreaUnitResource;
use Modules\Inventory\IAreaUnit;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth, Lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Yajra\Datatables\Datatables;
use App\Language;

class IAreaUnitsController extends Controller
{
    /**
     * Store i_area_unit
     *
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateIAreaUnitRequest $request, CreateIAreaUnitAction $action)
    {
        // Create the i_area_unit
        $i_area_unit = $action->execute($request->except([]));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Area unit created successfully';
        $resp->status = true;
        $resp->data = $i_area_unit;
        return response()->json($resp, 200);
    }

    /**
     * Update i_area_unit
     *
     * @param  [integer] id
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIAreaUnitRequest $request, UpdateIAreaUnitAction $action)
    {
        // Update the i_area_unit
        $i_area_unit = $action->execute($request->input('id'), $request->except(['id']));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Area unit updated successfully';
        $resp->status = true;
        $resp->data = $i_area_unit;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_area_unit
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIAreaUnitRequest $request, DeleteIAreaUnitAction $action)
    {
        // Delete the i_area_unit
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Area unit deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index i_area_units
     * @return Response
     */
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the i_area_units
            $action = new SearchIAreaUnitsQueryAction;
            $i_area_units = $action->execute($auth_user, $request);
            return Datatables::of($i_area_units)
                ->addColumn('value', function ($i_area_unit) {
                    return $i_area_unit->value;
                })
                ->filterColumn('value', function($query, $keyword) {
                    $query->whereHas('translations', function($translation) use ($keyword) {
                        $translation->where('area_unit', 'like', '%'.$keyword.'%');
                    });
                })
                ->addColumn('created_at', function ($i_area_unit) {
                    return $i_area_unit->created_at ? $i_area_unit->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function ($i_area_unit) {
                    return $i_area_unit->updated_at ? $i_area_unit->updated_at->toDateTimeString() : null;
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

            return view('inventory::area_units.' . $blade_name);
        }
    }

    /**
     * Create i_area_unit
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('inventory::area_units.' . $blade_name, compact('languages'), []);
    }

    public function createIAreaUnitModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        return view('inventory::area_units.modals.create', compact('languages'), [])->render();
    }

    public function UpdateIAreaUnitModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $i_area_unit = IAreaUnit::find($id);

        // If i_area_unit does not exist, return error div
        if (!$i_area_unit) {
            $error = Lang::get('inventory::inventory.i_area_unit_not_found_or_you_are_not_authorized_to_edit_the_i_area_unit');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the languages
        $languages = Language::all();

        return view('inventory::area_units.modals.update', compact('i_area_unit', 'languages'), [])->render();
    }
}
