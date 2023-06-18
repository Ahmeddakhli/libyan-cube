<?php

namespace Modules\Inventory\Http\Controllers\Actions\Views;

use Modules\Inventory\IView;
use Modules\Inventory\IViewTranslation;
use DB;
use Carbon\Carbon;
use Modules\Inventory\Http\Resources\IViewResource;

class CreateIViewAction
{
    public function execute(array $data): IViewResource
    {
        // Create view
        $i_view = IView::create([
            'order' => isset($data['order']) ? $data['order'] : 1,
            'color_class' => isset($data['color_class']) ? $data['color_class'] : null
        ]);

        // Create translations
        for ($i = 0; $i < count($data['translations']); $i++) {
            // To overcome composite primary key laravel insertion issue
            $i_view_id = $i_view->id;
            $language_id = $data['translations'][$i]['language_id'];
            $view = $data['translations'][$i]['view'];
            $created_at = Carbon::now()->toDateTimeString();

            DB::table('i_view_trans')->insert([
                'i_view_id' => $i_view_id,
                'language_id' => $language_id,
                'view' => $view,
                'created_at' => $created_at
            ]);
        }

        // Trigger update event on i_view to cache its values
        $i_view->update();

        // Reload the instance
        $i_view = IView::find($i_view->id);

        // Transform the result
        $i_view = new IViewResource($i_view);

        return $i_view;
    }
}
