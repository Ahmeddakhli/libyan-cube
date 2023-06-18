<?php

namespace Modules\Inventory\Http\Controllers\Actions\OfferingTypes;

use Modules\Inventory\IOfferingType;
use DB;
use Carbon\Carbon;

class DeleteIOfferingTypeAction
{
    public function execute($id)
    {
        // Get the i_offering_type
        $i_offering_type = IOfferingType::find($id);

        // Delete the translations manually to overcome laravel issue with composite primary key
        $i_offering_type_translations = $i_offering_type->translations;
        foreach ($i_offering_type_translations as $i_offering_type_translation) {
            $deleted_at = Carbon::now()->toDateTimeString();
            $i_offering_type_id = $i_offering_type_translation->i_offering_type_id;
            $language_id = $i_offering_type_translation->language_id;

            DB::table('i_offering_type_trans')->where('i_offering_type_id', $i_offering_type_id)->where('language_id', $language_id)->update(['deleted_at' => $deleted_at]);
        }

        $i_offering_type->delete();

        return null;
    }
}
