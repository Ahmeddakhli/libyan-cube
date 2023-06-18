<?php

namespace Modules\Events\Http\Controllers\Actions;

use Modules\Events\Event;
use Modules\Events\EventTranslation;
use DB;
use Carbon\Carbon;
use Modules\Attachments\Http\Controllers\Actions\StoreMultiDimensionsAttachmentsAction;
use Modules\Events\Http\Resources\EventResource;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileUnacceptableForCollection;

class UpdateEventAction
{

    public function execute($id, array $data, $attachments = null): EventResource
    {
        // Prepare time stamps
        $created_at = Carbon::now()->toDateTimeString();
        $updated_at = Carbon::now()->toDateTimeString();

        // Get event
        $event = Event::find($id);

        // Delete previous translations
        EventTranslation::where('event_id', $event->id)->delete();

        // Create event translations
        for ($i = 0; $i < count($data['translations']); $i++) {
            // Prepare translation data
            $event_id = $id;
            $language_id = $data['translations'][$i]['language_id'];
            $translation_data = [
                'title' => $data['translations'][$i]['title'],
                'description' => $data['translations'][$i]['description'],
                'meta_title' => isset($data['translations'][$i]['meta_title']) && !is_null($data['translations'][$i]['meta_title']) ? $data['translations'][$i]['meta_title'] : $data['translations'][$i]['title'],
                'meta_description' => isset($data['translations'][$i]['meta_description']) && !is_null($data['translations'][$i]['meta_description']) ? $data['translations'][$i]['meta_description'] : $data['translations'][$i]['description'],
                'updated_at' => $updated_at
            ];

            // Add additional fields
            $translation_data['event_id'] = $event_id;
            $translation_data['language_id'] = $language_id;
            $translation_data['created_at'] = $created_at;

            // Create now translation 
            DB::table('event_trans')->insert($translation_data);
        }

        // Upload attachments
        if ($attachments) {
            $path = storage_path('tmp/uploads');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $errors = array();

            foreach ($attachments as $attachment) {
                $file_name_with_extension = $attachment->getClientOriginalName();
                $file_name_without_extension = pathinfo($file_name_with_extension, PATHINFO_FILENAME);
                $extension = $attachment->getClientOriginalExtension();
                $name = uniqid() . '_' . $file_name_without_extension;

                // Store the dimensions
                try {
                    $dimensions = [
                        ['width' => 300, 'height' => 300],
                        ['width' => 1076, 'height' => 366]
                    ];
                    $action = new StoreMultiDimensionsAttachmentsAction;
                    $action->execute($attachment, $name, $dimensions);
                } catch (\Throwable $th) {
                }

                // Store the file
                $attachment->move($path, $name . '.' . $extension);
                $full_path = storage_path('tmp/uploads/' . $name);

                // Associate the file with the unit collection
                try {
                    $event
                        ->addMedia(storage_path('tmp/uploads/' . $name . '.' . $extension))
                        ->toMediaCollection(request()->getHttpHost() . ',events,' . $event->id . ',' . 'attachments');
                } catch (FileUnacceptableForCollection $e) {
                    $errors[] = [
                        'field' => 'file',
                        'message' => Lang::get('events::event.file_is_unacceptable')
                        // 'message' => $e->getMessage()
                    ];
                }
            }
        }

        // Update event
        // Trigger update event on event to cache its values
        $event->update($data);

        // Transform the result
        $event = new EventResource($event);

        // Return the response
        return $event;
    }
}
