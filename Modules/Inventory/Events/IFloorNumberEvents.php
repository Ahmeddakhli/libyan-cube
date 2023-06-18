<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IFloorNumber;
use Cache;
use LaravelLocalization;

class IFloorNumberEvents
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

    private function clearCaches(IFloorNumber $ifloor_number)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached i_floor_numbers
            Cache::forget('inventory_module_floor_numbers_'.$key);

            Cache::forget('i_floor_number_'.$ifloor_number->id.'_floor_number_'.$key);
        }
    }

    public function iFloorNumberCreated(IFloorNumber $ifloor_number)
    {
        $this->clearCaches($ifloor_number);
    }

    public function iFloorNumberUpdated(IFloorNumber $ifloor_number)
    {
        $this->clearCaches($ifloor_number);
    }

    public function iFloorNumberSaved(IFloorNumber $ifloor_number)
    {
        $this->clearCaches($ifloor_number);
    }

    public function iFloorNumberDeleted(IFloorNumber $ifloor_number)
    {
        $this->clearCaches($ifloor_number);
    }

    public function iFloorNumberRestored(IFloorNumber $ifloor_number)
    {
        $this->clearCaches($ifloor_number);
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
