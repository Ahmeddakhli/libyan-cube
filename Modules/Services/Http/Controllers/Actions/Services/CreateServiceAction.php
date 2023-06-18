<?php

namespace Modules\Services\Http\Controllers\Actions\Services;

use Modules\Services\Service;
use Modules\Services\ServiceTranslation;
use DB;
use Carbon\Carbon;
use Modules\Attachments\Http\Controllers\Actions\StoreMultiDimensionsAttachmentsAction;
use Modules\Services\Http\Resources\ServiceResource;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileUnacceptableForCollection;

class CreateServiceAction
{
    public function execute(array $data, $attachments = null): ServiceResource
    {
        $created_at = Carbon::now()->toDateTimeString();

        // Create the Service
        $service = Service::create($data);

        // Create translations
        for ($i = 0; $i < count($data['translations']); $i++) {
            // To overcome composite primary key laravel insertion issue
            $service_id = $service->id;
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
        $service->update();

        // Reload the instance
        $service = Service::find($service->id);

        // Transform the result
        $service = new ServiceResource($service);

        return $service;
    }
}
