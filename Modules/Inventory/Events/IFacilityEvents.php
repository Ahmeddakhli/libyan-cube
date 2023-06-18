<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IFacility;
use Cache;
use LaravelLocalization;

class IFacilityEvents
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

    private function clearCaches(IFacility $i_facility)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached i_facilities
            Cache::forget('inventory_module_facilities_'.$key);

            Cache::forget('i_facility_'.$i_facility->id.'_facility_'.$key);
            Cache::forget('i_facility_'.$i_facility->id.'_description_'.$key);
        }
    }

    public function iFacilityCreated(IFacility $i_facility)
    {
        $this->clearCaches($i_facility);
    }

    public function iFacilityUpdated(IFacility $i_facility)
    {
        $this->clearCaches($i_facility);
    }

    public function iFacilitySaved(IFacility $i_facility)
    {
        $this->clearCaches($i_facility);
    }

    public function iFacilityDeleted(IFacility $i_facility)
    {
        $this->clearCaches($i_facility);
    }

    public function iFacilityRestored(IFacility $i_facility)
    {
        $this->clearCaches($i_facility);
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
