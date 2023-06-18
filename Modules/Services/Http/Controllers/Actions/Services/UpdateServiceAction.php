<?php

namespace Modules\Services\Http\Controllers\Actions\Services;

use Modules\Services\Service;
use Modules\Services\ServiceTranslation;
use DB;
use Carbon\Carbon;
use Modules\Services\Http\Resources\ServiceResource;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileUnacceptableForCollection;
use Modules\Attachments\Http\Controllers\Actions\DeleteMediaAction;
use Modules\Attachments\Http\Controllers\Actions\StoreMultiDimensionsAttachmentsAction;

class UpdateServiceAction
{

    public function execute($id, array $data, $attachments = null): ServiceResource
    {
        $created_at = Carbon::now()->toDateTimeString();
        $updated_at = Carbon::now()->toDateTimeString();

        // Get the service
        $service = Service::find($id);

        // Delete previous translations
        ServiceTranslation::where('service_id', $service->id)->delete();

        // Update/Create translations
        for ($i = 0; $i < count($data['translations']); $i++) {
            // To overcome composite primary key laravel update issue
            $service_id = $id;
            $language_id = $data['translations'][$i]['language_id'];
            $title = $data['translations'][$i]['title'];
            $description = $data['translations'][$i]['description'];

            DB::table('service_trans')->insert([
                'service_id' => $service_id,
                'language_id' => $language_id,
                'title' => $title,
                'description' => $description,
                'created_at' => $created_at
            ]);
        }

        // Trigger update event on service to cache its values
        $service->update([
            'is_featured' => isset($data['is_featured']) ? $data['is_featured'] : 0,
            'icon' => isset($data['icon']) ? $data['icon'] : $service->icon,
            'updated_at' => $updated_at,
        ]);


        // Reload the instance
        $service = Service::find($service->id);

        // Transform the result
        $service = new ServiceResource($service);

        return $service;
    }
}
