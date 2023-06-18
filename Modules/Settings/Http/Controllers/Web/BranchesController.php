<?php

namespace Modules\Settings\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Settings\Http\Controllers\Actions\Branches\SearchBranchesQueryAction;
use Modules\Settings\Http\Controllers\Actions\Branches\CreateBranchAction;
use Modules\Settings\Http\Controllers\Actions\Branches\DeleteBranchAction;
use Modules\Settings\Http\Controllers\Actions\Branches\UpdateBranchAction;
use Modules\Settings\Http\Requests\Branches\CreateBranchRequest;
use Modules\Settings\Http\Requests\Branches\DeleteBranchRequest;
use Modules\Settings\Http\Requests\Branches\UpdateBranchRequest;
use Modules\Settings\Branch;
use App\Http\Helpers\ServiceResponse;
use Auth, Lang;
use Yajra\Datatables\Datatables;

class BranchesController extends Controller
{
    /**
     * Store branch
     *
     * @param  [string] branch
     * @param  [string] latitude
     * @param  [string] longitude 
     * @return [json] ServiceResponse object
     */
    public function store(CreateBranchRequest $request, CreateBranchAction $action)
    {
        // Create the branch
        $branch = $action->execute($request->all());

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Branch created successfully';
        $resp->status = true;
        $resp->data = $branch;
        return response()->json($resp, 200);
    }

    /**
     * Update branch
     *
     * @param  [integer] id
     * @param  [string] branch
     * @param  [string] latitude
     * @param  [string] longitude 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateBranchRequest $request, UpdateBranchAction $action)
    {
        // Update the branch
        $branch = $action->execute($request->input('id'), $request->except('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Branch updated successfully';
        $resp->status = true;
        $resp->data = $branch;
        return response()->json($resp, 200);
    }

    /**
     * Delete branch
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteBranchRequest $request, DeleteBranchAction $action)
    {
        // Delete the branch
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Branch deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index branches
     * @return Response
     */
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the branches
            $action = new SearchBranchesQueryAction;
            $branches = $action->execute($auth_user, $request);
            
            return Datatables::of($branches)
                ->addColumn('created_at', function ($branch) {
                    return $branch->created_at ? $branch->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function ($branch) {
                    return $branch->updated_at ? $branch->updated_at->toDateTimeString() : null;
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

            return view('settings::branches.' . $blade_name);
        }
    }

    /**
     * Create branch
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('settings::branches.' . $blade_name, []);
    }

    public function createBranchModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        return view('settings::branches.modals.create', [])->render();
    }

    public function updateBranchModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $branch = Branch::find($id);

        // If branch does not exist, return error div
        if (!$branch) {
            $error = Lang::get('settings::settings.branch_not_found_or_you_are_not_authorized_to_edit_the_branch');
            return view('dashboard.components.error', compact('error'))->render();
        }

        return view('settings::branches.modals.update', compact('branch'), [])->render();
    }
}
