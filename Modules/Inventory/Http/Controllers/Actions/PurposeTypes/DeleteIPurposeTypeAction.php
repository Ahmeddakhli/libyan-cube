<?php

namespace Modules\Inventory\Http\Controllers\Actions\PurposeTypes;

use Modules\Inventory\IPurposeType;
use DB;
use Carbon\Carbon;

class DeleteIPurposeTypeAction
{
    public function execute($id)
    {
        // Get the i_purpose_type
        $i_purpose_type = IPurposeType::find($id);

        // Delete the translations manually to overcome laravel issue with composite primary key
        $i_purpose_type_translations = $i_purpose_type->translations;
        foreach ($i_purpose_type_translations as $i_purpose_type_translation) {
            $deleted_at = Carbon::now()->toDateTimeString();
            $i_purpose_type_id = $i_purpose_type_translation->i_purpose_type_id;
            $language_id = $i_purpose_type_translation->language_id;

            DB::table('i_purpose_type_trans')->where('i_purpose_type_id', $i_purpose_type_id)->where('language_id', $language_id)->update([
                'deleted_at' => $deleted_at
            ]);
        }

        $i_purpose_type->delete();

        return null;
    }
}
