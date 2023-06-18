<?php

namespace Modules\Inventory\Http\Controllers\Actions\Bathrooms;

use Modules\Inventory\IBathroom;
use Modules\Inventory\IBathroomTranslation;
use DB;
use Carbon\Carbon;
use Modules\Inventory\Http\Resources\IBathroomResource;

class CreateIBathroomAction
{
    public function execute(array $data) : IBathroomResource
    {
        // Create bathroom
        $i_bathroom = IBathroom::create([
            'order' => isset($data['order']) ? $data['order'] : 1,
            'count' => $data['count']
        ]);

        // Create translations
        for ($i = 0; $i < count($data['translations']); $i++) {
            // To overcome composite primary key laravel insertion issue
            $i_bathroom_id = $i_bathroom->id;
            $language_id = $data['translations'][$i]['language_id'];
            $displayed_text = $data['translations'][$i]['displayed_text'];
            $created_at = Carbon::now()->toDateTimeString();
            
            DB::table('i_bathroom_trans')->insert([
                'i_bathroom_id' => $i_bathroom_id,
                'language_id' => $language_id,
                'displayed_text' => $displayed_text,
                'created_at' => $created_at
            ]);
        }

        // Trigger update event on i_bathroom to cache its values
        $i_bathroom->update();

        // Reload the instance
        $i_bathroom = IBathroom::find($i_bathroom->id);

        // Transform the result
        $i_bathroom = new IBathroomResource($i_bathroom);

        return $i_bathroom;
    }
}