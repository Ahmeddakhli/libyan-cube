<?php

namespace Modules\Events\Http\Controllers\Actions;

use Modules\Events\Event;
use Modules\Events\EventTranslation;
use DB;
use Carbon\Carbon;
use Modules\Attachments\Http\Controllers\Actions\StoreMultiDimensionsAttachmentsAction;
use Modules\Events\Http\Resources\EventResource;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileUnacceptableForCollection;

class CreateEventAction
{
    public function execute(array $data, $attachments = null): EventResource
    {
        // Get time 
        $created_at = Carbon::now()->toDateTimeString();

        // Create Event
        $event = Event::create($data);

        // Create translations
        for ($i = 0; $i < count($data['translations']); $i++) {
            // To overcome composite primary key laravel insertion issue
            // Prepare data for event translation 
            $event_id = $event->id;
            $language_id = $data['translations'][$i]['language_id'];
            $title = $data['translations'][$i]['title'];
            $description = $data['translations'][$i]['description'];
            $meta_title = isset($data['translations'][$i]['meta_title']) && !is_null($data['translations'][$i]['meta_title']) ? $data['translations'][$i]['meta_title'] : $data['translations'][$i]['title'];
            $meta_description = isset($data['translations'][$i]['meta_description']) && !is_null($data['translations'][$i]['meta_description']) ? $data['translations'][$i]['meta_description'] : $data['translations'][$i]['description'];

            // Create event translation
            DB::table('event_trans')->insert([
                'event_id' => $event_id,
                'language_id' => $language_id,
                'title' => $title,
                'description' => $description,
                'meta_title' => $meta_title,
                'meta_description' => $meta_description,
                'created_at' => $created_at
            ]);
        }

        // Trigger update event on event to cache its values
        $event->update();

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

        // Reload the instance
        $event = Event::find($event->id);

        // Transform the result
        $event = new EventResource($event);

        return $event;
    }
}
