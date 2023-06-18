<?php

namespace Modules\Ratings\Http\Controllers\Web;

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
        $resp->message = 'Thanks for rating';
        $resp->status = true;
        $resp->data = $rating;
        return response()->json($resp, 200);
    }
}
