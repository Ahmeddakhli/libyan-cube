<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IAreaUnitTranslation;
use Modules\Inventory\IAreaUnit;
use Cache;
use LaravelLocalization;

class IAreaUnitTranslationEvents
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

    private function clearCaches(IAreaUnitTranslation $i_area_unit_translation)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        // Clearing i_area_unit
        $i_area_unit = IAreaUnit::find($i_area_unit_translation->i_area_unit_id);

        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached i_area_units
            Cache::forget('inventory_module_area_units_'.$key);

            Cache::forget('i_area_unit_'.$i_area_unit->id.'_area_unit_'.$key);
        }
    }

    public function iAreaUnitTranslationCreated(IAreaUnitTranslation $i_area_unit_translation)
    {
        $this->clearCaches($i_area_unit_translation);
    }

    public function iAreaUnitTranslationUpdated(IAreaUnitTranslation $i_area_unit_translation)
    {
        $this->clearCaches($i_area_unit_translation);
    }

    public function iAreaUnitTranslationSaved(IAreaUnitTranslation $i_area_unit_translation)
    {
        $this->clearCaches($i_area_unit_translation);
    }

    public function iAreaUnitTranslationDeleted(IAreaUnitTranslation $i_area_unit_translation)
    {
        $this->clearCaches($i_area_unit_translation);
    }

    public function iAreaUnitTranslationRestored(IAreaUnitTranslation $i_area_unit_translation)
    {
        $this->clearCaches($i_area_unit_translation);
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
