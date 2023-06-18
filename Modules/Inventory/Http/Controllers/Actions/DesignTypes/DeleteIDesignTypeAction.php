<?php

namespace Modules\Inventory\Http\Controllers\Actions\DesignTypes;

use Modules\Inventory\IDesignType;
use DB;
use Carbon\Carbon;

class DeleteIDesignTypeAction
{

    public function execute($id)
    {
        // Get the design type
        $i_design_type = IDesignType::find($id);

        // Delete the translations manually to overcome laravel issue with composite primary key
        $i_design_type_translations = $i_design_type->translations;
        foreach ($i_design_type_translations as $i_design_type_translation) {
            $deleted_at = Carbon::now()->toDateTimeString();
            $i_design_type_id = $i_design_type_translation->i_design_type_id;
            $language_id = $i_design_type_translation->language_id;

            DB::table('i_design_type_trans')->where('i_design_type_id', $i_design_type_id)->where('language_id', $language_id)->update([
                'deleted_at' => $deleted_at
            ]);
        }

        // Delete design type
        $i_design_type->delete();

        return null;
    }
}
