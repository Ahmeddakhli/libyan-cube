<?php

namespace Modules\Inventory\Http\Controllers\Actions\Developers;

use Modules\Inventory\IDeveloper;
use Carbon\Carbon;
use Modules\Inventory\Http\Resources\IDeveloperResource;
use DB;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileUnacceptableForCollection;

class CreateIDeveloperAction
{
    public function execute(array $data, $attachments = null): IDeveloperResource
    {
        // Create the i_developer
        $created_at = Carbon::now()->toDateTimeString();
        $i_developer = IDeveloper::create($data);
        $slug = '';
        // Create translations
        foreach ($data['translations'] as $translation) {
            // To overcome composite primary key laravel insertion issue
            $developer_id = $i_developer->id;
            $language_id = $translation['language_id'];
            $developer = $translation['developer'];
            $description = $translation['description'];
            $meta_title = isset($translation['meta_title']) && !is_null($translation['meta_title']) ? $translation['meta_title'] : $translation['developer'];;
            $meta_description = isset($translation['meta_description']) && !is_null($translation['meta_description']) ? $translation['meta_description'] : $translation['description'];

            if ($translation['language_id'] == 1) {
                $slug =  str_slug($translation['developer']);
            }

            DB::table('i_developer_trans')->insert([
                'i_developer_id' => $developer_id,
                'language_id' => $language_id,
                'developer' => $developer,
                'description' => $description,
                'meta_title' => $meta_title,
                'meta_description' => $meta_description,
                'created_at' => $created_at
            ]);
        }

        $i_developer->update([
            'slug' => $slug
        ]);

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

        // Transform the result
        $i_developer = new IDeveloperResource($i_developer);

        // Return the response
        return $i_developer;
    }
}
