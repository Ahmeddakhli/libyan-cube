<?php

namespace Modules\Inventory\Http\Controllers\Actions\FurnishingStatuses;

use Modules\Inventory\IFurnishingStatus;
use Modules\Inventory\IFurnishingStatusTranslation;
use DB;
use Carbon\Carbon;
use Modules\Inventory\Http\Resources\IFurnishingStatusResource;

class CreateIFurnishingStatusAction
{
    public function execute(array $data): IFurnishingStatusResource
    {
        // Create furnishing status
        $i_furnishing_status = IFurnishingStatus::create([
            'order' => isset($data['order']) ? $data['order'] : 1,
            'color_class' => isset($data['color_class']) ? $data['color_class'] : null
        ]);

        // Create translations
        for ($i = 0; $i < count($data['translations']); $i++) {
            // To overcome composite primary key laravel insertion issue
            $i_furnishing_status_id = $i_furnishing_status->id;
            $language_id = $data['translations'][$i]['language_id'];
            $furnishing_status = $data['translations'][$i]['furnishing_status'];
            $created_at = Carbon::now()->toDateTimeString();

            DB::table('i_furnishing_status_trans')->insert([
                'i_fur_status_id' => $i_furnishing_status_id,
                'language_id' => $language_id,
                'furnishing_status' => $furnishing_status,
                'created_at' => $created_at
            ]);
        }

        // Trigger update event on i_furnishing_status to cache its values
        $i_furnishing_status->update();

        // Reload the instance
        $i_furnishing_status = IFurnishingStatus::find($i_furnishing_status->id);

        // Transform the result
        $i_furnishing_status = new IFurnishingStatusResource($i_furnishing_status);

        return $i_furnishing_status;
    }
}
