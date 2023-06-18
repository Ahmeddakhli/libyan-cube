<?php

namespace Modules\Inventory\Http\Controllers\Actions\AreaUnits;

use Modules\Inventory\IAreaUnit;
use Modules\Inventory\IAreaUnitTranslation;
use DB;
use Carbon\Carbon;
use Modules\Inventory\Http\Resources\IAreaUnitResource;

class UpdateIAreaUnitAction
{
    public function execute($id, array $data): IAreaUnitResource
    {
        // Get i_area_unit
        $i_area_unit = IAreaUnit::find($id);

        // Update/Create translations
        for ($i = 0; $i < count($data['translations']); $i++) {
            // To overcome composite primary key laravel update issue
            $i_area_unit_id = $id;
            $language_id = $data['translations'][$i]['language_id'];
            $area_unit = $data['translations'][$i]['area_unit'];
            $created_at = Carbon::now()->toDateTimeString();
            $updated_at = Carbon::now()->toDateTimeString();

            // Check if translation exists
            $i_area_unit_trnaslation = IAreaUnitTranslation::where('i_area_unit_id', $i_area_unit_id)->where('language_id', $language_id)->first();
            if ($i_area_unit_trnaslation) {
                DB::table('i_area_unit_trans')->where('i_area_unit_id', $i_area_unit_id)->where('language_id', $language_id)->update([
                    'area_unit' => $area_unit,
                    'updated_at' => $updated_at
                ]);
            } else {
                DB::table('i_area_unit_trans')->insert([
                    'i_area_unit_id' => $i_area_unit_id,
                    'language_id' => $language_id,
                    'area_unit' => $area_unit,
                    'created_at' => $created_at
                ]);
            }
        }

        // Update i_area_unit
        $i_area_unit->update([
            'order' => isset($data['order']) ? $data['order'] : 1,
            'color_class' => isset($data['color_class']) ? $data['color_class'] : $i_area_unit->color_class
        ]);

        // Reload the instance
        $i_area_unit = IAreaUnit::find($i_area_unit->id);

        // Transform the result
        $i_area_unit = new IAreaUnitResource($i_area_unit);

        return $i_area_unit;
    }
}
