<?php

namespace Modules\Inventory\Http\Controllers\Actions\OfferingTypes;

use Modules\Inventory\IOfferingType;
use Modules\Inventory\IOfferingTypeTranslation;
use DB;
use Carbon\Carbon;
use Modules\Inventory\Http\Resources\IOfferingTypeResource;

class CreateIOfferingTypeAction
{
    public function execute(array $data): IOfferingTypeResource
    {
        // Create offering type
        $i_offering_type = IOfferingType::create([
            'order' => isset($data['order']) ? $data['order'] : 1,
            'color_class' => isset($data['color_class']) ? $data['color_class'] : null,
            'is_searchable' => isset($data['is_searchable']) ? $data['is_searchable'] : null
        ]);

        // Create translations
        for ($i = 0; $i < count($data['translations']); $i++) {
            // To overcome composite primary key laravel insertion issue
            $i_offering_type_id = $i_offering_type->id;
            $language_id = $data['translations'][$i]['language_id'];
            $offering_type = $data['translations'][$i]['offering_type'];
            $created_at = Carbon::now()->toDateTimeString();

            DB::table('i_offering_type_trans')->insert([
                'i_offering_type_id' => $i_offering_type_id,
                'language_id' => $language_id,
                'offering_type' => $offering_type,
                'created_at' => $created_at
            ]);
        }

        // Trigger update event on i_offering_type to cache its values
        $i_offering_type->update();

        // Reload the instance
        $i_offering_type = IOfferingType::find($i_offering_type->id);

        // Transform the result
        $i_offering_type = new IOfferingTypeResource($i_offering_type);

        return $i_offering_type;
    }
}
