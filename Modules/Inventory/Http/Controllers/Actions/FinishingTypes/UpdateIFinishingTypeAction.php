<?php

namespace Modules\Inventory\Http\Controllers\Actions\FinishingTypes;

use Modules\Inventory\IFinishingType;
use Modules\Inventory\IFinishingTypeTranslation;
use DB;
use Carbon\Carbon;
use Modules\Inventory\Http\Resources\IFinishingTypeResource;

class UpdateIFinishingTypeAction
{
    public function execute($id, array $data): IFinishingTypeResource
    {
        // Get i_finishing_type
        $i_finishing_type = IFinishingType::find($id);

        // Update/Create translations
        for ($i = 0; $i < count($data['translations']); $i++) {
            // To overcome composite primary key laravel update issue
            $i_finishing_type_id = $id;
            $language_id = $data['translations'][$i]['language_id'];
            $finishing_type = $data['translations'][$i]['finishing_type'];
            $created_at = Carbon::now()->toDateTimeString();
            $updated_at = Carbon::now()->toDateTimeString();

            // Check if translation exists
            $i_finishing_type_trnaslation = IFinishingTypeTranslation::where('i_finishing_type_id', $i_finishing_type_id)->where('language_id', $language_id)->first();

            if ($i_finishing_type_trnaslation) {
                DB::table('i_finishing_type_trans')->where('i_finishing_type_id', $i_finishing_type_id)->where('language_id', $language_id)->update([
                    'finishing_type' => $finishing_type, 'updated_at' => $updated_at
                ]);
            } else {
                DB::table('i_finishing_type_trans')->insert([
                    'i_finishing_type_id' => $i_finishing_type_id,
                    'language_id' => $language_id,
                    'finishing_type' => $finishing_type,
                    'created_at' => $created_at
                ]);
            }
        }

        // Update i_finishing_type
        $i_finishing_type->update([
            'order' => isset($data['order']) ? $data['order'] : 1,
            'color_class' => isset($data['color_class']) ? $data['color_class'] : $i_finishing_type->color_class
        ]);

        // Reload the instance
        $i_finishing_type = IFinishingType::find($i_finishing_type->id);

        // Transform the result
        $i_finishing_type = new IFinishingTypeResource($i_finishing_type);

        return $i_finishing_type;
    }
}
