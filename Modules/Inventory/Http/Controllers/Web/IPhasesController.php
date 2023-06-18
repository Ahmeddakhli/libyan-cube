<?php

namespace Modules\Inventory\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Inventory\Http\Controllers\Actions\Phases\SearchIPhasesQueryAction;
use Modules\Inventory\Http\Controllers\Actions\Phases\CreateIPhaseAction;
use Modules\Inventory\Http\Controllers\Actions\Phases\DeleteIPhaseAction;
use Modules\Inventory\Http\Controllers\Actions\Phases\UpdateIPhaseAction;
use Modules\Inventory\Http\Requests\Phases\CreateIPhaseRequest;
use Modules\Inventory\Http\Requests\Phases\DeleteIPhaseRequest;
use Modules\Inventory\Http\Requests\Phases\UpdateIPhaseRequest;
use Modules\Inventory\IPhase;
use Modules\Inventory\IProject;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth, Lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Yajra\Datatables\Datatables;
use App\Language;

class IPhasesController extends Controller
{
    /**
     * Store i_phase
     *
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateIPhaseRequest $request, CreateIPhaseAction $action)
    {
        // Create the i_phase
        $i_phase = $action->execute($request->except(['attachments'], $request->attachments));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Phase created successfully';
        $resp->status = true;
        $resp->data = $i_phase;
        return response()->json($resp, 200);
    }

    /**
     * Update i_phase
     *
     * @param  [integer] id
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIPhaseRequest $request, UpdateIPhaseAction $action)
    {
        // Update the i_phase
        $i_phase = $action->execute($request->input('id'), $request->except(['id', 'attachments']), $request->attachments);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Phase updated successfully';
        $resp->status = true;
        $resp->data = $i_phase;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_phase
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIPhaseRequest $request, DeleteIPhaseAction $action)
    {
        // Delete the i_phase
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Phase deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index phases
     * @return Response
     */
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the phases
            $action = new SearchIPhasesQueryAction;
            $phases = $action->execute($auth_user, $request);
            return Datatables::of($phases)
                ->addColumn('value', function ($i_phase) {
                    return $i_phase->value;
                })
                ->filterColumn('value', function($query, $keyword) {
                    $query->whereHas('translations', function($translation) use ($keyword) {
                        $translation->where('name', 'like', '%'.$keyword.'%');
                    });
                })
                ->addColumn('created_at', function ($i_phase) {
                    return $i_phase->created_at ? $i_phase->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function ($i_phase) {
                    return $i_phase->updated_at ? $i_phase->updated_at->toDateTimeString() : null;
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

            return view('inventory::phases.' . $blade_name);
        }
    }

    /**
     * Create i_phase
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('inventory::phases.' . $blade_name, compact('languages'), []);
    }

    public function createPhaseModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        // Get the projects
        $projects = IProject::all();

        return view('inventory::phases.modals.create', compact('languages', 'projects'), [])->render();
    }

    public function UpdatePhaseModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the i_phase
        $i_phase = IPhase::find($id);

        // If i_phase does not exist, return error div
        if (!$i_phase) {
            $error = Lang::get('inventory::inventory.phase_not_found_or_you_are_not_authorized_to_edit_the_phase');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the languages
        $languages = Language::all();
        $projects = IProject::all();

        return view('inventory::phases.modals.update', compact('i_phase', 'languages', 'projects'), [])->render();
    }
}
