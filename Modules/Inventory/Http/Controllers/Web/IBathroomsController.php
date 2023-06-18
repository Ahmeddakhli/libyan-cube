<?php

namespace Modules\Inventory\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Inventory\Http\Controllers\Actions\Bathrooms\SearchIBathroomsQueryAction;
use Modules\Inventory\Http\Controllers\Actions\Bathrooms\CreateIBathroomAction;
use Modules\Inventory\Http\Controllers\Actions\Bathrooms\DeleteIBathroomAction;
use Modules\Inventory\Http\Controllers\Actions\Bathrooms\UpdateIBathroomAction;
use Modules\Inventory\Http\Requests\Bathrooms\CreateIBathroomRequest;
use Modules\Inventory\Http\Requests\Bathrooms\DeleteIBathroomRequest;
use Modules\Inventory\Http\Requests\Bathrooms\UpdateIBathroomRequest;
use Modules\Inventory\Http\Resources\IBathroomResource;
use Modules\Inventory\IBathroom;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth, Lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Yajra\Datatables\Datatables;
use App\Language;

class IBathroomsController extends Controller
{
    /**
     * Store i_bathroom
     *
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateIBathroomRequest $request, CreateIBathroomAction $action)
    {
        // Create the i_bathroom
        $i_bathroom = $action->execute($request->except([]));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Bathroom created successfully';
        $resp->status = true;
        $resp->data = $i_bathroom;
        return response()->json($resp, 200);
    }

    /**
     * Update i_bathroom
     *
     * @param  [integer] id
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIBathroomRequest $request, UpdateIBathroomAction $action)
    {
        // Update the i_bathroom
        $i_bathroom = $action->execute($request->input('id'), $request->except(['id']));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Bathroom updated successfully';
        $resp->status = true;
        $resp->data = $i_bathroom;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_bathroom
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIBathroomRequest $request, DeleteIBathroomAction $action)
    {
        // Delete the i_bathroom
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Bathroom deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index i_bathrooms
     * @return Response
     */
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the i_bathrooms
            $action = new SearchIBathroomsQueryAction;
            $i_bathrooms = $action->execute($auth_user, $request);
            return Datatables::of($i_bathrooms)
                ->addColumn('value', function ($i_bathroom) {
                    return $i_bathroom->value;
                })
                ->filterColumn('value', function ($query, $keyword) {
                    $query->whereHas('translations', function ($translation) use ($keyword) {
                        $translation->where('displayed_text', 'like', '%' . $keyword . '%');
                    });
                })
                ->addColumn('created_at', function ($i_bathroom) {
                    return $i_bathroom->created_at ? $i_bathroom->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function ($i_bathroom) {
                    return $i_bathroom->updated_at ? $i_bathroom->updated_at->toDateTimeString() : null;
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

            return view('inventory::bathrooms.' . $blade_name);
        }
    }

    /**
     * Create i_bathroom
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('inventory::bathrooms.' . $blade_name, compact('languages'), []);
    }

    public function createIBathroomModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        return view('inventory::bathrooms.modals.create', compact('languages'), [])->render();
    }

    public function UpdateIBathroomModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $i_bathroom = IBathroom::find($id);

        // If i_bathroom does not exist, return error div
        if (!$i_bathroom) {
            $error = Lang::get('inventory::inventory.i_bathroom_not_found_or_you_are_not_authorized_to_edit_the_i_bathroom');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the languages
        $languages = Language::all();

        return view('inventory::bathrooms.modals.update', compact('i_bathroom', 'languages'), [])->render();
    }
}
