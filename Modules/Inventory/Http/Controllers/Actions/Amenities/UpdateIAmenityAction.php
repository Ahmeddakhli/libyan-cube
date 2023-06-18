<?php

namespace Modules\Inventory\Http\Controllers\Actions\Amenities;

use Modules\Inventory\IAmenity;
use Modules\Inventory\IAmenityTranslation;
use DB;
use Carbon\Carbon;
use Modules\Inventory\Http\Resources\IAmenityResource;
use Modules\Attachments\Http\Controllers\Actions\DeleteMediaAction;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileUnacceptableForCollection;

class UpdateIAmenityAction
{
    public function execute($id, array $data, $attachments = null): IAmenityResource
    {
        // Get i_amenity
        $i_amenity = IAmenity::find($id);

        // Update/Create translations
        for ($i = 0; $i < count($data['translations']); $i++) {
            // To overcome composite primary key laravel update issue
            $i_amenity_id = $id;
            $language_id = $data['translations'][$i]['language_id'];
            $amenity = $data['translations'][$i]['amenity'];
            $description = $data['translations'][$i]['description'];
            $created_at = Carbon::now()->toDateTimeString();
            $updated_at = Carbon::now()->toDateTimeString();

            // Check if translation exists
            $i_amenity_translation = IAmenityTranslation::where('i_amenity_id', $i_amenity_id)->where('language_id', $language_id)->first();

            if ($i_amenity_translation) {
                DB::table('i_amenity_trans')->where('i_amenity_id', $i_amenity_id)->where('language_id', $language_id)->update([
                    'amenity' => $amenity,
                    'description' => $description,
                    'updated_at' => $updated_at
                ]);
            } else {
                DB::table('i_amenity_trans')->insert([
                    'i_amenity_id' => $i_amenity_id,
                    'language_id' => $language_id,
                    'amenity' => $amenity,
                    'description' => $description,
                    'created_at' => $created_at,
                    'updated_at' => $created_at
                ]);
            }
        }

        // Update i_amenity
        $i_amenity->update([
            'order' => isset($data['order']) ? $data['order'] : 1,
            'color_class' => isset($data['color_class']) ? $data['color_class'] : $i_amenity->color_class,
            'svg' => (isset($data['svg']) && !empty($data['svg'])) ? $data['svg'] : null
        ]);

        // Trigger update event on i_amenity to cache its values
        if (count($i_amenity->getMedia(request()->getHttpHost() . ',inventory,amenities,' . $i_amenity->id . ',' . 'attachments')) > 0 && $attachments) {
            // Delete previous attachment(s)
            $previous_uploads = $i_amenity->getMedia(request()->getHttpHost() . ',inventory,amenities,' . $i_amenity->id . ',' . 'attachments');
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
                $i_amenity
                    ->addMedia(storage_path('tmp/uploads/' . $name))
                    ->toMediaCollection(request()->getHttpHost() . ',inventory,amenities,' . $i_amenity->id . ',' . 'attachments');
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
                    $i_amenity
                        ->addMedia(storage_path('tmp/uploads/' . $name))
                        ->toMediaCollection(request()->getHttpHost() . ',inventory,amenities,' . $i_amenity->id . ',' . 'attachments');
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
        $i_amenity = IAmenity::find($i_amenity->id);

        // Transform the result
        $i_amenity = new IAmenityResource($i_amenity);

        return $i_amenity;
    }
}
