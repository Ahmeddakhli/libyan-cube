<?php

namespace Modules\Inventory\Http\Controllers\Actions\Purposes;

use Modules\Inventory\IPurpose;
use Modules\Inventory\IPurposeTranslation;
use DB;
use Carbon\Carbon;
use Modules\Inventory\Http\Resources\IPurposeResource;

class UpdateIPurposeAction
{
    public function execute($id, array $data): IPurposeResource
    {
        // Get i_purpose
        $i_purpose = IPurpose::find($id);

        // Update/Create translations
        for ($i = 0; $i < count($data['translations']); $i++) {
            // To overcome composite primary key laravel update issue
            $i_purpose_id = $id;
            $language_id = $data['translations'][$i]['language_id'];
            $purpose = $data['translations'][$i]['purpose'];
            $created_at = Carbon::now()->toDateTimeString();
            $updated_at = Carbon::now()->toDateTimeString();

            // Check if translation exists
            $i_purpose_trnaslation = IPurposeTranslation::where('i_purpose_id', $i_purpose_id)->where('language_id', $language_id)->first();

            if ($i_purpose_trnaslation) {
                DB::table('i_purpose_trans')->where('i_purpose_id', $i_purpose_id)->where('language_id', $language_id)->update([
                    'purpose' => $purpose,
                    'updated_at' => $updated_at
                ]);
            } else {
                DB::table('i_purpose_trans')->insert([
                    'i_purpose_id' => $i_purpose_id,
                    'language_id' => $language_id,
                    'purpose' => $purpose,
                    'created_at' => $created_at
                ]);
            }
        }

        if(isset($data['attachments']) && is_file($data['attachments'])){
            $data['image'] = $data['attachments']->store('purposes','public');
        }

        // Update i_purpose
        $i_purpose->update($data);

        // Reload the instance
        $i_purpose = IPurpose::find($i_purpose->id);

        // Transform the result
        $i_purpose = new IPurposeResource($i_purpose);

        return $i_purpose;
    }
}
