<?php

namespace Modules\Inventory\Http\Controllers\Actions\FinishingTypes;

use Modules\Inventory\IFinishingType;
use DB;
use Carbon\Carbon;

class DeleteIFinishingTypeAction
{
    public function execute($id)
    {
        // Get the i_finishing_type
        $i_finishing_type = IFinishingType::find($id);

        // Delete the translations manually to overcome laravel issue with composite primary key
        $i_finishing_type_translations = $i_finishing_type->translations;
        foreach ($i_finishing_type_translations as $i_finishing_type_translation) {
            $deleted_at = Carbon::now()->toDateTimeString();
            $i_finishing_type_id = $i_finishing_type_translation->i_finishing_type_id;
            $language_id = $i_finishing_type_translation->language_id;

            DB::table('i_finishing_type_trans')->where('i_finishing_type_id', $i_finishing_type_id)->where('language_id', $language_id)->update([
                'deleted_at' => $deleted_at
            ]);
        }

        // Delete  i_finishing_type
        $i_finishing_type->delete();

        return null;
    }
}
