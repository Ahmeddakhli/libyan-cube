<?php

namespace Modules\Inventory\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Inventory\Http\Controllers\Actions\Amenities\SearchIAmenitiesQueryAction;
use Modules\Inventory\Http\Controllers\Actions\Amenities\CreateIAmenityAction;
use Modules\Inventory\Http\Controllers\Actions\Amenities\DeleteIAmenityAction;
use Modules\Inventory\Http\Controllers\Actions\Amenities\UpdateIAmenityAction;
use Modules\Inventory\Http\Requests\Amenities\CreateIAmenityRequest;
use Modules\Inventory\Http\Requests\Amenities\DeleteIAmenityRequest;
use Modules\Inventory\Http\Requests\Amenities\UpdateIAmenityRequest;
use Modules\Inventory\Http\Resources\IAmenityResource;
use Modules\Inventory\IAmenity;
use App\Http\Helpers\ServiceResponse;
use App\Http\Resources\MediaResource;
use Carbon\Carbon;
use Auth, Lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Yajra\Datatables\Datatables;
use App\Language;

class IAmenitiesController extends Controller
{
    /**
     * Store i_amenity
     *
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateIAmenityRequest $request, CreateIAmenityAction $action)
    {
        // Create the i_amenity
        $i_amenity = $action->execute($request->except(['attachments']), $request->attachments);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = trans('inventory::inventory.amenity_created_successfully');
        $resp->status = true;
        $resp->data = $i_amenity;
        return response()->json($resp, 200);
    }

    /**
     * Update i_amenity
     *
     * @param  [integer] id
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIAmenityRequest $request, UpdateIAmenityAction $action)
    {

        // Update the i_amenity
        $i_amenity = $action->execute($request->input('id'), $request->except(['id', 'attachments']), $request->attachments);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = trans('inventory::inventory.amenity_updated_successfully');
        $resp->status = true;
        $resp->data = $i_amenity;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_amenity
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIAmenityRequest $request, DeleteIAmenityAction $action)
    {
        // Delete the i_amenity
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = trans('inventory::inventory.amenity_deleted_successfully');
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index I_amenities
     * @return Response
     */
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the I_amenities
            $action = new SearchIAmenitiesQueryAction;
            $i_amenities = $action->execute($auth_user, $request);
            return Datatables::of($i_amenities)
                ->addColumn('value', function ($i_amenity) {
                    return $i_amenity->value;
                })
                ->filterColumn('value', function($query, $keyword) {
                    $query->whereHas('translations', function($translation) use ($keyword) {
                        $translation->where('amenity', 'like', '%'.$keyword.'%');
                    });
                })
                ->addColumn('created_at', function ($i_amenity) {
                    return $i_amenity->created_at ? $i_amenity->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function ($i_amenity) {
                    return $i_amenity->updated_at ? $i_amenity->updated_at->toDateTimeString() : null;
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

            return view('inventory::amenities.' . $blade_name);
        }
    }

    /**
     * Create i_amenity
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('inventory::amenities.' . $blade_name, compact('languages'), []);
    }

    public function createIAmenityModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        return view('inventory::amenities.modals.create', compact('languages'), [])->render();
    }

    public function UpdateIAmenityModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $i_amenity = IAmenity::find($id);
        $attachments = json_decode(json_encode(MediaResource::collection($i_amenity->getMedia(request()->getHttpHost() . ',inventory,amenities,' . $i_amenity->id . ',' . 'attachments'))));

        // If i_amenity does not exist, return error div
        if (!$i_amenity) {
            $error = Lang::get('inventory::inventory.i_amenity_not_found_or_you_are_not_authorized_to_edit_the_i_amenity');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the languages
        $languages = Language::all();
        return view('inventory::amenities.modals.update', compact('i_amenity', 'languages', 'attachments'))->render();
    }
}
