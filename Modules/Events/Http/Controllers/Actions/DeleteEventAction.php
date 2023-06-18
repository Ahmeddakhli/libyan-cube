<?php

namespace Modules\Events\Http\Controllers\Actions;

use Modules\Events\Event;
use DB;
use Carbon\Carbon;

class DeleteEventAction
{
    public function execute($id)
    {
        // Get the event
        $event = Event::find($id);

        // Delete the translations manually to overcome laravel issue with composite primary key
        $event_translations = $event->translations;
        foreach ($event_translations as $event_translation) {
            $deleted_at = Carbon::now()->toDateTimeString();
            $event_id = $event_translation->event_id;
            $language_id = $event_translation->language_id;
            DB::table('event_trans')->where('event_id', $event_id)->where('language_id', $language_id)->update([
                'deleted_at' => $deleted_at
            ]);
        }
        
        // Delete event 
        $event->delete();

        return null;
    }
}
