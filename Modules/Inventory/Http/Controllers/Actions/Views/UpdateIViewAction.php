<?php

namespace Modules\Inventory\Http\Controllers\Actions\Views;

use Modules\Inventory\IView;
use Modules\Inventory\IViewTranslation;
use DB;
use Carbon\Carbon;
use Modules\Inventory\Http\Resources\IViewResource;

class UpdateIViewAction
{
    public function execute($id, array $data): IViewResource
    {
        // Get i_view
        $i_view = IView::find($id);

        // Update/Create translations
        for ($i = 0; $i < count($data['translations']); $i++) {
            // To overcome composite primary key laravel update issue
            $i_view_id = $id;
            $language_id = $data['translations'][$i]['language_id'];
            $view = $data['translations'][$i]['view'];
            $created_at = Carbon::now()->toDateTimeString();
            $updated_at = Carbon::now()->toDateTimeString();


            $connection = DB::table('i_view_trans');

            // Check if translation exists
            $i_view_trnaslation = IViewTranslation::where('i_view_id', $i_view_id)->where('language_id', $language_id)->first();

            if ($i_view_trnaslation) {
                $connection->where('i_view_id', $i_view_id)->where('language_id', $language_id)->update([
                    'view' => $view,
                    'updated_at' => $updated_at
                ]);
            } else {
                $connection = DB::table('i_view_trans')->insert([
                    'i_view_id' => $i_view_id,
                    'language_id' => $language_id,
                    'view' => $view,
                    'created_at' => $created_at
                ]);
            }
        }

        // Update i_view
        $i_view->update([
            'order' => isset($data['order']) ? $data['order'] : 1,
            'color_class' => isset($data['color_class']) ? $data['color_class'] : $i_view->color_class
        ]);

        // Reload the instance
        $i_view = IView::find($i_view->id);

        // Transform the result
        $i_view = new IViewResource($i_view);

        return $i_view;
    }
}
