<?php

namespace Modules\Inventory\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Inventory\Http\Controllers\Actions\Positions\SearchIPositionsQueryAction;
use Modules\Inventory\Http\Controllers\Actions\Positions\CreateIPositionAction;
use Modules\Inventory\Http\Controllers\Actions\Positions\DeleteIPositionAction;
use Modules\Inventory\Http\Controllers\Actions\Positions\UpdateIPositionAction;
use Modules\Inventory\Http\Requests\Positions\CreateIPositionRequest;
use Modules\Inventory\Http\Requests\Positions\DeleteIPositionRequest;
use Modules\Inventory\Http\Requests\Positions\UpdateIPositionRequest;
use Modules\Inventory\Http\Resources\IPositionResource;
use Modules\Inventory\IPosition;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth, Lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Yajra\Datatables\Datatables;
use App\Language;

class IPositionsController extends Controller
{
    /**
     * Store i_position
     *
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateIPositionRequest $request, CreateIPositionAction $action)
    {
        // Create the i_position
        $i_position = $action->execute($request->except([]));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Position created successfully';
        $resp->status = true;
        $resp->data = $i_position;
        return response()->json($resp, 200);
    }

    /**
     * Update i_position
     *
     * @param  [integer] id
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIPositionRequest $request, UpdateIPositionAction $action)
    {
        // Update the i_position
        $i_position = $action->execute($request->input('id'), $request->except(['id']));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Position updated successfully';
        $resp->status = true;
        $resp->data = $i_position;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_position
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIPositionRequest $request, DeleteIPositionAction $action)
    {
        // Delete the i_position
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Position deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index i_positions
     * @return Response
     */
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the i_positions
            $action = new SearchIPositionsQueryAction;
            $i_positions = $action->execute($auth_user, $request);
            return Datatables::of($i_positions)
                ->addColumn('value', function ($i_position) {
                    return $i_position->value;
                })
                ->filterColumn('value', function($query, $keyword) {
                    $query->whereHas('translations', function($translation) use ($keyword) {
                        $translation->where('position', 'like', '%'.$keyword.'%');
                    });
                })
                ->addColumn('created_at', function ($i_position) {
                    return $i_position->created_at ? $i_position->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function ($i_position) {
                    return $i_position->updated_at ? $i_position->updated_at->toDateTimeString() : null;
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

            return view('inventory::positions.' . $blade_name);
        }
    }

    /**
     * Create i_position
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('inventory::positions.' . $blade_name, compact('languages'), []);
    }

    public function createIPositionModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        return view('inventory::positions.modals.create', compact('languages'), [])->render();
    }

    public function UpdateIPositionModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $i_position = IPosition::find($id);

        // If i_position does not exist, return error div
        if (!$i_position) {
            $error = Lang::get('inventory::inventory.i_position_not_found_or_you_are_not_authorized_to_edit_the_i_position');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the languages
        $languages = Language::all();

        return view('inventory::positions.modals.update', compact('i_position', 'languages'), [])->render();
    }
}
