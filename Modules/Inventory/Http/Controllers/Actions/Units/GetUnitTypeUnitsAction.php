<?php

namespace Modules\Inventory\Http\Controllers\Actions\Units;

use Cache;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Inventory\Http\Controllers\Actions\Search\UnitSearchAction;
use Modules\Inventory\Http\Resources\IUnitResource;

class GetUnitTypeUnitsAction
{
    public function execute($data)
    {
        // Get Units
        $action = new UnitSearchAction();
        $i_units = $action->execute($data);

        // Paginate result
        $i_units = $i_units->active()->where('i_unit_type_id', $data['id'])->paginate(8);

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
