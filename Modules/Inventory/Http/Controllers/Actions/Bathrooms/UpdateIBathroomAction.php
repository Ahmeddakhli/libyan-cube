<?php

namespace Modules\Inventory\Http\Controllers\Actions\Bathrooms;

use Modules\Inventory\IBathroom;
use Modules\Inventory\IBathroomTranslation;
use DB;
use Carbon\Carbon;
use Modules\Inventory\Http\Resources\IBathroomResource;

class UpdateIBathroomAction
{
    public function execute($id, array $data) : IBathroomResource
    {
        // Get i_bathroom
        $i_bathroom = IBathroom::find($id);

        // Update/Create translations
        for ($i = 0; $i < count($data['translations']); $i++) {
            // To overcome composite primary key laravel update issue
            $i_bathroom_id = $id;
            $language_id = $data['translations'][$i]['language_id'];
            $displayed_text = $data['translations'][$i]['displayed_text'];
            $created_at = Carbon::now()->toDateTimeString();
            $updated_at = Carbon::now()->toDateTimeString();

            $connection = DB::table('i_bathroom_trans');

            // Check if translation exists
            $i_bathroom_trnaslation = IBathroomTranslation::where('i_bathroom_id', $i_bathroom_id)->where('language_id', $language_id)->first();

            if ($i_bathroom_trnaslation) {
                $connection->where('i_bathroom_id',$i_bathroom_id)->where('language_id',$language_id)->update([
                    'displayed_text' => $displayed_text,
                    'updated_at' => $updated_at
                ]);
                
            } else {
                $connection->insert([
                    'i_bathroom_id' => $i_bathroom_id,
                    'language_id' => $language_id,
                    'displayed_text' => $displayed_text,
                    'created_at' => $created_at
                ]);           
            }
        }

        // Update i_bathroom
        $i_bathroom->update([
            'order' => isset($data['order']) ? $data['order'] : 1,
            'count' => $data['count']
        ]);

        // Reload the instance
        $i_bathroom = IBathroom::find($i_bathroom->id);

        // Transform the result
        $i_bathroom = new IBathroomResource($i_bathroom);

        return $i_bathroom;
    }
}