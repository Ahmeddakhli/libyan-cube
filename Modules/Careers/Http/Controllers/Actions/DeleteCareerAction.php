<?php

namespace Modules\Careers\Http\Controllers\Actions;

use Modules\Careers\Career; 
use DB;
use Carbon\Carbon;


class DeleteCareerAction
{
    public function execute($id)
    {
        // Get the career
        $career = Career::find($id);

        // Delete the translations manually to overcome laravel issue with composite primary key
        $career_translations = $career->translations;
        foreach ($career_translations as $career_translation) {
            $deleted_at = Carbon::now()->toDateTimeString();
            $career_id = $career_translation->career_id;
            $language_id = $career_translation->language_id;
            $connection = DB::table('career_trans')->where('career_id',$career_id)->where('language_id',$language_id)->update([
                'deleted_at'=>$deleted_at
            ]);      
        }

        // Delete the career
        $career->delete();

        // Return the response
        return null;
    }
}