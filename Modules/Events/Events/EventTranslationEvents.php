<?php

namespace Modules\Events\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Events\EventTranslation;
use Modules\Events\Event;
use Cache;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class EventTranslationEvents
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    private function clearCaches(EventTranslation $event_translation)
    {   
        // Get event 
        $event = Event::find($event_translation->event_id);

        // Get locale
        $supported_locales = LaravelLocalization::getSupportedLocales();

        // Clear event cache for every locale
        foreach ($supported_locales as $key => $supported_locale) {
            Cache::forget('event_' . $event->id . '_value_' . $key);
            Cache::forget('event_' . $event->id . '_description_' . $key);
            Cache::forget('event_' . $event->id . '_meta_title_' . $key);
            Cache::forget('event_' . $event->id . '_meta_description_' . $key);
        }
    }

    public function eventTranslationCreated(EventTranslation $event_translation)
    {
        $this->clearCaches($event_translation);
    }

    public function eventTranslationUpdated(EventTranslation $event_translation)
    {
        $this->clearCaches($event_translation);
    }

    public function eventTranslationSaved(EventTranslation $event_translation)
    {
        $this->clearCaches($event_translation);
    }

    public function eventTranslationDeleted(EventTranslation $event_translation)
    {
        $this->clearCaches($event_translation);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
