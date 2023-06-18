<?php

namespace Modules\Attachments\Http\Controllers\Actions;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileUnacceptableForCollection;

class StoreMediaAttachmentsAction
{
    public function execute($path,$attachments,$model,$identifier)
    {
        $errors = array();

        foreach ($attachments as $attachment) {
            // Store the file
            $file_name_with_extension = $attachment->getClientOriginalName();
            $file_name_without_extension = pathinfo($file_name_with_extension, PATHINFO_FILENAME);
            $extension = $attachment->getClientOriginalExtension();

            $name = uniqid() . '_' . $file_name_without_extension;
            try {
                $action = new StoreMultiDimensionalAttachmentsAction;
                $action->execute($attachment, $name, $extension);
            } catch (\Throwable $th) {
            }

            // Store the file
            $attachment->move($path, $name . '.' . $extension);

            // Associate the file with the unit collection
            try {
                $model
                    ->addMedia($path . $name . '.' . $extension)
                    ->toMediaCollection($identifier . $model->id . ',' . 'attachments');
            } catch (FileUnacceptableForCollection $e) {
                $errors[] = [
                    'field' => 'file',
                    'message' => Lang::get('service::service.file_is_unacceptable')
                    // 'message' => $e->getMessage()
                ];
            }
        }
        
        if (count($errors)) {
            throw new HttpResponseException(response()->json([
                'errors' => $errors
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
        }
    }
}
