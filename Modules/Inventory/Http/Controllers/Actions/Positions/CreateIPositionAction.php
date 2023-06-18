<?php

namespace Modules\Inventory\Http\Controllers\Actions\Positions;

use Modules\Inventory\IPosition;
use Modules\Inventory\IPositionTranslation;
use DB;
use Carbon\Carbon;
use Modules\Inventory\Http\Resources\IPositionResource;

class CreateIPositionAction
{
    public function execute(array $data): IPositionResource
    {
        // Create position
        $i_position = IPosition::create([
            'order' => isset($data['order']) ? $data['order'] : 1,
            'color_class' => isset($data['color_class']) ? $data['color_class'] : null
        ]);

        // Create translations
        for ($i = 0; $i < count($data['translations']); $i++) {
            // To overcome composite primary key laravel insertion issue
            $i_position_id = $i_position->id;
            $language_id = $data['translations'][$i]['language_id'];
            $position = $data['translations'][$i]['position'];
            $created_at = Carbon::now()->toDateTimeString();

            DB::table('i_position_trans')->insert([
                'i_position_id' => $i_position_id,
                'language_id' => $language_id,
                'position' => $position,
                'created_at' => $created_at
            ]);
        }

        // Trigger update event on i_position to cache its values
        $i_position->update();
        
        // Reload the instance
        $i_position = IPosition::find($i_position->id);

        // Transform the result
        $i_position = new IPositionResource($i_position);

        return $i_position;
    }
}
