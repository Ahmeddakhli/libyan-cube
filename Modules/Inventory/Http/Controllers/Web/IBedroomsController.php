<?php

namespace Modules\Inventory\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Inventory\Http\Controllers\Actions\Bedrooms\SearchIBedroomsQueryAction;
use Modules\Inventory\Http\Controllers\Actions\Bedrooms\CreateIBedroomAction;
use Modules\Inventory\Http\Controllers\Actions\Bedrooms\DeleteIBedroomAction;
use Modules\Inventory\Http\Controllers\Actions\Bedrooms\UpdateIBedroomAction;
use Modules\Inventory\Http\Requests\Bedrooms\CreateIBedroomRequest;
use Modules\Inventory\Http\Requests\Bedrooms\DeleteIBedroomRequest;
use Modules\Inventory\Http\Requests\Bedrooms\UpdateIBedroomRequest;
use Modules\Inventory\Http\Resources\IBedroomResource;
use Modules\Inventory\IBedroom;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth, Lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Yajra\Datatables\Datatables;
use App\Language;

class IBedroomsController extends Controller
{
    /**
     * Store i_bedroom
     *
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateIBedroomRequest $request, CreateIBedroomAction $action)
    {
        // Create the i_bedroom
        $i_bedroom = $action->execute($request->except([]));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Bedroom created successfully';
        $resp->status = true;
        $resp->data = $i_bedroom;
        return response()->json($resp, 200);
    }

    /**
     * Update i_bedroom
     *
     * @param  [integer] id
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIBedroomRequest $request, UpdateIBedroomAction $action)
    {
        // Update the i_bedroom
        $i_bedroom = $action->execute($request->input('id'), $request->except(['id']));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Bedroom updated successfully';
        $resp->status = true;
        $resp->data = $i_bedroom;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_bedroom
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIBedroomRequest $request, DeleteIBedroomAction $action)
    {
        // Delete the i_bedroom
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Bedroom deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index i_bedrooms
     * @return Response
     */
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the i_bedrooms
            $action = new SearchIBedroomsQueryAction;
            $i_bedrooms = $action->execute($auth_user, $request);
            return Datatables::of($i_bedrooms)
                ->addColumn('value', function ($i_bedroom) {
                    return $i_bedroom->value;
                })
                ->filterColumn('value', function($query, $keyword) {
                    $query->whereHas('translations', function($translation) use ($keyword) {
                        $translation->where('displayed_text', 'like', '%'.$keyword.'%');
                    });
                })
                ->addColumn('created_at', function ($i_bedroom) {
                    return $i_bedroom->created_at ? $i_bedroom->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function ($i_bedroom) {
                    return $i_bedroom->updated_at ? $i_bedroom->updated_at->toDateTimeString() : null;
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

            return view('inventory::bedrooms.' . $blade_name);
        }
    }

    /**
     * Create i_bedroom
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('inventory::bedrooms.' . $blade_name, compact('languages'), []);
    }

    public function createIBedroomModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        return view('inventory::bedrooms.modals.create', compact('languages'), [])->render();
    }

    public function UpdateIBedroomModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $i_bedroom = IBedroom::find($id);

        // If i_bedroom does not exist, return error div
        if (!$i_bedroom) {
            $error = Lang::get('inventory::inventory.i_bedroom_not_found_or_you_are_not_authorized_to_edit_the_i_bedroom');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the languages
        $languages = Language::all();

        return view('inventory::bedrooms.modals.update', compact('i_bedroom', 'languages'), [])->render();
    }
}
