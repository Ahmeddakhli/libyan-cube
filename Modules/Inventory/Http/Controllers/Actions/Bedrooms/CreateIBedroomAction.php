<?php

namespace Modules\Inventory\Http\Controllers\Actions\Bedrooms;

use Modules\Inventory\IBedroom;
use Modules\Inventory\IBedroomTranslation;
use DB;
use Carbon\Carbon;
use Modules\Inventory\Http\Resources\IBedroomResource;

class CreateIBedroomAction
{
    public function execute(array $data): IBedroomResource
    {
        // Create bedroom
        $i_bedroom = IBedroom::create([
            'order' => isset($data['order']) ? $data['order'] : 1,
            'count' => $data['count']
        ]);

        // Create translations
        for ($i = 0; $i < count($data['translations']); $i++) {
            // To overcome composite primary key laravel insertion issue
            $i_bedroom_id = $i_bedroom->id;
            $language_id = $data['translations'][$i]['language_id'];
            $displayed_text = $data['translations'][$i]['displayed_text'];
            $created_at = Carbon::now()->toDateTimeString();

            DB::table('i_bedroom_trans')->insert([
                'i_bedroom_id' => $i_bedroom_id,
                'language_id' => $language_id,
                'displayed_text' => $displayed_text,
                'created_at' => $created_at
            ]);
        }

        // Trigger update event on i_bedroom to cache its values
        $i_bedroom->update();

        // Reload the instance
        $i_bedroom = IBedroom::find($i_bedroom->id);

        // Transform the result
        $i_bedroom = new IBedroomResource($i_bedroom);

        // Return the response
        return $i_bedroom;
    }
}
