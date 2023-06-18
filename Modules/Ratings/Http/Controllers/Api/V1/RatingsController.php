<?php

namespace Modules\Ratings\Http\Controllers\Api\V1;

use App\Http\Helpers\ServiceResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Ratings\Http\Controllers\Actions\CreateRatingAction;
use Modules\Ratings\Http\Controllers\Actions\DeleteRatingAction;
use Modules\Ratings\Http\Controllers\Actions\UpdateRatingAction;
use Modules\Ratings\Http\Controllers\Actions\GetRatingsAction;
use Modules\Ratings\Http\Requests\CreateRatingRequest;
use Modules\Ratings\Http\Requests\DeleteRatingRequest;
use Modules\Ratings\Http\Requests\UpdateRatingRequest;

class RatingsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request, GetRatingsAction $action)
    {
        $ratings = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Ratings retrieved successfully';
        $resp->status = true;
        $resp->data = $ratings;
        return response()->json($resp, 200);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(CreateRatingRequest $request, CreateRatingAction $action)
    {
        // Create rating
        $rating = $action->execute($request->all());

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Rating created successfully';
        $resp->status = true;
        $resp->data = $rating;
        return response()->json($resp, 200);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(UpdateRatingRequest $request, UpdateRatingAction $action)
    {
        // Update rating
        $rating = $action->execute($request->id, $request->except('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Rating updated successfully';
        $resp->status = true;
        $resp->data = $rating;
        return response()->json($resp, 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function delete(DeleteRatingRequest $request, DeleteRatingAction $action)
    {
        // Delete rating
        $rating = $action->execute($request->id);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Rating deleted successfully';
        $resp->status = true;
        $resp->data = $rating;
        return response()->json($resp, 200);
    }
}
