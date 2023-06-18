<?php

namespace Modules\Inventory\Http\Controllers\Actions\Purposes;

use Modules\Inventory\IPurpose;
use Modules\Inventory\IPurposeTranslation;
use DB;
use Carbon\Carbon;
use Modules\Inventory\Http\Resources\IPurposeResource;

class CreateIPurposeAction
{
    public function execute(array $data): IPurposeResource
    {
        if(isset($data['attachments']) && is_file($data['attachments'])){
            $data['image'] = $data['attachments']->store('purposes/','public');
        }
        // Create purpose
        $i_purpose = IPurpose::create($data);

        // Create translations
        for ($i = 0; $i < count($data['translations']); $i++) {
            // To overcome composite primary key laravel insertion issue
            $i_purpose_id = $i_purpose->id;
            $language_id = $data['translations'][$i]['language_id'];
            $purpose = $data['translations'][$i]['purpose'];
            $created_at = Carbon::now()->toDateTimeString();

            DB::table('i_purpose_trans')->insert([
                'i_purpose_id' => $i_purpose_id,
                'language_id' => $language_id,
                'purpose' => $purpose,
                'created_at' => $created_at
            ]);
        }

        // Trigger update event on i_purpose to cache its values
        $i_purpose->update();
        
        // Reload the instance
        $i_purpose = IPurpose::find($i_purpose->id);

        // Transform the result
        $i_purpose = new IPurposeResource($i_purpose);

        return $i_purpose;
    }
}
