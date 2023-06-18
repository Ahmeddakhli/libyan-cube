<?php

namespace Modules\Inventory\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Http\Controllers\Actions\PublishTimes\CreateIPublishTimeAction;
use Modules\Inventory\Http\Controllers\Actions\PublishTimes\DeleteIPublishTimeAction;
use Modules\Inventory\Http\Controllers\Actions\PublishTimes\GetIPublishTimesAction;
use Modules\Inventory\Http\Controllers\Actions\PublishTimes\UpdateIPublishTimeAction;
use Modules\Inventory\Http\Requests\PublishTimes\CreateIPublishTimeRequest;
use Modules\Inventory\Http\Requests\PublishTimes\DeleteIPublishTimeRequest;
use Modules\Inventory\Http\Requests\PublishTimes\GetIPublishTimesRequest;
use Modules\Inventory\Http\Requests\PublishTimes\UpdateIPublishTimeRequest;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth;

class IPublishTimesController extends Controller
{
    /**
     * Store i_publish_time
     *
     * @param  [integer] i_unit_id
     * @param  [string] from 
     * @param  [string] to 
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
     * @param  [integer] id
     * @param  [integer] i_uint_id
     * @param  [string] from 
     * @param  [string] to 
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
     * Get i_publish_times
     *
     * @return [json] ServiceResponse object
     */
    public function GetIPublishTimes(GetIPublishTimesRequest $request, GetIPublishTimesAction $action)
    {
        // Get the i_publish_times
        $i_publish_times = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Publish times retrieved successfully';
        $resp->status = true;
        $resp->data = $i_publish_times;
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
}
