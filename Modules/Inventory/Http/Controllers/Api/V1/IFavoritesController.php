<?php

namespace Modules\Inventory\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Helpers\ServiceResponse;
use Modules\Inventory\Http\Controllers\Actions\Favorites\FavoriteIUnitAction;
use Modules\Inventory\Http\Controllers\Actions\Favorites\UnFavoriteIUnitAction;
use Modules\Inventory\Http\Requests\Favorites\FavoriteIUnitRequest;
use Modules\Inventory\Http\Requests\Favorites\UnFavoriteIUnitRequest;

class IFavoritesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FavoriteIUnitRequest $request, FavoriteIUnitAction $action)
    {
        $response = $action->execute($request->all());

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = $response;
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(UnFavoriteIUnitRequest $request, UnFavoriteIUnitAction $action)
    {
        $response = $action->execute($request->all());

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = $response;
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }
}
