<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\UnitType;
use Cache;
use LaravelLocalization;

class IUnitTypeEvents
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

    private function clearCaches(UnitType $i_unit_type)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();
        Cache::forget('i_unit_type_'.$i_unit_type->id.'_unit_type_'.'default');
        Cache::forget('i_unit_type_'.$i_unit_type->id.'_description_'.'default');

        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached i_unit_type
            Cache::forget('inventory_module_unit_types_'.$key);

            Cache::forget('i_unit_type_'.$i_unit_type->id.'_unit_type_'.$key);
            Cache::forget('i_unit_type_'.$i_unit_type->id.'_description_'.$key);

        }
    }

    public function iUnitTypeCreated(UnitType $i_unit_type)
    {
        $this->clearCaches($i_unit_type);
    }

    public function iUnitTypeUpdated(UnitType $i_unit_type)
    {
        $this->clearCaches($i_unit_type);
    }

    public function iUnitTypeSaved(UnitType $i_unit_type)
    {
        $this->clearCaches($i_unit_type);
    }

    public function iUnitTypeDeleted(UnitType $i_unit_type)
    {
        $this->clearCaches($i_unit_type);
    }

    public function iUnitTypeRestored(UnitType $i_unit_type)
    {
        $this->clearCaches($i_unit_type);
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
