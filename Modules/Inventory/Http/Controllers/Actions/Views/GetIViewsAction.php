<?php

namespace Modules\Inventory\Http\Controllers\Actions\Views;

use Cache;
use Modules\Inventory\IView;
use Modules\Inventory\Http\Resources\IViewResource;
use App;

class GetIViewsAction
{
    public function execute()
    {
        return Cache::rememberForever('inventory_module_views_'.App::getLocale(), function () {
            $i_views = IView::all();

            // Transform the i_views
            $i_views = IViewResource::collection($i_views);

            return $i_views;
        });
    }
}
