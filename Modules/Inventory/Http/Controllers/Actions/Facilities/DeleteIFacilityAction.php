<?php

namespace Modules\Inventory\Http\Controllers\Actions\Facilities;

use Modules\Inventory\IFacility; 
use DB;
use Carbon\Carbon;

class DeleteIFacilityAction
{

    public function execute($id)
    {
        // Get the i_facility
        $i_facility = IFacility::find($id);
        
        // Delete the translations manually to overcome laravel issue with composite primary key
        $i_facility_translations = $i_facility->translations;
        foreach ($i_facility_translations as $i_facility_translation) {
            $deleted_at = Carbon::now()->toDateTimeString();
            $i_facility_id = $i_facility_translation->i_facility_id;
            $language_id = $i_facility_translation->language_id;

            DB::table('i_facility_trans')->where('i_facility_id',$i_facility_id)->where('language_id',$language_id)->update([
                'deleted_at'=>$deleted_at
            ]);
      
        }

        $i_facility->delete();

        return null;
    }
}