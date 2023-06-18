<?php

namespace Modules\Inventory\Http\Controllers\Actions\PurposeTypes;

use Modules\Inventory\IPurposeType;
use Modules\Inventory\IPurposeTypeTranslation;
use DB;
use Carbon\Carbon;
use Modules\Inventory\Http\Resources\IPurposeTypeResource;

class UpdateIPurposeTypeAction
{
    public function execute($id, array $data): IPurposeTypeResource
    {
        // Get i_purpose_type
        $i_purpose_type = IPurposeType::find($id);

        // Update/Create translations
        for ($i = 0; $i < count($data['translations']); $i++) {
            // To overcome composite primary key laravel update issue
            $i_purpose_type_id = $id;
            $language_id = $data['translations'][$i]['language_id'];
            $purpose_type = $data['translations'][$i]['purpose_type'];
            $created_at = Carbon::now()->toDateTimeString();
            $updated_at = Carbon::now()->toDateTimeString();

            // Check if translation exists
            $i_purpose_type_trnaslation = IPurposeTypeTranslation::where('i_purpose_type_id', $i_purpose_type_id)->where('language_id', $language_id)->first();

            if ($i_purpose_type_trnaslation) {
                DB::table('i_purpose_type_trans')->where('i_purpose_type_id', $i_purpose_type_id)->where('language_id', $language_id)->update([
                    'purpose_type' => $purpose_type,
                    'updated_at' => $updated_at
                ]);
            } else {
                DB::table('i_purpose_type_trans')->insert([
                    'i_purpose_type_id' => $i_purpose_type_id,
                    'language_id' => $language_id,
                    'purpose_type' => $purpose_type,
                    'created_at' => $created_at
                ]);
            }
        }

        // Update i_purpose_type
        $i_purpose_type->update([
            'order' => isset($data['order']) ? $data['order'] : 1,
            'i_purpose_id' => $data['i_purpose_id'],
            'svg' => (isset($data['svg']) && !empty($data['svg'])) ? $data['svg'] : null
        ]);

        // Reload the instance
        $i_purpose_type = IPurposeType::find($i_purpose_type->id);

        // Transform the result
        $i_purpose_type = new IPurposeTypeResource($i_purpose_type);

        return $i_purpose_type;
    }
}
