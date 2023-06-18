<?php

namespace Modules\Inventory\Http\Controllers\Actions\OfferingTypes;

use Modules\Inventory\IOfferingType;
use Modules\Inventory\IOfferingTypeTranslation;
use DB;
use Carbon\Carbon;
use Modules\Inventory\Http\Resources\IOfferingTypeResource;

class UpdateIOfferingTypeAction
{
    public function execute($id, array $data): IOfferingTypeResource
    {
        // Get i_offering_type
        $i_offering_type = IOfferingType::find($id);

        // Update/Create translations
        for ($i = 0; $i < count($data['translations']); $i++) {
            // To overcome composite primary key laravel update issue
            $i_offering_type_id = $id;
            $language_id = $data['translations'][$i]['language_id'];
            $offering_type = $data['translations'][$i]['offering_type'];
            $created_at = Carbon::now()->toDateTimeString();
            $updated_at = Carbon::now()->toDateTimeString();

            // Check if translation exists
            $i_offering_type_trnaslation = IOfferingTypeTranslation::where('i_offering_type_id', $i_offering_type_id)->where('language_id', $language_id)->first();

            if ($i_offering_type_trnaslation) {
                DB::table('i_offering_type_trans')->where('i_offering_type_id', $i_offering_type_id)->where('language_id', $language_id)->update([
                    'offering_type' => $offering_type,
                    'updated_at' => $updated_at
                ]);
            } else {
                DB::table('i_offering_type_trans')->insert([
                    'i_offering_type_id' => $i_offering_type_id,
                    'language_id' => $language_id,
                    'offering_type' => $offering_type,
                    'created_at' => $created_at
                ]);
            }
        }

        // Update i_offering_type
        $i_offering_type->update([
            'order' => isset($data['order']) ? $data['order'] : 1,
            'color_class' => isset($data['color_class']) ? $data['color_class'] : $i_offering_type->color_class,
            'is_searchable' => isset($data['is_searchable']) ? $data['is_searchable'] : null
        ]);

        // Reload the instance
        $i_offering_type = IOfferingType::find($i_offering_type->id);

        // Transform the result
        $i_offering_type = new IOfferingTypeResource($i_offering_type);

        return $i_offering_type;
    }
}
