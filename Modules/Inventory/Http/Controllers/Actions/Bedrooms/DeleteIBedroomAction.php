<?php

namespace Modules\Inventory\Http\Controllers\Actions\Bedrooms;

use Modules\Inventory\IBedroom;
use DB;
use Carbon\Carbon;

class DeleteIBedroomAction
{
    public function execute($id)
    {
        // Get the i_bedroom
        $i_bedroom = IBedroom::find($id);

        // Delete the translations manually to overcome laravel issue with composite primary key
        $i_bedroom_translations = $i_bedroom->translations;
        foreach ($i_bedroom_translations as $i_bedroom_translation) {
            $deleted_at = Carbon::now()->toDateTimeString();
            $i_bedroom_id = $i_bedroom_translation->i_bedroom_id;
            $language_id = $i_bedroom_translation->language_id;

            DB::table('i_bedroom_trans')->where('i_bedroom_id', $i_bedroom_id)->where('language_id', $language_id)->update([
                'deleted_at' => $deleted_at
            ]);
        }

        // Delete i_bedroom
        $i_bedroom->delete();

        return null;
    }
}
