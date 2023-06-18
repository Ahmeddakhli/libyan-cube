<?php

namespace Modules\Inventory\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Inventory\Http\Controllers\Actions\Facilities\SearchIFacilitiesQueryAction;
use Modules\Inventory\Http\Controllers\Actions\Facilities\CreateIFacilityAction;
use Modules\Inventory\Http\Controllers\Actions\Facilities\DeleteIFacilityAction;
use Modules\Inventory\Http\Controllers\Actions\Facilities\UpdateIFacilityAction;
use Modules\Inventory\Http\Requests\Facilities\CreateIFacilityRequest;
use Modules\Inventory\Http\Requests\Facilities\DeleteIFacilityRequest;
use Modules\Inventory\Http\Requests\Facilities\UpdateIFacilityRequest;
use Modules\Inventory\Http\Resources\IFacilityResource;
use Modules\Inventory\IFacility;
use App\Http\Helpers\ServiceResponse;
use App\Http\Resources\MediaResource;
use Carbon\Carbon;
use Auth, Lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Yajra\Datatables\Datatables;
use App\Language;

class IFacilitiesController extends Controller
{
    /**
     * Store i_facility
     *
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateIFacilityRequest $request, CreateIFacilityAction $action)
    {
        // Create the i_facility
        $i_facility = $action->execute($request->except(['attachments']),$request->attachments);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Facility created successfully';
        $resp->status = true;
        $resp->data = $i_facility;
        return response()->json($resp, 200);
    }

    /**
     * Update i_facility
     *
     * @param  [integer] id
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIFacilityRequest $request, UpdateIFacilityAction $action)
    {
        // Update the i_facility
        $i_facility = $action->execute($request->input('id'), $request->except(['id','attachments']),$request->attachments);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Facility updated successfully';
        $resp->status = true;
        $resp->data = $i_facility;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_facility
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIFacilityRequest $request, DeleteIFacilityAction $action)
    {
        // Delete the i_facility
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Facility deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index I_facilities
     * @return Response
     */
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the I_facilities
            $action = new SearchIFacilitiesQueryAction;
            $i_facilities = $action->execute($auth_user, $request);
            return Datatables::of($i_facilities)
                ->addColumn('id', function($i_facility) {
                    return $i_facility->id;
                })
                ->addColumn('value', function($i_facility) {
                    return $i_facility->value;
                })
                ->filterColumn('value', function($query, $keyword) {
                    $query->whereHas('translations', function($translation) use ($keyword) {
                        $translation->where('facility', 'like', '%'.$keyword.'%');
                    });
                })
                ->addColumn('created_at', function($i_facility) {
                    return $i_facility->created_at ? $i_facility->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function($i_facility) {
                    return $i_facility->updated_at ? $i_facility->updated_at->toDateTimeString() : null;
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

            return view('inventory::facilities.'.$blade_name);
        }

    }

    /**
     * Create i_facility
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('inventory::facilities.'.$blade_name, compact('languages'), []);
    }

    public function createIFacilityModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        return view('inventory::facilities.modals.create', compact('languages'), [])->render();
    }

    public function UpdateIFacilityModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $i_facility = IFacility::find($id);

        $attachments = json_decode(json_encode(MediaResource::collection($i_facility->getMedia(request()->getHttpHost() . ',inventory,facilities,' . $i_facility->id . ',' . 'attachments'))));

        // If i_facility does not exist, return error div
        if (!$i_facility) {
            $error = Lang::get('inventory::inventory.i_facility_not_found_or_you_are_not_authorized_to_edit_the_i_facility');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the languages
        $languages = Language::all();

        return view('inventory::facilities.modals.update', compact('i_facility', 'languages','attachments'), [])->render();
    }
}
