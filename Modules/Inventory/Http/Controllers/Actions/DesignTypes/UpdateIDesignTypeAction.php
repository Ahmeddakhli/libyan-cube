<?php

namespace Modules\Inventory\Http\Controllers\Actions\DesignTypes;

use Modules\Inventory\IDesignType;
use Modules\Inventory\IDesignTypeTranslation;
use DB;
use Carbon\Carbon;
use Modules\Inventory\Http\Resources\IDesignTypeResource;
use Modules\Attachments\Http\Controllers\Actions\DeleteMediaAction;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileUnacceptableForCollection;

class UpdateIDesignTypeAction
{
    public function execute($id, array $data, $attachments = null): IDesignTypeResource
    {
        // Get  design type
        $i_design_type = IDesignType::find($id);

        // Update/Create translations
        for ($i = 0; $i < count($data['translations']); $i++) {
            // To overcome composite primary key laravel update issue
            $i_design_type_id = $id;
            $language_id = $data['translations'][$i]['language_id'];
            $type = $data['translations'][$i]['type'];
            $description = $data['translations'][$i]['description'];
            $created_at = Carbon::now()->toDateTimeString();
            $updated_at = Carbon::now()->toDateTimeString();

            // Check if translation exists
            $i_design_type_trnaslation = IDesignTypeTranslation::where('i_design_type_id', $i_design_type_id)->where('language_id', $language_id)->first();

            if ($i_design_type_trnaslation) {
                DB::table('i_design_type_trans')->where('i_design_type_id', $i_design_type_id)->where('language_id', $language_id)->update([
                    'type' => $type,
                    'description' => $description,
                    'updated_at' => $updated_at
                ]);
            } else {
                DB::table('i_design_type_trans')->insert([
                    'i_design_type_id' => $i_design_type_id,
                    'language_id' => $language_id,
                    'type' => $type,
                    'description' => $description,
                    'created_at' => $created_at
                ]);
            }
        }

        // Update i_design_type
        $i_design_type->update([
            'order' => isset($data['order']) ? $data['order'] : 1,
        ]);

        // Trigger update event on i_design_type to cache its values
        if (count($i_design_type->getMedia(request()->getHttpHost() . ',inventory,design_types,' . $i_design_type->id . ',' . 'attachments')) > 0 && $attachments) {
            // Delete previous attachment(s)
            $previous_uploads = $i_design_type->getMedia(request()->getHttpHost() . ',inventory,design_types,' . $i_design_type->id . ',' . 'attachments');
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
                $i_design_type
                    ->addMedia(storage_path('tmp/uploads/' . $name))
                    ->toMediaCollection(request()->getHttpHost() . ',inventory,design_types,' . $i_design_type->id . ',' . 'attachments');
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
                    $i_design_type
                        ->addMedia(storage_path('tmp/uploads/' . $name))
                        ->toMediaCollection(request()->getHttpHost() . ',inventory,design_types,' . $i_design_type->id . ',' . 'attachments');
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
        $i_design_type = IDesignType::find($i_design_type->id);

        // Transform the result
        $i_design_type = new IDesignTypeResource($i_design_type);

        return $i_design_type;
    }
}
