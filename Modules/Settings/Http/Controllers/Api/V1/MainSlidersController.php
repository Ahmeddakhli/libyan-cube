<?php

namespace Modules\Settings\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Settings\Http\Controllers\Actions\MainSliders\CreateMainSliderAction;
use Modules\Settings\Http\Controllers\Actions\MainSliders\DeleteMainSliderAction;
use Modules\Settings\Http\Controllers\Actions\MainSliders\GetMainSlidersAction;
use Modules\Settings\Http\Controllers\Actions\MainSliders\UpdateMainSliderAction;
use Modules\Settings\Http\Requests\MainSliders\CreateMainSliderRequest;
use Modules\Settings\Http\Requests\MainSliders\DeleteMainSliderRequest;
use Modules\Settings\Http\Requests\MainSliders\UpdateMainSliderRequest;
use App\Http\Helpers\ServiceResponse;

class MainSlidersController extends Controller
{
    /**
     * Store main_slider
     *
     * @param  [string] link
     * @param  [file] image
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateMainSliderRequest $request, CreateMainSliderAction $action)
    {
        // Create the main_slider
        $data = [
            'link' => $request->link,
        ];
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('/mainsliders', 'public');
        }
        $main_slider = $action->execute($data, $request->translations);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Main slider created successfully';
        $resp->status = true;
        $resp->data = $main_slider;
        return response()->json($resp, 200);
    }

    /**
     * Update main_slider
     *
     * @param  [integer] id
     * @param  [string] link
     * @param  [file] image
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateMainSliderRequest $request, UpdateMainSliderAction $action)
    {
        // Update the main_slider
        $data = [
            'link' => $request->link,
        ];
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('/mainsliders', 'public');
        }
        $main_slider = $action->execute($request->input('id'), $data, $request->translations);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Main slider updated successfully';
        $resp->status = true;
        $resp->data = $main_slider;
        return response()->json($resp, 200);
    }

    /**
     * Delete main_slider
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteMainSliderRequest $request, DeleteMainSliderAction $action)
    {
        // Delete the main_slider
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Main slider deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index main_slider
     * @return Response
     */
    public function index(Request $request, GetMainSlidersAction $action)
    {
        // Get main_slider
        $main_sliders = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Main sliders retrieved successfully';
        $resp->status = true;
        $resp->data = $main_sliders;
        return response()->json($resp, 200);
    }
}
