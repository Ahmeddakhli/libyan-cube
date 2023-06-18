<?php

namespace Modules\Inventory\Http\Controllers\Actions\Phases;

use Modules\Inventory\IPhase;
use Modules\Inventory\IPhaseTranslation;
use DB;
use Carbon\Carbon;
use Modules\Inventory\Http\Resources\IPhaseResource;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileUnacceptableForCollection;

class UpdateIPhaseAction
{
    public function execute($id, array $data, $attachments): IPhaseResource
    {
        // Get bphase
        $i_phase = IPhase::find($id);
        
        // Set phase id
        $i_phase_id = $i_phase->id;

        // Update/Create translations
        for ($i = 0; $i < count($data['translations']); $i++) {
            // To overcome composite primary key laravel update issue
            $language_id = $data['translations'][$i]['language_id'];
            $name = $data['translations'][$i]['name'];
            $description = $data['translations'][$i]['description'];
            $created_at = Carbon::now()->toDateTimeString();
            $updated_at = Carbon::now()->toDateTimeString();

            // Check if translation exists
            $i_phase_trnaslation = IPhaseTranslation::where('i_phase_id', $i_phase_id)->where('language_id', $language_id)->first();

            if ($i_phase_trnaslation) {
                DB::table('i_phase_trans')->where('i_phase_id', $i_phase_id)->where('language_id', $language_id)->update([
                    'name' => $name,
                    'description' => $description,
                    'updated_at' => $updated_at
                ]);
            } else {
                DB::table('i_phase_trans')->insert([
                    'i_phase_id' => $i_phase_id,
                    'language_id' => $language_id,
                    'name' => $name,
                    'description' => $description,
                    'created_at' => $created_at
                ]);
            }
        }

        // Upload attachments
        if ($attachments) {
            $path = storage_path('tmp/uploads');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $errors = array();

            foreach ($attachments as $attachment) {
                $name = uniqid() . '_' . trim($attachment->getClientOriginalName());

                $attachment->move($path, $name);

                $full_path = storage_path('tmp/uploads/' . $name);

                // Associate the file with the unit collection
                try {
                    $i_phase
                        ->addMedia(storage_path('tmp/uploads/' . $name))
                        ->toMediaCollection(request()->getHttpHost() . ',inventory,phases,' . $i_phase->id . ',' . 'attachments');
                } catch (FileUnacceptableForCollection $e) {
                    $errors[] = [
                        'field' => 'file',
                        'message' => Lang::get('inventory::inventory.file_is_unacceptable')
                        // 'message' => $e->getMessage()
                    ];
                }
            }
        }

        // Update bphase
        // Trigger update event on bphase to cache its values
        $i_phase->update($data);

        // Reload the instance
        $i_phase = IPhase::find($i_phase->id);

        // Transform the result
        $i_phase = new IPhaseResource($i_phase);

        return $i_phase;
    }
}
