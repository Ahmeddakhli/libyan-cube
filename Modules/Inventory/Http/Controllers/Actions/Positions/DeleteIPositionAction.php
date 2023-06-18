<?php

namespace Modules\Inventory\Http\Controllers\Actions\Positions;

use Modules\Inventory\IPosition;
use DB;
use Carbon\Carbon;

class DeleteIPositionAction
{
    public function execute($id)
    {
        // Get the i_position
        $i_position = IPosition::find($id);

        // Delete the translations manually to overcome laravel issue with composite primary key
        $i_position_translations = $i_position->translations;
        foreach ($i_position_translations as $i_position_translation) {
            $deleted_at = Carbon::now()->toDateTimeString();
            $i_position_id = $i_position_translation->i_position_id;
            $language_id = $i_position_translation->language_id;

            DB::table('i_position_trans')->where('i_position_id', $i_position_id)->where('language_id', $language_id)->update([
                'deleted_at' => $deleted_at
            ]);
        }

        $i_position->delete();

        return null;
    }
}
