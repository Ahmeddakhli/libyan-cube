<?php

namespace Modules\Inventory\Http\Controllers\Actions\FurnishingStatuses;

use Modules\Inventory\IFurnishingStatus;
use DB;
use Carbon\Carbon;

class DeleteIFurnishingStatusAction
{
    public function execute($id)
    {
        // Get the i_furnishing_status
        $i_furnishing_status = IFurnishingStatus::find($id);

        // Delete the translations manually to overcome laravel issue with composite primary key
        $i_furnishing_status_translations = $i_furnishing_status->translations;
        foreach ($i_furnishing_status_translations as $i_furnishing_status_translation) {
            $deleted_at = Carbon::now()->toDateTimeString();
            $i_furnishing_status_id = $i_furnishing_status_translation->i_fur_status_id;
            $language_id = $i_furnishing_status_translation->language_id;

            DB::table('i_furnishing_status_trans')->where('i_fur_status_id', $i_furnishing_status_id)->where('language_id', $language_id)->update([
                'deleted_at' => $deleted_at
            ]);
        }

        $i_furnishing_status->delete();

        return null;
    }
}
