<?php

namespace Modules\Inventory\Http\Controllers\Actions\Units;

use Cache;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Inventory\IUnit;
use Modules\Inventory\Http\Resources\IUnitResource;

class GetMyUnitsAction
{
    public function execute()
    {
        // check user
        $id = auth()->check() ? auth()->user()->id : null;

        //  Get units
        $i_units = IUnit::where('created_by', $id)->paginate(8);

        // Paginate result
        $i_units =  IUnitResource::collection($i_units);

        $i_units = new LengthAwarePaginator(
            json_decode(json_encode($i_units)),
            $i_units->total(),
            $i_units->perPage(),
            $i_units->currentPage(),
            [
                'path' => \Request::url(),
                'query' => [
                    'page' => $i_units->currentPage()
                ]
            ]
        );
        return $i_units;
    }
}
