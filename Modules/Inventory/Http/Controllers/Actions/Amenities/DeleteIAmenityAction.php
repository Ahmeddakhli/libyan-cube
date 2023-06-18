<?php

namespace Modules\Inventory\Http\Controllers\Actions\Amenities;

use Modules\Inventory\IAmenity;
use Modules\Inventory\IAmenityTranslation;
use DB;
use Carbon\Carbon;

class DeleteIAmenityAction
{
    public function execute($id)
    {
        // Get the i_amenity
        $i_amenity = IAmenity::find($id);

        // Delete the translations manually to overcome laravel issue with composite primary key
        $i_amenity_translations = $i_amenity->translations;
        foreach ($i_amenity_translations as $i_amenity_translation) {
            $deleted_at = Carbon::now()->toDateTimeString();
            $i_amenity_id = $i_amenity_translation->i_amenity_id;
            $language_id = $i_amenity_translation->language_id;

            $i_amenity_trans = new IAmenityTranslation;
            $i_amenity_trans->where('i_amenity_id', $i_amenity_id)->where('language_id', $language_id)->update(['deleted_at' => $deleted_at]);
        }

        // Delete i_amenity
        $i_amenity->delete();

        return null;
    }
}
