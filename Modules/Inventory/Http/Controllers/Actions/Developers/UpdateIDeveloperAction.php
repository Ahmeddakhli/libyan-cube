<?php

namespace Modules\Inventory\Http\Controllers\Actions\Developers;

use Modules\Inventory\IDeveloper;
use Modules\Inventory\IDeveloperTranslation;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Lang;
use Modules\Inventory\Http\Resources\IDeveloperResource;
use Modules\Attachments\Http\Controllers\Actions\DeleteMediaAction;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileUnacceptableForCollection;

class UpdateIDeveloperAction
{
    public function execute($id, array $data, $attachments = null): IDeveloperResource
    {
        $updated_at = Carbon::now()->toDateTimeString();

        // Get the i_developer
        $i_developer = IDeveloper::find($id);

        foreach ($data['translations'] as $translation) {
            // To overcome composite primary key laravel update issue
            $i_developer_id = $id;
            $language_id = $translation['language_id'];
            $developer = $translation['developer'];
            $description = $translation['description'];
            $created_at = Carbon::now()->toDateTimeString();
            $updated_at = Carbon::now()->toDateTimeString();
            $meta_title = isset($translation['meta_title']) && !is_null($translation['meta_title']) ? $translation['meta_title'] : $translation['developer'];;
            $meta_description = isset($translation['meta_description']) && !is_null($translation['meta_description']) ? $translation['meta_description'] : $translation['description'];

            if ($translation['language_id'] == 1) {
                $slug = str_slug($translation['developer']);
            }

            // Check if translation exists
            $i_developer_trnaslation = IDeveloperTranslation::where('i_developer_id', $i_developer_id)->where('language_id', $language_id)->first();

            if ($i_developer_trnaslation) {
                DB::table('i_developer_trans')->where('i_developer_id', $i_developer_id)->where('language_id', $language_id)->update([
                    'developer' => $developer,
                    'description' => $description,
                    'meta_title' => $meta_title,
                    'meta_description' => $meta_description,
                    'updated_at' => $updated_at
                ]);
            } else {
                DB::table('i_developer_trans')->insert([
                    'i_developer_id' => $i_developer_id,
                    'language_id' => $language_id,
                    'developer' => $developer,
                    'description' => $description,
                    'meta_title' => $meta_title,
                    'meta_description' => $meta_description,
                    'created_at' => $created_at
                ]);
            }
        }

        // Update the i_developer
        $data['slug'] = $slug;
        $data['in_discover_by'] = isset($data['in_discover_by']) ? $data['in_discover_by'] : 0;
        $i_developer->update($data);

        // Trigger update event on i_developer to cache its values
        if (count($i_developer->getMedia(request()->getHttpHost() . ',inventory,developers,' . $i_developer->id . ',' . 'attachments')) > 0 && $attachments) {
            // Delete previous attachment(s)
            $previous_uploads = $i_developer->getMedia(request()->getHttpHost() . ',inventory,developers,' . $i_developer->id . ',' . 'attachments');
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
                $i_developer
                    ->addMedia(storage_path('tmp/uploads/' . $name))
                    ->toMediaCollection(request()->getHttpHost() . ',inventory,developers,' . $i_developer->id . ',' . 'attachments');
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
                    $i_developer
                        ->addMedia(storage_path('tmp/uploads/' . $name))
                        ->toMediaCollection(request()->getHttpHost() . ',inventory,developers,' . $i_developer->id . ',' . 'attachments');
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

        // Transform the result
        $i_developer = new IDeveloperResource($i_developer);

        // Return the response
        return $i_developer;
    }
}
