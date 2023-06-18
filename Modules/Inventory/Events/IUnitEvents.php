<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IUnit;
use Cache;
use LaravelLocalization;

class IUnitEvents
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private function clearCaches(IUnit $i_unit)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();
        Cache::forget('i_unit' . $i_unit->id . '_address_' . 'default');
        Cache::forget('i_unit' . $i_unit->id . '_description_' . 'en');
        Cache::forget('i_unit' . $i_unit->id . '_meta_title_' . 'default');
        Cache::forget('i_unit' . $i_unit->id . '_meta_description_' . 'default');
        Cache::forget('i_unit' . $i_unit->id . '_title_' . 'en');
        
        foreach ($supported_locales as $key => $supported_locale) {
            Cache::forget('inventory_module_units_prices_list');
            Cache::forget('i_unit' . $i_unit->id . '_address_' . $key);
            Cache::forget('i_unit' . $i_unit->id . '_description_' . $key);
            Cache::forget('i_unit' . $i_unit->id . '_meta_title_' . $key);
            Cache::forget('i_unit' . $i_unit->id . '_meta_description_' . $key);

            Cache::forget('i_unit' . $i_unit->id . '_title_' . $key);
        }
    }

    public function iUnitCreated(IUnit $i_unit)
    {
        $this->clearCaches($i_unit);
    }

    public function iUnitUpdated(IUnit $i_unit)
    {
        $this->clearCaches($i_unit);
    }

    public function iUnitSaved(IUnit $i_unit)
    {
        $this->clearCaches($i_unit);
    }

    public function iUnitDeleted(IUnit $i_unit)
    {
        $this->clearCaches($i_unit);
    }

    public function iUnitRestored(IUnit $i_unit)
    {
        $this->clearCaches($i_unit);
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
