<?php

namespace Modules\Inventory\Http\Controllers\Actions\PurposeTypes;

use Modules\Inventory\IPurposeType;
use Modules\Inventory\IPurposeTypeTranslation;
use DB;
use Carbon\Carbon;
use Modules\Inventory\Http\Resources\IPurposeTypeResource;

class CreateIPurposeTypeAction
{
    public function execute(array $data): IPurposeTypeResource
    {
        // Create purpose type
        $i_purpose_type = IPurposeType::create([
            'order' => isset($data['order']) ? $data['order'] : 1,
            'i_purpose_id' => $data['i_purpose_id'],
            'svg' => isset($data['svg']) ? $data['svg'] : null
        ]);

        // Create translations
        for ($i = 0; $i < count($data['translations']); $i++) {
            // To overcome composite primary key laravel insertion issue
            $i_purpose_type_id = $i_purpose_type->id;
            $language_id = $data['translations'][$i]['language_id'];
            $purpose_type = $data['translations'][$i]['purpose_type'];
            $created_at = Carbon::now()->toDateTimeString();

            DB::table('i_purpose_type_trans')->insert([
                'i_purpose_type_id' => $i_purpose_type_id,
                'language_id' => $language_id,
                'purpose_type' => $purpose_type,
                'created_at' => $created_at
            ]);
        }

        // Trigger update event on i_purpose_type to cache its values
        $i_purpose_type->update();

        // Reload the instance
        $i_purpose_type = IPurposeType::find($i_purpose_type->id);

        // Transform the result
        $i_purpose_type = new IPurposeTypeResource($i_purpose_type);

        return $i_purpose_type;
    }
}
