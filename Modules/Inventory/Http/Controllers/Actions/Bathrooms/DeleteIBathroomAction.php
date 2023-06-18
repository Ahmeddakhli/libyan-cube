<?php

namespace Modules\Inventory\Http\Controllers\Actions\Bathrooms;

use Modules\Inventory\IBathroom; 
use DB;
use Carbon\Carbon;

class DeleteIBathroomAction
{
    public function execute($id)
    {
        // Get the i_bathroom
        $i_bathroom = IBathroom::find($id);
        
        // Delete the translations manually to overcome laravel issue with composite primary key
        $i_bathroom_translations = $i_bathroom->translations;
        foreach ($i_bathroom_translations as $i_bathroom_translation) {
            $deleted_at = Carbon::now()->toDateTimeString();
            $i_bathroom_id = $i_bathroom_translation->i_bathroom_id;
            $language_id = $i_bathroom_translation->language_id;

           DB::table('i_bathroom_trans')->where('i_bathroom_id',$i_bathroom_id)->where('language_id',$language_id)->update(['deleted_at' => $deleted_at]);
        }

        // Delete i_bathroom
        $i_bathroom->delete();

        return null;
    }
}