<?php

namespace Modules\Inventory\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Http\Requests\Developers\CreateIDeveloperRequest;
use Modules\Inventory\Http\Requests\Developers\UpdateIDeveloperRequest;
use Modules\Inventory\Http\Requests\Developers\GetIDevelopersRequest;
use Modules\Inventory\Http\Requests\Developers\DeleteIDeveloperRequest;
use Modules\Inventory\Http\Requests\Developers\IDevelopersTagsInputRequest;
use Modules\Inventory\Http\Controllers\Actions\Developers\CreateIDeveloperAction;
use Modules\Inventory\Http\Controllers\Actions\Developers\UpdateIDeveloperAction;
use Modules\Inventory\Http\Controllers\Actions\Developers\GetIDevelopersAction;
use Modules\Inventory\Http\Controllers\Actions\Developers\DeleteIDeveloperAction;
use Modules\Inventory\Http\Controllers\Actions\Developers\SearchIDevelopersQueryAction;
use Modules\Inventory\Http\Controllers\Actions\Developers\IDevelopersTagsInputAction;
use Modules\Inventory\IDeveloper;
use App\Http\Helpers\ServiceResponse;
use App\Http\Resources\MediaResource;
use Carbon\Carbon;
use Auth, Lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Yajra\Datatables\Datatables;
use App\Language;
use Modules\Locations\Http\Controllers\Actions\GetCountriesAction;

class IDevelopersController extends Controller
{

    public function __construct()
    {
        //
    }
    /**
     * Create i_developer
     *
     * @param  [string] developer
     * @return [json] ServiceResponse object
     */
    public function store(CreateIDeveloperRequest $request, CreateIDeveloperAction $action)
    {
        // Create the i_developer

        $i_developer = $action->execute($request->all(), $request->attachments);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'I developer created successfully';
        $resp->status = true;
        switch ($request->creation_type) {
            case 'save_continue':
                $resp->data = ['i_developer' => $i_developer];
                break;
            case 'save_only':
                $resp->data = ['redirect_to' => route('inventory.developers.index'), 'i_developer' => $i_developer];
                break;
            default:
                # code...
                break;
        }
        return response()->json($resp, 200);
    }

    /**
     * Update i_developer
     *
     * @param  [integer] id
     * @param  [string] developer
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIDeveloperRequest $request, UpdateIDeveloperAction $action)
    {
        // Update the i_developer
        $i_developer = $action->execute($request->input('id'), $request->except(['id']), $request->attachments);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'I developer updated successfully';
        $resp->status = true;
        switch ($request->creation_type) {
            case 'save_continue':
                $resp->data = ['i_developer' => $i_developer];
                break;
            case 'save_only':
                $resp->data = ['redirect_to' => route('inventory.developers.index'), 'i_developer' => $i_developer];
                break;
            default:
                # code...
                break;
        }
        return response()->json($resp, 200);
    }

    /**
     * Get i_developers
     *
     * @return [json] ServiceResponse object
     */
    public function GetIDevelopers(GetIDevelopersRequest $request, GetIDevelopersAction $action)
    {
        // Get i_developers
        $i_developers = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'I developers retrieved successfully';
        $resp->status = true;
        $resp->data = $i_developers;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_developer
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIDeveloperRequest $request, DeleteIDeveloperAction $action)
    {
        // Delete the i_developer
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'I developer deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index i_developers
     * @return Response
     */
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the i_developers
            $action = new SearchIDevelopersQueryAction;
            $i_developers = $action->execute($auth_user, $request);
            return Datatables::of($i_developers)
                ->addColumn('value', function ($i_developer) {
                    return $i_developer->value;
                })
                ->filterColumn('value', function ($query, $keyword) {
                    $query->whereHas('translations', function ($translation) use ($keyword) {
                        $translation->where('developer', 'like', '%' . $keyword . '%');
                    });
                })
                ->addColumn('created_at', function ($i_developer) {
                    return $i_developer->created_at ? $i_developer->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function ($i_developer) {
                    return $i_developer->updated_at ? $i_developer->updated_at->toDateTimeString() : null;
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

            return view('inventory::developers.' . $blade_name, []);
        }
    }

    /**
     * Create i_developer
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();
        $languages = Language::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('inventory::developers.' . $blade_name, [
            'languages' => $languages
        ]);
    }

    public function createIDeveloperModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();
        $languages = Language::all();

        // $action = new GetCountriesAction;
        // $countries = json_decode(json_encode($action->execute()));

        return view('inventory::developers.modals.create', compact('languages'), [
        ])->render();
    }

    public function UpdateIDeveloperModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $i_developer = IDeveloper::find($id);
        $languages = Language::all();
        $attachments = MediaResource::collection($i_developer->getMedia(request()->getHttpHost() . ',inventory,developers,' . $i_developer->id . ',' . 'attachments'));

        // If i_developer does not exist, return error div
        if (!$i_developer) {
            $error = Lang::get('inventory::inventory.i_developer_not_found_or_you_are_not_authorized_to_edit_the_i_developer');
            return view('dashboard.components.error', compact('error'))->render();
        }

        $action = new GetCountriesAction;
        $countries = json_decode(json_encode($action->execute()));

        return view('inventory::developers.modals.update', compact('i_developer', 'languages', 'attachments'), [
            'countries' => $countries
        ])->render();
    }

    public function tagsinput(IDevelopersTagsInputRequest $request, IDevelopersTagsInputAction $action)
    {
        // Get the developers
        $developers = $action->execute($request->all());

        return response()->json($developers, 200);
    }
}
