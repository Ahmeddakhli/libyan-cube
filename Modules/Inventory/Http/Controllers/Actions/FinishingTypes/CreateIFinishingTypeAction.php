<?php

namespace Modules\Inventory\Http\Controllers\Actions\FinishingTypes;

use Modules\Inventory\IFinishingType;
use Modules\Inventory\IFinishingTypeTranslation;
use DB;
use Carbon\Carbon;
use Modules\Inventory\Http\Resources\IFinishingTypeResource;

class CreateIFinishingTypeAction
{
    public function execute(array $data): IFinishingTypeResource
    {
        // Create finishing type
        $i_finishing_type = IFinishingType::create([
            'order' => isset($data['order']) ? $data['order'] : 1,
            'color_class' => isset($data['color_class']) ? $data['color_class'] : null
        ]);

        // Create translations
        for ($i = 0; $i < count($data['translations']); $i++) {
            // To overcome composite primary key laravel insertion issue
            $i_finishing_type_id = $i_finishing_type->id;
            $language_id = $data['translations'][$i]['language_id'];
            $finishing_type = $data['translations'][$i]['finishing_type'];
            $created_at = Carbon::now()->toDateTimeString();

            DB::table('i_finishing_type_trans')->insert([
                'i_finishing_type_id' => $i_finishing_type_id,
                'language_id' => $language_id,
                'finishing_type' => $finishing_type,
                'created_at' => $created_at
            ]);
        }

        // Trigger update event on i_finishing_type to cache its values
        $i_finishing_type->update();

        // Reload the instance
        $i_finishing_type = IFinishingType::find($i_finishing_type->id);

        // Transform the result
        $i_finishing_type = new IFinishingTypeResource($i_finishing_type);

        return $i_finishing_type;
    }
}
