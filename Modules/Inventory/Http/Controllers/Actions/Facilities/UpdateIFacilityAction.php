<?php

namespace Modules\Inventory\Http\Controllers\Actions\Facilities;

use Modules\Inventory\IFacility;
use Modules\Inventory\IFacilityTranslation;
use DB;
use Carbon\Carbon;
use Modules\Inventory\Http\Resources\IFacilityResource;
use Modules\Attachments\Http\Controllers\Actions\DeleteMediaAction;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileUnacceptableForCollection;

class UpdateIFacilityAction
{
    public function execute($id, array $data, $attachments = null): IFacilityResource
    {
        // Get i_facility
        $i_facility = IFacility::find($id);

        // Update/Create translations
        for ($i = 0; $i < count($data['translations']); $i++) {
            // To overcome composite primary key laravel update issue
            $i_facility_id = $id;
            $language_id = $data['translations'][$i]['language_id'];
            $facility = $data['translations'][$i]['facility'];
            $description = $data['translations'][$i]['description'];
            $created_at = Carbon::now()->toDateTimeString();
            $updated_at = Carbon::now()->toDateTimeString();
            
            // Check if translation exists
            $i_facility_trnaslation = IFacilityTranslation::where('i_facility_id', $i_facility_id)->where('language_id', $language_id)->first();

            if ($i_facility_trnaslation) {
                DB::table('i_facility_trans')->where('i_facility_id', $i_facility_id)->where('language_id', $language_id)->update([
                    'facility' => $facility,
                    'description' => $description,
                    'updated_at' => $updated_at
                ]);
            } else {
                DB::table('i_facility_trans')->insert([
                    'i_facility_id' => $i_facility_id,
                    'language_id' => $language_id,
                    'facility' => $facility,
                    'description' => $description,
                    'created_at' => $created_at
                ]);
            }
        }

        // Update i_facility
        $i_facility->update([
            'order' => isset($data['order']) ? $data['order'] : 1,
            'color_class' => isset($data['color_class']) ? $data['color_class'] : $i_facility->color_class,
            'svg' => (isset($data['svg']) && !empty($data['svg'])) ? $data['svg'] : null
        ]);

        // Trigger update event on i_facility to cache its values
        if (count($i_facility->getMedia(request()->getHttpHost() . ',inventory,facilities,' . $i_facility->id . ',' . 'attachments')) > 0 && $attachments) {
            // Delete previous attachment(s)
            $previous_uploads = $i_facility->getMedia(request()->getHttpHost() . ',inventory,facilities,' . $i_facility->id . ',' . 'attachments');
            $action = new DeleteMediaAction;
            foreach ($previous_uploads as $previous_upload) {
                $action->execute($previous_upload->id);
            }

            // Upload the new attachment
            $path = storage_path('tmp/uploads');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $errors = array();

            $name = uniqid() . '_' . trim($attachments->getClientOriginalName());

            $attachments->move($path, $name);

            $full_path = storage_path('tmp/uploads/' . $name);

            // Associate the file with the unit collection
            try {
                $i_facility
                    ->addMedia(storage_path('tmp/uploads/' . $name))
                    ->toMediaCollection(request()->getHttpHost() . ',inventory,facilities,' . $i_facility->id . ',' . 'attachments');
            } catch (FileUnacceptableForCollection $e) {
                $errors[] = [
                    'field' => 'file',
                    'message' => Lang::get('inventory::inventory.file_is_unacceptable')
                    // 'message' => $e->getMessage()
                ];
            }

            if (count($errors)) {
                throw new HttpResponseException(response()->json([
                    'errors' => $errors
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
            }
        } else {
            // Upload attachments
            if ($attachments) {
                $path = storage_path('tmp/uploads');

                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                $errors = array();

                $name = uniqid() . '_' . trim($attachments->getClientOriginalName());

                $attachments->move($path, $name);

                $full_path = storage_path('tmp/uploads/' . $name);

                // Associate the file with the unit collection
                try {
                    $i_facility
                        ->addMedia(storage_path('tmp/uploads/' . $name))
                        ->toMediaCollection(request()->getHttpHost() . ',inventory,facilities,' . $i_facility->id . ',' . 'attachments');
                } catch (FileUnacceptableForCollection $e) {
                    $errors[] = [
                        'field' => 'file',
                        'message' => Lang::get('inventory::inventory.file_is_unacceptable')
                        // 'message' => $e->getMessage()
                    ];
                }

                if (count($errors)) {
                    throw new HttpResponseException(response()->json([
                        'errors' => $errors
                    ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
                }
            }
        }

        // Reload the instance
        $i_facility = IFacility::find($i_facility->id);

        // Transform the result
        $i_facility = new IFacilityResource($i_facility);

        return $i_facility;
    }
}
