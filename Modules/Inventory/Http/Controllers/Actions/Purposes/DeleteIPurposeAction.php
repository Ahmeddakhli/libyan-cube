<?php

namespace Modules\Inventory\Http\Controllers\Actions\Purposes;

use Modules\Inventory\IPurpose;
use DB;
use Carbon\Carbon;

class DeleteIPurposeAction
{
    public function execute($id)
    {
        // Get the i_purpose
        $i_purpose = IPurpose::find($id);

        // Delete the translations manually to overcome laravel issue with composite primary key
        $i_purpose_translations = $i_purpose->translations;
        foreach ($i_purpose_translations as $i_purpose_translation) {
            $deleted_at = Carbon::now()->toDateTimeString();
            $i_purpose_id = $i_purpose_translation->i_purpose_id;
            $language_id = $i_purpose_translation->language_id;

            DB::table('i_purpose_trans')->where('i_purpose_id', $i_purpose_id)->where('language_id', $language_id)->update([
                'deleted_at' => $deleted_at
            ]);
        }

        $i_purpose->delete();

        return null;
    }
}
