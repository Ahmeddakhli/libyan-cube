<?php

namespace Modules\Inventory\Http\Controllers\Actions\Phases;

use Modules\Inventory\IPhase;
use DB;
use Carbon\Carbon;

class DeleteIPhaseAction
{
    public function execute($id)
    {
        // Get the phase
        $i_phase = IPhase::find($id);

        // Delete the translations manually to overcome laravel issue with composite primary key
        $i_phase_translations = $i_phase->translations;
        foreach ($i_phase_translations as $i_phase_translation) {
            $deleted_at = Carbon::now()->toDateTimeString();
            $i_phase_id = $i_phase_translation->phase_id;
            $language_id = $i_phase_translation->language_id;
            DB::table('i_phase_trans')->where('i_phase_id', $i_phase_id)->where('language_id', $language_id)->update([
                'deleted_at' => $deleted_at
            ]);
        }
 
        $i_phase->delete();

        return null;
    }
}
