<?php

namespace Modules\Inventory\Http\Controllers\Actions\Units;

use Cache, DB;

class GetUnitPricesListAction
{
    public function execute()
    {
      return[ 
        'projects' => DB::table('i_projects')->select(\DB::raw('MIN(price_from) AS minPrice, MAX(price_to) AS maxPrice, MIN(area_from) AS minArea, MAX(area_to) AS maxArea'))->whereNull('deleted_at')->get()->toArray(),
        'units' => DB::table('i_units')->select('price','area')->whereNull('deleted_at')->get()->toArray()
      ];

    }
}
