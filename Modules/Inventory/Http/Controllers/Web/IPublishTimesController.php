<?php

namespace Modules\Inventory\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Inventory\Http\Controllers\Actions\PublishTimes\SearchIPublishTimesQueryAction;
use Modules\Inventory\Http\Controllers\Actions\PublishTimes\CreateIPublishTimeAction;
use Modules\Inventory\Http\Controllers\Actions\PublishTimes\DeleteIPublishTimeAction;
use Modules\Inventory\Http\Controllers\Actions\PublishTimes\UpdateIPublishTimeAction;
use Modules\Inventory\Http\Requests\PublishTimes\CreateIPublishTimeRequest;
use Modules\Inventory\Http\Requests\PublishTimes\DeleteIPublishTimeRequest;
use Modules\Inventory\Http\Requests\PublishTimes\UpdateIPublishTimeRequest;
use Modules\Inventory\Http\Resources\IPublishTimeResource;
use Modules\Inventory\IPublishTime;
use Modules\Inventory\IUnit;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth, Lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Yajra\Datatables\Datatables;
use App\Language;
use App\Http\Helpers\Utilities;

class IPublishTimesController extends Controller
{
    /**
     * Store i_publish_time
     *
     * @return [json] ServiceResponse object
     */
    public function store(CreateIPublishTimeRequest $request, CreateIPublishTimeAction $action)
    {
        // Create the i_publish_time
        $i_publish_time = $action->execute($request->except([]));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Publish time created successfully';
        $resp->status = true;
        $resp->data = $i_publish_time;
        return response()->json($resp, 200);
    }

    /**
     * Update i_publish_time
     *
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIPublishTimeRequest $request, UpdateIPublishTimeAction $action)
    {
        // Update the i_publish_time
        $i_publish_time = $action->execute($request->input('id'), $request->except(['id']));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Publish time updated successfully';
        $resp->status = true;
        $resp->data = $i_publish_time;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_publish_time
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIPublishTimeRequest $request, DeleteIPublishTimeAction $action)
    {
        // Delete the i_publish_time
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Publish time deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index i_publish_times
     * @return Response
     */
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the i_publish_times
            $action = new SearchIPublishTimesQueryAction;
            $i_publish_times = $action->execute($auth_user, $request);
            // $i_publish_times = $i_publish_times->with(['unit', 'creator']);
            $i_publish_times = $i_publish_times->with(['creator']);

            return Datatables::of($i_publish_times)
                ->addColumn('from', function($i_publish_time) {
                    return $i_publish_time->from ? Carbon::createFromFormat('Y-m-d H:i:s', $i_publish_time->from)->timezone(auth()->user()?auth()->user()->timezone:'Africa/Cairo')->format('Y-m-d H:i') : null;
                })
                ->addColumn('to', function($i_publish_time) {
                    return $i_publish_time->to ? Carbon::createFromFormat('Y-m-d H:i:s', $i_publish_time->to)->timezone(auth()->user()?auth()->user()->timezone:'Africa/Cairo')->format('Y-m-d H:i') : null;
                })
                // ->addColumn('unit_number', function($i_publish_time) {
                //     return $i_publish_time->unit ? $i_publish_time->unit->unit_number : '';
                // })
                // ->addColumn('unit_url', function($i_publish_time) {
                //     return $i_publish_time->unit ? route('inventory.units.unit', ['id' => $i_publish_time->unit->id]) : '#';
                // })
                ->addColumn('publisher', function($i_publish_time) {
                    return $i_publish_time->creator ? $i_publish_time->creator->full_name : '';
                })
                ->addColumn('created_at', function($i_publish_time) {
                    return $i_publish_time->created_at ? $i_publish_time->created_at->toDateTimeString() : null;
                })
                // ->addColumn('last_updated_at', function($i_publish_time) {
                //     return $i_publish_time->updated_at->toDateTimeString();
                // })
                ->orderColumn('created_at', function ($query, $order) {
                    return  $query->orderBy('created_at', $order);
                })
                // ->orderColumn('last_updated_at', function ($query, $order) {
                //     return  $query->orderBy('updated_at', $order);
                // })
                ->make(true);
        } else {
            $blade_name = ($request->ajax() ? 'index-partial' : 'index'); // Handle Partial Return

            return view('inventory::publish_times.'.$blade_name, [
                //
            ]);
        }

    }

    public function export(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Search the publish_times
        $action = new SearchIPublishTimesQueryAction;
        $publish_times = $action->execute($auth_user, $request);

        $headers =[
            'ID',
            'UNIT_NUMBER',
            'FROM',
            'TO',
            'PUBLISHER',
            'CREATED_AT',
            'LAST_UPDATED_BY',
            'LAST_UPDATED_AT',
            'UNIT_URL'
        ];

        $data = [$headers];

        $publish_times = $publish_times->get();

        // Transform the publish_times
        $publish_times = json_decode(json_encode(IPublishTimeResource::collection($publish_times)));

        foreach ($publish_times as $publish_time) {
            $data[] = [
                $publish_time->id,
                $publish_time->unit ? $publish_time->unit->unit_number : null,
                $publish_time->from,
                $publish_time->to,
                $publish_time->creator ? $publish_time->creator->full_name : null,
                $publish_time->created_at,
                $publish_time->editor ? $publish_time->editor->full_name : null,
                $publish_time->updated_at,
                $i_publish_time->unit ? route('inventory.units.unit', ['id' => $i_publish_time->unit->id]) : '#'
            ];
        }

        $file_name = 'PUBLISH TIMES ('.Carbon::now().')';
        $sheet_name = 'PUBLISH TIMES';
        Utilities::export($file_name, $sheet_name, $data);
    }

    // /**
    //  * Create i_publish_time
    //  * @return Response
    //  */
    // public function create(Request $request)
    // {
    //     // Auth user
    //     $auth_user = Auth::user();

    //     $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

    //     return view('inventory::publish_times.'.$blade_name, [
    //         //
    //     ]);
    // }

    public function createIPublishTimeModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->input('i_unit_id')) {
            $i_unit = IUnit::find($request->input('i_unit_id'));

            return view('inventory::publish_times.modals.create', [
                'i_unit' => $i_unit
            ])->render();
        }

        return view('inventory::publish_times.modals.create', [
            //
        ])->render();
    }

    public function UpdateIPublishTimeModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $i_publish_time = IPublishTime::find($id);

        // If i_publish_time does not exist, return error div
        if (!$i_publish_time) {
            $error = Lang::get('inventory::inventory.i_publish_time_not_found_or_you_are_not_authorized_to_edit_the_i_publish_time');
            return view('dashboard.components.error', compact('error'))->render();
        }

        $i_publish_time->load('unit');

        // Transform the from_date
        if ($i_publish_time->from) {
            $i_publish_time->from = Carbon::createFromFormat('Y-m-d H:i:s', $i_publish_time->from)->timezone(auth()->user()?auth()->user()->timezone:'Africa/Cairo')->format('Y-m-d H:i');
        }
        // Transform the to_date
        if ($i_publish_time->to) {
            $i_publish_time->to = Carbon::createFromFormat('Y-m-d H:i:s', $i_publish_time->to)->timezone(auth()->user()?auth()->user()->timezone:'Africa/Cairo')->format('Y-m-d H:i');
        }

        return view('inventory::publish_times.modals.update', compact('i_publish_time'), [
            //
        ])->render();
    }
}
