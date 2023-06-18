<?php

namespace Modules\Events\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Events\Event;
use Cache;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class EventEvents
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    private function clearCaches(Event $event)
    {
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

    public function eventCreated(Event $event)
    {
        $this->clearCaches($event);
    }
    
    public function eventUpdated(Event $event)
    {
        $this->clearCaches($event);
    }

    public function eventSaved(Event $event)
    {
        $this->clearCaches($event);
    }

    public function eventDeleted(Event $event)
    {
        $this->clearCaches($event);
    }

    public function eventRestored(Event $event)
    {
        $this->clearCaches($event);
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
