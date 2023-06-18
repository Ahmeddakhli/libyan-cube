<?php

namespace Modules\Inventory\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Inventory\Http\Controllers\Actions\RentalCases\SearchIRentalCasesQueryAction;
use Modules\Inventory\Http\Controllers\Actions\RentalCases\CreateIRentalCaseAction;
use Modules\Inventory\Http\Controllers\Actions\RentalCases\DeleteIRentalCaseAction;
use Modules\Inventory\Http\Controllers\Actions\RentalCases\UpdateIRentalCaseAction;
use Modules\Inventory\Http\Requests\RentalCases\CreateIRentalCaseRequest;
use Modules\Inventory\Http\Requests\RentalCases\DeleteIRentalCaseRequest;
use Modules\Inventory\Http\Requests\RentalCases\UpdateIRentalCaseRequest;
use Modules\Inventory\Http\Resources\IRentalCaseResource;
use Modules\Inventory\IRentalCase;use Modules\Inventory\IUnit;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth, Lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Yajra\Datatables\Datatables;
use App\Language;
use App\Http\Helpers\Utilities;

class IRentalCasesController extends Controller
{
    /**
     * Store i_rental_case
     *
     * @return [json] ServiceResponse object
     */
    public function store(CreateIRentalCaseRequest $request, CreateIRentalCaseAction $action)
    {
        // Create the i_rental_case
        $i_rental_case = $action->execute($request->except([]));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Rental case created successfully';
        $resp->status = true;
        $resp->data = $i_rental_case;
        return response()->json($resp, 200);
    }

    /**
     * Update i_rental_case
     *
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIRentalCaseRequest $request, UpdateIRentalCaseAction $action)
    {
        // Update the i_rental_case
        $i_rental_case = $action->execute($request->input('id'), $request->except(['id']));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Rental case updated successfully';
        $resp->status = true;
        $resp->data = $i_rental_case;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_rental_case
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIRentalCaseRequest $request, DeleteIRentalCaseAction $action)
    {
        // Delete the i_rental_case
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Rental case deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index i_rental_cases
     * @return Response
     */
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the i_rental_cases
            $action = new SearchIRentalCasesQueryAction;
            $i_rental_cases = $action->execute($auth_user, $request);
            $i_rental_cases = $i_rental_cases->with(['editor', 'renter']);

            return Datatables::of($i_rental_cases)
                ->addColumn('from', function($i_rental_case) {
                    return $i_rental_case->from ? Carbon::createFromFormat('Y-m-d H:i:s', $i_rental_case->from)->timezone(auth()->user()?auth()->user()->timezone:'Africa/Cairo')->format('Y-m-d H:i') : null;
                })
                ->addColumn('to', function($i_rental_case) {
                    return $i_rental_case->to ? Carbon::createFromFormat('Y-m-d H:i:s', $i_rental_case->to)->timezone(auth()->user()?auth()->user()->timezone:'Africa/Cairo')->format('Y-m-d H:i') : null;
                })
                ->addColumn('renter_url', function($i_rental_case) {
                    return $i_rental_case->renter ? $i_rental_case->renter->getUrl() : '#';
                })
                ->addColumn('last_updated_at', function($i_rental_case) {
                    return $i_rental_case->updated_at->toDateTimeString();
                })
                ->addColumn('last_updated_by', function($i_rental_case) {
                    return $i_rental_case->editor ? $i_rental_case->editor->full_name : '';
                })
                ->make(true);
        } else {
            $blade_name = ($request->ajax() ? 'index-partial' : 'index'); // Handle Partial Return

            return view('inventory::rental_cases.'.$blade_name, [
                //
            ]);
        }

    }

    public function export(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Search the rental_cases
        $action = new SearchIRentalCasesQueryAction;
        $rental_cases = $action->execute($auth_user, $request);

        $headers =[
            'ID',
            'UNIT_NUMBER',
            'RENTER',
            'FROM',
            'TO',
            'CREATOR',
            'CREATED_AT',
            'LAST_UPDATED_BY',
            'LAST_UPDATED_AT',
            'UNIT_URL'
        ];

        $data = [$headers];

        $rental_cases = $rental_cases->get();

        // Transform the rental_cases
        $rental_cases = json_decode(json_encode(IRentalCaseResource::collection($rental_cases)));

        foreach ($rental_cases as $rental_case) {
            $data[] = [
                $rental_case->id,
                $rental_case->unit ? $rental_case->unit->unit_number : null,
                $rental_case->renter ? $rental_case->renter->full_name : null,
                $rental_case->from,
                $rental_case->to,
                $rental_case->creator ? $rental_case->creator->full_name : null,
                $rental_case->created_at,
                $rental_case->editor ? $rental_case->editor->full_name : null,
                $rental_case->updated_at,
                $i_rental_case->unit ? route('inventory.units.unit', ['id' => $i_rental_case->unit->id]) : '#'
            ];
        }

        $file_name = 'RENTAL CASES ('.Carbon::now().')';
        $sheet_name = 'RENTAL CASES';
        Utilities::export($file_name, $sheet_name, $data);
    }

    // /**
    //  * Create i_rental_case
    //  * @return Response
    //  */
    // public function create(Request $request)
    // {
    //     // Auth user
    //     $auth_user = Auth::user();

    //     $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

    //     return view('inventory::rental_cases.'.$blade_name, [
    //         //
    //     ]);
    // }

    public function createIRentalCaseModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->input('i_unit_id')) {
            $i_unit = IUnit::find($request->input('i_unit_id'));

            return view('inventory::rental_cases.modals.create', [
                'i_unit' => $i_unit
            ])->render();
        }

        return view('inventory::rental_cases.modals.create', [
            //
        ])->render();
    }

    public function UpdateIRentalCaseModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $i_rental_case = IRentalCase::find($id);

        // If i_rental_case does not exist, return error div
        if (!$i_rental_case) {
            $error = Lang::get('inventory::inventory.i_rental_case_not_found_or_you_are_not_authorized_to_edit_the_i_rental_case');
            return view('dashboard.components.error', compact('error'))->render();
        }

        $i_rental_case->load('unit');
        $i_rental_case->load('renter');

        // Transform the from_date
        if ($i_rental_case->from) {
            $i_rental_case->from = Carbon::createFromFormat('Y-m-d H:i:s', $i_rental_case->from)->timezone(auth()->user()?auth()->user()->timezone:'Africa/Cairo')->format('Y-m-d H:i');
        }
        // Transform the to_date
        if ($i_rental_case->to) {
            $i_rental_case->to = Carbon::createFromFormat('Y-m-d H:i:s', $i_rental_case->to)->timezone(auth()->user()?auth()->user()->timezone:'Africa/Cairo')->format('Y-m-d H:i');
        }

        return view('inventory::rental_cases.modals.update', compact('i_rental_case'), [
            //
        ])->render();
    }
}
