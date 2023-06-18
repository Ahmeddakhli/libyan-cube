<?php

namespace Modules\Settings\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Settings\Http\Controllers\Actions\HowWorks\CreateHowWorkAction;
use Modules\Settings\Http\Controllers\Actions\HowWorks\DeleteHowWorkAction;
use Modules\Settings\Http\Controllers\Actions\HowWorks\GetHowWorksAction;
use Modules\Settings\Http\Controllers\Actions\HowWorks\UpdateHowWorkAction;
use Modules\Settings\Http\Requests\HowWorks\CreateHowWorkRequest;
use Modules\Settings\Http\Requests\HowWorks\DeleteHowWorkRequest;
use Modules\Settings\Http\Requests\HowWorks\UpdateHowWorkRequest;
use App\Http\Helpers\ServiceResponse;

class HowWorksController extends Controller
{
    /**
     * Store how_work
     *
     * @param  [string] link
     * @param  [file] image
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateHowWorkRequest $request, CreateHowWorkAction $action)
    {
        // Create the how_work
        $data = [
            'link' => $request->link,
        ];
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('/how_works', 'public');
        }
        $how_work = $action->execute($data, $request->translations);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Main slider created successfully';
        $resp->status = true;
        $resp->data = $how_work;
        return response()->json($resp, 200);
    }

    /**
     * Update how_work
     *
     * @param  [integer] id
     * @param  [string] link
     * @param  [file] image
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateHowWorkRequest $request, UpdateHowWorkAction $action)
    {
        // Update the how_work
        $data = [
            'link' => $request->link,
        ];
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('/how_works', 'public');
        }
        $how_work = $action->execute($request->input('id'), $data, $request->translations);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Main slider updated successfully';
        $resp->status = true;
        $resp->data = $how_work;
        return response()->json($resp, 200);
    }

    /**
     * Delete how_work
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteHowWorkRequest $request, DeleteHowWorkAction $action)
    {
        // Delete the how_work
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Main slider deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index how_work
     * @return Response
     */
    public function index(Request $request, GetHowWorksAction $action)
    {
        // Get how_work
        $how_works = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Main sliders retrieved successfully';
        $resp->status = true;
        $resp->data = $how_works;
        return response()->json($resp, 200);
    }
}
