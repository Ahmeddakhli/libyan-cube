<?php

namespace Modules\Inventory\Http\Controllers\Actions\Bedrooms;

use Modules\Inventory\IBedroom;
use Modules\Inventory\IBedroomTranslation;
use DB;
use Carbon\Carbon;
use Modules\Inventory\Http\Resources\IBedroomResource;

class UpdateIBedroomAction
{
    public function execute($id, array $data): IBedroomResource
    {
        // Get i_bedroom
        $i_bedroom = IBedroom::find($id);

        // Update/Create translations
        for ($i = 0; $i < count($data['translations']); $i++) {
            // To overcome composite primary key laravel update issue
            $i_bedroom_id = $id;
            $language_id = $data['translations'][$i]['language_id'];
            $displayed_text = $data['translations'][$i]['displayed_text'];
            $created_at = Carbon::now()->toDateTimeString();
            $updated_at = Carbon::now()->toDateTimeString();

            // Check if translation exists
            $i_bedroom_trnaslation = IBedroomTranslation::where('i_bedroom_id', $i_bedroom_id)->where('language_id', $language_id)->first();

            if ($i_bedroom_trnaslation) {
                DB::table('i_bedroom_trans')->where('i_bedroom_id', $i_bedroom_id)->where('language_id', $language_id)->update([
                    'displayed_text' => $displayed_text,
                    'updated_at' => $updated_at
                ]);
            } else {
                DB::table('i_bedroom_trans')->insert([
                    'i_bedroom_id' => $i_bedroom_id,
                    'language_id' => $language_id,
                    'displayed_text' => $displayed_text,
                    'created_at' => $created_at
                ]);
            }
        }

        // Update i_bedroom
        $i_bedroom->update([
            'order' => isset($data['order']) ? $data['order'] : 1,
            'count' => $data['count']
        ]);

        // Reload the instance
        $i_bedroom = IBedroom::find($i_bedroom->id);

        // Transform the result
        $i_bedroom = new IBedroomResource($i_bedroom);

        return $i_bedroom;
    }
}
