<?php

namespace Modules\Inventory\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Inventory\Http\Controllers\Actions\FloorNumbers\SearchIFloorNumbersQueryAction;
use Modules\Inventory\Http\Controllers\Actions\FloorNumbers\CreateIFloorNumberAction;
use Modules\Inventory\Http\Controllers\Actions\FloorNumbers\DeleteIFloorNumberAction;
use Modules\Inventory\Http\Controllers\Actions\FloorNumbers\UpdateIFloorNumberAction;
use Modules\Inventory\Http\Requests\FloorNumbers\CreateIFloorNumberRequest;
use Modules\Inventory\Http\Requests\FloorNumbers\DeleteIFloorNumberRequest;
use Modules\Inventory\Http\Requests\FloorNumbers\UpdateIFloorNumberRequest;
use Modules\Inventory\Http\Resources\IFloorNumberResource;
use Modules\Inventory\IFloorNumber;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth, Lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Yajra\Datatables\Datatables;
use App\Language;

class IFloorNumbersController extends Controller
{
    /**
     * Store i_floor_number
     *
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateIFloorNumberRequest $request, CreateIFloorNumberAction $action)
    {
        // Create the i_floor_number
        $i_floor_number = $action->execute($request->except([]));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Floor number created successfully';
        $resp->status = true;
        $resp->data = $i_floor_number;
        return response()->json($resp, 200);
    }

    /**
     * Update i_floor_number
     *
     * @param  [integer] id
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIFloorNumberRequest $request, UpdateIFloorNumberAction $action)
    {
        // Update the i_floor_number
        $i_floor_number = $action->execute($request->input('id'), $request->except(['id']));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Floor number updated successfully';
        $resp->status = true;
        $resp->data = $i_floor_number;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_floor_number
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIFloorNumberRequest $request, DeleteIFloorNumberAction $action)
    {
        // Delete the i_floor_number
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Floor number deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index i_floor_numbers
     * @return Response
     */
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the i_floor_numbers
            $action = new SearchIFloorNumbersQueryAction;
            $i_floor_numbers = $action->execute($auth_user, $request);
            return Datatables::of($i_floor_numbers)
                ->addColumn('value', function ($i_floor_number) {
                    return $i_floor_number->value;
                })
                ->filterColumn('value', function($query, $keyword) {
                    $query->whereHas('translations', function($translation) use ($keyword) {
                        $translation->where('displayed_text', 'like', '%'.$keyword.'%');
                    });
                })
                ->addColumn('created_at', function ($i_floor_number) {
                    return $i_floor_number->created_at ? $i_floor_number->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function ($i_floor_number) {
                    return $i_floor_number->updated_at ? $i_floor_number->updated_at->toDateTimeString() : null;
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

            return view('inventory::floor_numbers.' . $blade_name);
        }
    }

    /**
     * Create i_floor_number
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('inventory::floor_numbers.' . $blade_name, compact('languages'), []);
    }

    public function createIFloorNumberModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        return view('inventory::floor_numbers.modals.create', compact('languages'), [])->render();
    }

    public function UpdateIFloorNumberModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $i_floor_number = IFloorNumber::find($id);

        // If i_floor_number does not exist, return error div
        if (!$i_floor_number) {
            $error = Lang::get('inventory::inventory.i_floor_number_not_found_or_you_are_not_authorized_to_edit_the_i_floor_number');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the languages
        $languages = Language::all();

        return view('inventory::floor_numbers.modals.update', compact('i_floor_number', 'languages'), [])->render();
    }
}
