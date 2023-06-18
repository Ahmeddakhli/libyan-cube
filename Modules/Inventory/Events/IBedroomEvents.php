<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IBedroom;
use Cache;
use LaravelLocalization;

class IBedroomEvents
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

    private function clearCaches(IBedroom $i_bedroom)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached i_bedrooms
            Cache::forget('inventory_module_bedrooms_'.$key);

            Cache::forget('i_bedroom_'.$i_bedroom->id.'_bedroom_'.$key);
        }
    }

    public function iBedroomCreated(IBedroom $i_bedroom)
    {
        $this->clearCaches($i_bedroom);
    }

    public function iBedroomUpdated(IBedroom $i_bedroom)
    {
        $this->clearCaches($i_bedroom);
    }

    public function iBedroomSaved(IBedroom $i_bedroom)
    {
        $this->clearCaches($i_bedroom);
    }

    public function iBedroomDeleted(IBedroom $i_bedroom)
    {
        $this->clearCaches($i_bedroom);
    }

    public function iBedroomRestored(IBedroom $i_bedroom)
    {
        $this->clearCaches($i_bedroom);
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
