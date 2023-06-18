<?php

namespace Modules\Inventory\Http\Controllers\Actions\Favorites;

use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Inventory\Http\Resources\IUnitResource;
use Modules\Inventory\IUnit;

class GetIFavoritesAction
{
    public function execute()
    {
        // Get use favorite units
        $units_ids = auth()->user()->favorites()->pluck('unit_id')->toArray();

        $favorites = IUnit::whereIn('id', $units_ids)->paginate(8);

        // Transform data
        $favorites =  IUnitResource::collection($favorites);

        // Construct paginator
        $favorites = new LengthAwarePaginator(
            json_decode(json_encode($favorites)),
            $favorites->total(),
            $favorites->perPage(),
            $favorites->currentPage(),
            [
                'path' => \Request::url(),
                'query' => [
                    'page' => $favorites->currentPage()
                ]
            ]
        );
        // Return response
        return $favorites;
    }
}
