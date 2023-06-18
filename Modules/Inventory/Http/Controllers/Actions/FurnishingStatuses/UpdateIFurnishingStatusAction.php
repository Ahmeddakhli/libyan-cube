<?php

namespace Modules\Inventory\Http\Controllers\Actions\FurnishingStatuses;

use Modules\Inventory\IFurnishingStatus;
use Modules\Inventory\IFurnishingStatusTranslation;
use DB;
use Carbon\Carbon;
use Modules\Inventory\Http\Resources\IFurnishingStatusResource;

class UpdateIFurnishingStatusAction
{
    public function execute($id, array $data): IFurnishingStatusResource
    {
        // Get i_furnishing_status
        $i_furnishing_status = IFurnishingStatus::find($id);

        // Update/Create translations
        for ($i = 0; $i < count($data['translations']); $i++) {
            // To overcome composite primary key laravel update issue
            $i_furnishing_status_id = $id;
            $language_id = $data['translations'][$i]['language_id'];
            $furnishing_status = $data['translations'][$i]['furnishing_status'];
            $created_at = Carbon::now()->toDateTimeString();
            $updated_at = Carbon::now()->toDateTimeString();

            // Check if translation exists
            $i_furnishing_status_trnaslation = IFurnishingStatusTranslation::where('i_fur_status_id', $i_furnishing_status_id)->where('language_id', $language_id)->first();

            if ($i_furnishing_status_trnaslation) {
                DB::table('i_furnishing_status_trans')->where('i_fur_status_id', $i_furnishing_status_id)->where('language_id', $language_id)->update([
                    'furnishing_status' => $furnishing_status,
                    'updated_at' => $updated_at
                ]);
            } else {
                DB::table('i_furnishing_status_trans')->insert([
                    'i_fur_status_id' => $i_furnishing_status_id,
                    'language_id' => $language_id,
                    'furnishing_status' => $furnishing_status,
                    'created_at' => $created_at
                ]);
            }
        }

        // Update i_furnishing_status
        $i_furnishing_status->update([
            'order' => isset($data['order']) ? $data['order'] : 1,
            'color_class' => isset($data['color_class']) ? $data['color_class'] : $i_furnishing_status->color_class
        ]);

        // Reload the instance
        $i_furnishing_status = IFurnishingStatus::find($i_furnishing_status->id);

        // Transform the result
        $i_furnishing_status = new IFurnishingStatusResource($i_furnishing_status);

        return $i_furnishing_status;
    }
}
