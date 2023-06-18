<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IBathroom;
use Cache;
use LaravelLocalization;

class IBathroomEvents
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

    private function clearCaches(IBathroom $ibathroom)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached i_bathrooms
            Cache::forget('inventory_module_bathrooms_'.$key);

            Cache::forget('i_bathroom_'.$ibathroom->id.'_bathroom_'.$key);
        }
    }

    public function iBathroomCreated(IBathroom $ibathroom)
    {
        $this->clearCaches($ibathroom);
    }

    public function iBathroomUpdated(IBathroom $ibathroom)
    {
        $this->clearCaches($ibathroom);
    }

    public function iBathroomSaved(IBathroom $ibathroom)
    {
        $this->clearCaches($ibathroom);
    }

    public function iBathroomDeleted(IBathroom $ibathroom)
    {
        $this->clearCaches($ibathroom);
    }

    public function iBathroomRestored(IBathroom $ibathroom)
    {
        $this->clearCaches($ibathroom);
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
