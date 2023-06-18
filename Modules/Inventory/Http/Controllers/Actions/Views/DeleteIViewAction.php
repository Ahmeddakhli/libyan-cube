<?php

namespace Modules\Inventory\Http\Controllers\Actions\Views;

use Modules\Inventory\IView;
use DB;
use Carbon\Carbon;

class DeleteIViewAction
{
    public function execute($id)
    {
        // Get the i_view
        $i_view = IView::find($id);

        // Delete the translations manually to overcome laravel issue with composite primary key
        $i_view_translations = $i_view->translations;
        foreach ($i_view_translations as $i_view_translation) {
            $deleted_at = Carbon::now()->toDateTimeString();
            $i_view_id = $i_view_translation->i_view_id;
            $language_id = $i_view_translation->language_id;

            DB::table('i_view_trans')->where('i_view_id', $i_view_id)->where('language_id', $language_id)->update([
                'deleted_at' => $deleted_at
            ]);
        }

        $i_view->delete();

        return null;
    }
}
