<?php

namespace Modules\Inventory\Http\Controllers\Actions\FloorNumbers;

use Modules\Inventory\IFloorNumber;
use DB;
use Carbon\Carbon;

class DeleteIFloorNumberAction
{
    public function execute($id)
    {
        // Get the i_floor_number
        $i_floor_number = IFloorNumber::find($id);

        // Delete the translations manually to overcome laravel issue with composite primary key
        $i_floor_number_translations = $i_floor_number->translations;
        foreach ($i_floor_number_translations as $i_floor_number_translation) {
            $deleted_at = Carbon::now()->toDateTimeString();
            $i_floor_number_id = $i_floor_number_translation->i_floor_number_id;
            $language_id = $i_floor_number_translation->language_id;

            DB::table('i_floor_number_trans')->where('i_floor_number_id', $i_floor_number_id)->where('language_id', $language_id)->update([
                'deleted_at' => $deleted_at
            ]);
        }

        $i_floor_number->delete();

        return null;
    }
}
