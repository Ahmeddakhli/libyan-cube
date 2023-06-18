<?php

namespace Modules\Inventory\Http\Controllers\Actions\FloorNumbers;

use Modules\Inventory\IFloorNumber;
use Modules\Inventory\IFloorNumberTranslation;
use DB;
use Carbon\Carbon;
use Modules\Inventory\Http\Resources\IFloorNumberResource;

class CreateIFloorNumberAction
{
    public function execute(array $data): IFloorNumberResource
    {
        // Create floor_number
        $i_floor_number = IFloorNumber::create([
            'order' => isset($data['order']) ? $data['order'] : 1,
            'count' => $data['count']
        ]);

        // Create translations
        for ($i = 0; $i < count($data['translations']); $i++) {
            // To overcome composite primary key laravel insertion issue
            $i_floor_number_id = $i_floor_number->id;
            $language_id = $data['translations'][$i]['language_id'];
            $displayed_text = $data['translations'][$i]['displayed_text'];
            $created_at = Carbon::now()->toDateTimeString();

            DB::table('i_floor_number_trans')->insert([
                'i_floor_number_id' => $i_floor_number_id,
                'language_id' => $language_id,
                'displayed_text' => $displayed_text,
                'created_at' => $created_at
            ]);
        }

        // Trigger update event on i_floor_number to cache its values
        $i_floor_number->update();

        // Reload the instance
        $i_floor_number = IFloorNumber::find($i_floor_number->id);

        // Transform the result
        $i_floor_number = new IFloorNumberResource($i_floor_number);

        return $i_floor_number;
    }
}
