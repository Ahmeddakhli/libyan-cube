<?php

namespace Modules\Inventory\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Inventory\Http\Controllers\Actions\DesignTypes\SearchIDesignTypesQueryAction;
use Modules\Inventory\Http\Controllers\Actions\DesignTypes\CreateIDesignTypeAction;
use Modules\Inventory\Http\Controllers\Actions\DesignTypes\DeleteIDesignTypeAction;
use Modules\Inventory\Http\Controllers\Actions\DesignTypes\UpdateIDesignTypeAction;
use Modules\Inventory\Http\Requests\DesignTypes\CreateIDesignTypeRequest;
use Modules\Inventory\Http\Requests\DesignTypes\DeleteIDesignTypeRequest;
use Modules\Inventory\Http\Requests\DesignTypes\UpdateIDesignTypeRequest;
use Modules\Inventory\Http\Resources\IDesignTypeResource;
use Modules\Inventory\IDesignType;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth, Lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Yajra\Datatables\Datatables;
use App\Language;
use App\Http\Resources\MediaResource;

class IDesignTypesController extends Controller
{
    /**
     * Store i_design_type
     *
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateIDesignTypeRequest $request, CreateIDesignTypeAction $action)
    {
        // Create the i_design_type
        $i_design_type = $action->execute($request->except(['attachments']), $request->attachments);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Design type created successfully';
        $resp->status = true;
        $resp->data = $i_design_type;
        return response()->json($resp, 200);
    }

    /**
     * Update i_design_type
     *
     * @param  [integer] id
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIDesignTypeRequest $request, UpdateIDesignTypeAction $action)
    {
        // Update the i_design_type
        $i_design_type = $action->execute($request->input('id', 'attachments'), $request->except(['id']), $request->attachments);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Design type updated successfully';
        $resp->status = true;
        $resp->data = $i_design_type;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_design_type
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIDesignTypeRequest $request, DeleteIDesignTypeAction $action)
    {
        // Delete the i_design_type
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Design type deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index i_design_types
     * @return Response
     */
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the i_design_types
            $action = new SearchIDesignTypesQueryAction;
            $i_design_types = $action->execute($auth_user, $request);
            return Datatables::of($i_design_types)
                ->addColumn('value', function ($i_design_type) {
                    return $i_design_type->value;
                })
                ->filterColumn('value', function ($query, $keyword) {
                    $query->whereHas('translations', function ($translation) use ($keyword) {
                        $translation->where('type', 'like', '%' . $keyword . '%');
                    });
                })
                ->addColumn('created_at', function ($i_design_type) {
                    return $i_design_type->created_at ? $i_design_type->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function ($i_design_type) {
                    return $i_design_type->updated_at ? $i_design_type->updated_at->toDateTimeString() : null;
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

            return view('inventory::design_types.' . $blade_name);
        }
    }

    /**
     * Create i_design_type
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('inventory::design_types.' . $blade_name, compact('languages'), []);
    }

    public function createIDesignTypeModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        return view('inventory::design_types.modals.create', compact('languages'), [])->render();
    }

    public function UpdateIDesignTypeModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $i_design_type = IDesignType::find($id);
        $attachments = json_decode(json_encode(MediaResource::collection($i_design_type->getMedia(request()->getHttpHost() . ',inventory,design_types,' . $i_design_type->id . ',' . 'attachments'))));

        // If i_design_type does not exist, return error div
        if (!$i_design_type) {
            $error = Lang::get('inventory::inventory.i_design_type_not_found_or_you_are_not_authorized_to_edit_the_i_design_type');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the languages
        $languages = Language::all();

        return view('inventory::design_types.modals.update', compact('i_design_type', 'languages', 'attachments'), [])->render();
    }
}
