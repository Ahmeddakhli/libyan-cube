<?php

namespace Modules\Inventory\Http\Controllers\Actions\Developers;

use Modules\Inventory\IDeveloper;
use Carbon\Carbon;
use DB;

class DeleteIDeveloperAction
{
    public function execute($id)
    {
        // Get the i_developer
        $i_developer = IDeveloper::find($id);

        // Delete the translations manually to overcome laravel issue with composite primary key
        $i_developer_translations = $i_developer->translations;
        foreach ($i_developer_translations as $i_developer_translation) {
            $deleted_at = Carbon::now()->toDateTimeString();
            $i_developer_id = $i_developer_translation->i_developer_id;
            $language_id = $i_developer_translation->language_id;

            DB::table('i_developer_trans')->where('i_developer_id', $i_developer_id)->where('language_id', $language_id)->update([
                'deleted_at' => $deleted_at
            ]);
        }

        // Delete the i_developer
        $i_developer->delete();

        // Return the response
        return null;
    }
}