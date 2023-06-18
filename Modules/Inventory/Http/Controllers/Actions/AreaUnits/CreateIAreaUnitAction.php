<?php

namespace Modules\Inventory\Http\Controllers\Actions\AreaUnits;

use Modules\Inventory\IAreaUnit;
use Modules\Inventory\IAreaUnitTranslation;
use DB;
use Carbon\Carbon;
use Modules\Inventory\Http\Resources\IAreaUnitResource;

class CreateIAreaUnitAction
{
    public function execute(array $data): IAreaUnitResource
    {
        // Create area unit
        $i_area_unit = IAreaUnit::create([
            'order' => isset($data['order']) ? $data['order'] : 1,
            'color_class' => isset($data['color_class']) ? $data['color_class'] : null
        ]);

        // Create translations
        for ($i = 0; $i < count($data['translations']); $i++) {
            // To overcome composite primary key laravel insertion issue
            $i_area_unit_id = $i_area_unit->id;
            $language_id = $data['translations'][$i]['language_id'];
            $area_unit = $data['translations'][$i]['area_unit'];
            $created_at = Carbon::now()->toDateTimeString();
            
            DB::table('i_area_unit_trans')->insert([
                'i_area_unit_id' => $i_area_unit_id,
                'language_id' => $language_id,
                'area_unit' => $area_unit,
                'created_at' => $created_at
            ]);
        }

        // Trigger update event on i_area_unit to cache its values
        $i_area_unit->update();
        
        // Reload the instance
        $i_area_unit = IAreaUnit::find($i_area_unit->id);

        // Transform the result
        $i_area_unit = new IAreaUnitResource($i_area_unit);

        return $i_area_unit;
    }
}
