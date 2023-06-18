<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IAreaUnit;
use Cache;
use LaravelLocalization;

class IAreaUnitEvents
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

    private function clearCaches(IAreaUnit $i_area_unit)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached i_area_units
            Cache::forget('inventory_module_area_units_'.$key);

            Cache::forget('i_area_unit_'.$i_area_unit->id.'_area_unit_'.$key);
        }
    }

    public function iAreaUnitCreated(IAreaUnit $i_area_unit)
    {
        $this->clearCaches($i_area_unit);
    }

    public function iAreaUnitUpdated(IAreaUnit $i_area_unit)
    {
        $this->clearCaches($i_area_unit);
    }

    public function iAreaUnitSaved(IAreaUnit $i_area_unit)
    {
        $this->clearCaches($i_area_unit);
    }

    public function iAreaUnitDeleted(IAreaUnit $i_area_unit)
    {
        $this->clearCaches($i_area_unit);
    }

    public function iAreaUnitRestored(IAreaUnit $i_area_unit)
    {
        $this->clearCaches($i_area_unit);
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
