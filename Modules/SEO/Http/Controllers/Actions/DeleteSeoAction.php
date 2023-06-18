<?php

namespace Modules\SEO\Http\Controllers\Actions;

use Modules\SEO\Seo; 
use DB;
use Carbon\Carbon;


class DeleteSeoAction
{
    public function execute($id)
    {
        // Get the seo
        $seo = Seo::find($id);

        // Delete the translations manually to overcome laravel issue with composite primary key
        $seo_translations = $seo->translations;
        foreach ($seo_translations as $seo_translation) {
            $deleted_at = Carbon::now()->toDateTimeString();
            $seo_id = $seo_translation->seo_id;
            $language_id = $seo_translation->language_id;
            $connection = DB::table('seo_trans')->where('seo_id',$seo_id)->where('language_id',$language_id)->update([
                'deleted_at'=>$deleted_at
            ]);      
        }

        // Delete the seo
        $seo->delete();

        // Return the response
        return null;
    }
}