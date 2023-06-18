<?php

namespace Modules\Inventory\Http\Controllers\Actions\Positions;

use Modules\Inventory\IPosition;
use Modules\Inventory\IPositionTranslation;
use DB;
use Carbon\Carbon;
use Modules\Inventory\Http\Resources\IPositionResource;

class UpdateIPositionAction
{
    public function execute($id, array $data): IPositionResource
    {
        // Get i_position
        $i_position = IPosition::find($id);

        // Update/Create translations
        for ($i = 0; $i < count($data['translations']); $i++) {
            // To overcome composite primary key laravel update issue
            $i_position_id = $id;
            $language_id = $data['translations'][$i]['language_id'];
            $position = $data['translations'][$i]['position'];
            $created_at = Carbon::now()->toDateTimeString();
            $updated_at = Carbon::now()->toDateTimeString();

            // Check if translation exists
            $i_position_trnaslation = IPositionTranslation::where('i_position_id', $i_position_id)->where('language_id', $language_id)->first();

            if ($i_position_trnaslation) {
                DB::table('i_position_trans')->where('i_position_id', $i_position_id)->where('language_id', $language_id)->update([
                    'position' => $position,
                    'updated_at' => $updated_at
                ]);
            } else {
                DB::table('i_position_trans')->insert([
                    'i_position_id' => $i_position_id,
                    'language_id' => $language_id,
                    'position' => $position,
                    'created_at' => $created_at
                ]);
            }
        }

        // Update i_position
        $i_position->update([
            'order' => isset($data['order']) ? $data['order'] : 1,
            'color_class' => isset($data['color_class']) ? $data['color_class'] : $i_position->color_class
        ]);

        // Reload the instance
        $i_position = IPosition::find($i_position->id);

        // Transform the result
        $i_position = new IPositionResource($i_position);

        return $i_position;
    }
}
