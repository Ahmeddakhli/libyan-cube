<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IAmenity;
use Cache;
use LaravelLocalization;

class IAmenityEvents
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

    private function clearCaches(IAmenity $iamenity)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached i_amenities
            Cache::forget('inventory_module_amenities_' . $key);

            Cache::forget('i_amenity_' . $iamenity->id . '_amenity_' . $key);
            Cache::forget('i_amenity_' . $iamenity->id . '_description_' . $key);
        }
    }

    public function iAmenityCreated(IAmenity $iamenity)
    {
        $this->clearCaches($iamenity);
    }

    public function iAmenityUpdated(IAmenity $iamenity)
    {
        $this->clearCaches($iamenity);
    }

    public function iAmenitySaved(IAmenity $iamenity)
    {
        $this->clearCaches($iamenity);
    }

    public function iAmenityDeleted(IAmenity $iamenity)
    {
        $this->clearCaches($iamenity);
    }

    public function iAmenityRestored(IAmenity $iamenity)
    {
        $this->clearCaches($iamenity);
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
