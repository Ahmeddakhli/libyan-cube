<?php

namespace Modules\Inventory\Http\Controllers\Actions\AreaUnits;

use Modules\Inventory\IAreaUnit;
use DB;
use Carbon\Carbon;

class DeleteIAreaUnitAction
{
    public function execute($id)
    {
        // Get the i_area_unit
        $i_area_unit = IAreaUnit::find($id);

        // Delete the translations manually to overcome laravel issue with composite primary key
        $i_area_unit_translations = $i_area_unit->translations;
        foreach ($i_area_unit_translations as $i_area_unit_translation) {
            $deleted_at = Carbon::now()->toDateTimeString();
            $i_area_unit_id = $i_area_unit_translation->i_area_unit_id;
            $language_id = $i_area_unit_translation->language_id;
            
            DB::table('i_area_unit_trans')->where('i_area_unit_id', $i_area_unit_id)->where('language_id', $language_id)->update(['deleted_at' => $deleted_at]);
        }

        $i_area_unit->delete();

        return null;
    }
}
