<?php

namespace Modules\Services\Http\Controllers\Actions\Services;

use Modules\Services\Service; 
use DB;
use Carbon\Carbon;

class DeleteServiceAction
{
    public function execute($id)
    {
        // Get the service
        $service = Service::find($id);

        // Delete the translations manually to overcome laravel issue with composite primary key
        $service_translations = $service->translations;
        foreach ($service_translations as $service_translation) {
            $deleted_at = Carbon::now()->toDateTimeString();

            $service_id = $service_translation->service_id;
            $language_id = $service_translation->language_id;

            // Delete the translation
            $connection = DB::table('service_trans')->where('service_id',$service_id)->where('language_id',$language_id)->update([
                'deleted_at'=>$deleted_at
            ]);
        }

        // Delete the service
        $service->delete();

        // Return the result
        return null;
    }
}