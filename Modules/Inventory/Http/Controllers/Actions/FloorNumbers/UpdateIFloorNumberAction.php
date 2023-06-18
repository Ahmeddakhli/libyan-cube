<?php

namespace Modules\Inventory\Http\Controllers\Actions\FloorNumbers;

use Modules\Inventory\IFloorNumber;
use Modules\Inventory\IFloorNumberTranslation;
use DB;
use Carbon\Carbon;
use Modules\Inventory\Http\Resources\IFloorNumberResource;

class UpdateIFloorNumberAction
{
    public function execute($id, array $data): IFloorNumberResource
    {
        // Get i_floor_number
        $i_floor_number = IFloorNumber::find($id);

        // Update/Create translations
        for ($i = 0; $i < count($data['translations']); $i++) {
            // To overcome composite primary key laravel update issue
            $i_floor_number_id = $id;
            $language_id = $data['translations'][$i]['language_id'];
            $displayed_text = $data['translations'][$i]['displayed_text'];
            $created_at = Carbon::now()->toDateTimeString();
            $updated_at = Carbon::now()->toDateTimeString();

            // Check if translation exists
            $i_floor_number_trnaslation = IFloorNumberTranslation::where('i_floor_number_id', $i_floor_number_id)->where('language_id', $language_id)->first();

            if ($i_floor_number_trnaslation) {
                DB::table('i_floor_number_trans')->where('i_floor_number_id', $i_floor_number_id)->where('language_id', $language_id)->update([
                    'displayed_text' => $displayed_text,
                    'updated_at' => $updated_at
                ]);
            } else {
                DB::table('i_floor_number_trans')->insert([
                    'i_floor_number_id' => $i_floor_number_id,
                    'language_id' => $language_id,
                    'displayed_text' => $displayed_text,
                    'created_at' => $created_at
                ]);
            }
        }

        // Update i_floor_number
        $i_floor_number->update([
            'order' => isset($data['order']) ? $data['order'] : 1,
            'count' => $data['count']
        ]);

        // Reload the instance
        $i_floor_number = IFloorNumber::find($i_floor_number->id);

        // Transform the result
        $i_floor_number = new IFloorNumberResource($i_floor_number);

        return $i_floor_number;
    }
}
